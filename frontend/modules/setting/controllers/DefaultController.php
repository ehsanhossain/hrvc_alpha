<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * Default controller for the `setting` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    ['allow' => true, 'roles' => ['@']],
                ],
            ],
        ];
    }

    /**
     * Master Settings page
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Master Settings hub
     */
    public function actionMasterSettings()
    {
        // Get existing currencies from DB
        $currencies = Yii::$app->db->createCommand('SELECT * FROM tbl_currency WHERE status = 1 ORDER BY currencyName ASC')->queryAll();
        
        // Get countries
        $countries = [];
        try {
            $countries = Yii::$app->db->createCommand('SELECT * FROM country WHERE status = 1 ORDER BY countryName ASC')->queryAll();
        } catch (\Exception $e) {
            // Table might not exist
        }

        return $this->render('master-settings', [
            'currencies' => $currencies,
            'countries' => $countries,
        ]);
    }

    /**
     * AJAX: Fetch live exchange rates from ExchangeRate-API (free tier)
     */
    public function actionFetchExchangeRates()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $base = Yii::$app->request->get('base', 'USD');
        
        // Using free exchange rate API (no key required)
        $url = "https://open.er-api.com/v6/latest/{$base}";
        
        try {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 10,
                    'method' => 'GET',
                ],
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ],
            ]);
            
            $response = @file_get_contents($url, false, $context);
            
            if ($response === false) {
                return ['success' => false, 'error' => 'Failed to fetch exchange rates'];
            }
            
            $data = json_decode($response, true);
            
            if (!$data || empty($data['rates'])) {
                return ['success' => false, 'error' => 'Invalid API response'];
            }
            
            return [
                'success' => true,
                'base' => $data['base_code'] ?? $base,
                'rates' => $data['rates'],
                'updated' => $data['time_last_update_utc'] ?? date('Y-m-d H:i:s'),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * AJAX: Save/update a currency
     */
    public function actionSaveCurrency()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $post = Yii::$app->request->post();
        
        if (empty($post['currencyCode']) || empty($post['currencyName'])) {
            return ['success' => false, 'error' => 'Currency code and name are required'];
        }
        
        // Check if currency already exists
        $exists = Yii::$app->db->createCommand(
            'SELECT currencyId FROM tbl_currency WHERE currencyCode = :code',
            [':code' => $post['currencyCode']]
        )->queryScalar();
        
        if ($exists) {
            // Update existing
            Yii::$app->db->createCommand()->update('tbl_currency', [
                'currencyName' => $post['currencyName'],
                'currencySymbol' => $post['currencySymbol'] ?? '',
                'exchangeRate' => $post['exchangeRate'] ?? 0,
                'status' => 1,
                'update_datetime' => date('Y-m-d H:i:s'),
            ], ['currencyId' => $exists])->execute();
        } else {
            // Insert new
            Yii::$app->db->createCommand()->insert('tbl_currency', [
                'currencyCode' => $post['currencyCode'],
                'currencyName' => $post['currencyName'],
                'currencySymbol' => $post['currencySymbol'] ?? '',
                'exchangeRate' => $post['exchangeRate'] ?? 0,
                'status' => 1,
                'default_status' => 0,
                'create_datetime' => date('Y-m-d H:i:s'),
                'update_datetime' => date('Y-m-d H:i:s'),
            ])->execute();
        }
        
        return ['success' => true];
    }

    /**
     * AJAX: Delete a currency
     */
    public function actionDeleteCurrency()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $id = Yii::$app->request->post('currencyId');
        if (!$id) {
            return ['success' => false, 'error' => 'Missing currency ID'];
        }
        
        Yii::$app->db->createCommand()->update('tbl_currency', [
            'status' => 0,
        ], ['currencyId' => $id])->execute();
        
        return ['success' => true];
    }
}
