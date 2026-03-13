<?php

namespace frontend\modules\fs\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use frontend\modules\fs\helpers\FsSessionBridge;
use frontend\modules\fs\helpers\FsDbBridge;

/**
 * AjaxController proxies AJAX requests to the original FS PHP files.
 * 
 * URL pattern: /fs/ajax?module=FinancialDashboard&action=getData
 * Maps to: frontend/modules/fs/ajax/FinancialDashboard/getData.php
 */
class AjaxController extends Controller
{
    /**
     * Disable CSRF for AJAX calls (FS module uses its own validation)
     */
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->response->statusCode = 401;
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->response->data = ['error' => 'Unauthorized'];
            return false;
        }

        FsSessionBridge::sync();
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $module = Yii::$app->request->get('module', '');
        $act = Yii::$app->request->get('act', '');

        // Sanitize - only allow alphanumeric and underscores
        $module = preg_replace('/[^a-zA-Z0-9_]/', '', $module);
        $act = preg_replace('/[^a-zA-Z0-9_]/', '', $act);

        if (empty($module) || empty($act)) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Missing module or action parameter'];
        }

        $ajaxDir = Yii::getAlias('@frontend/modules/fs/ajax');
        $filePath = $ajaxDir . '/' . $module . '/' . $act . '.php';

        if (!file_exists($filePath)) {
            Yii::$app->response->statusCode = 404;
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'AJAX endpoint not found: ' . $module . '/' . $act];
        }

        // Setup the environment the FS AJAX files expect
        $secure = "-%ekla!(m09)%1A7";
        $connection = FsDbBridge::getConnection();

        // Make connection available to the included file
        // The AJAX files call connectDB() from main_function.php
        // We override that by providing $connection directly

        // Capture output
        ob_start();
        
        // Change directory so relative includes work
        $originalDir = getcwd();
        chdir(dirname($filePath));
        
        try {
            include $filePath;
        } catch (\Throwable $e) {
            ob_end_clean();
            chdir($originalDir);
            Yii::$app->response->statusCode = 500;
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => $e->getMessage()];
        }
        
        $output = ob_get_clean();
        chdir($originalDir);

        // Determine response type
        $decoded = json_decode($output, true);
        if ($decoded !== null) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $decoded;
        }

        // HTML response
        Yii::$app->response->format = Response::FORMAT_RAW;
        return $output;
    }
}
