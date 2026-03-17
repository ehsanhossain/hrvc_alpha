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
     * Default — redirects to P&L Portal
     */
    public function actionIndex()
    {
        return $this->redirect(['pl-portal']);
    }

    /**
     * P&L Forecast Portal — main page
     * URL: /fs/default/pl-portal
     */
    public function actionPlPortal()
    {
        return $this->render('pl-forecast');
    }

    /**
     * Dashboard page
     */
    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    /**
     * PL Configuration page
     */
    public function actionConfiguration()
    {
        return $this->render('configuration');
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

    /**
     * Currency Management page
     */
    public function actionCurrencyManagement()
    {
        return $this->render('currency-management');
    }
}
