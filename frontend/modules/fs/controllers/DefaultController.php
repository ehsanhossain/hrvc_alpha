<?php

namespace frontend\modules\fs\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Default controller for the Financial System (Finlytics) module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * P&L Forecast page - default action
     */
    public function actionIndex()
    {
        return $this->render('pl-forecast');
    }

    /**
     * Golden Ratio page
     */
    public function actionGoldenRatio()
    {
        return $this->render('golden-ratio');
    }

    /**
     * Forecast Accounts page
     */
    public function actionForecastAccounts()
    {
        return $this->render('forecast-accounts');
    }
}
