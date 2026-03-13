<?php

namespace frontend\modules\fs\controllers;

use Yii;
use yii\web\Controller;
use frontend\modules\fs\helpers\FsSessionBridge;
use frontend\modules\fs\helpers\FsDbBridge;

class DefaultController extends Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->user->loginRequired();
            return false;
        }

        // Sync Yii2 user data to $_SESSION for FS pages
        FsSessionBridge::sync();

        return parent::beforeAction($action);
    }

    /**
     * Renders an FS page view with the mysqli connection available.
     */
    private function renderFsPage($viewName, $title = 'Financial System')
    {
        $this->view->title = $title;

        // Get base URLs for assets
        $homeUrl = Yii::$app->request->baseUrl . '/';
        $fsBase = $homeUrl . 'fs/';
        $connection = FsDbBridge::getConnection();

        // Register FS CSS
        $this->view->registerCssFile($fsBase . 'css/style.css', ['depends' => [\yii\web\JqueryAsset::class]]);
        $this->view->registerCssFile($fsBase . 'plugins/bootstrap-icons-1.11.3/font/bootstrap-icons.css');
        $this->view->registerCssFile($fsBase . 'plugins/select2-4.1.0-rc.0/dist/css/select2.css');
        $this->view->registerCssFile($fsBase . 'plugins/dropzone/dropzone.css');

        // Register FS JS (after jQuery)
        $this->view->registerJsFile($fsBase . 'js/popper.js', ['depends' => [\yii\web\JqueryAsset::class]]);
        $this->view->registerJsFile($fsBase . 'plugins/bootstrap-5.3.3/dist/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
        $this->view->registerJsFile($fsBase . 'plugins/Litepicker-master/litepicker.js', ['depends' => [\yii\web\JqueryAsset::class]]);
        $this->view->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11', ['depends' => [\yii\web\JqueryAsset::class]]);
        $this->view->registerJsFile($fsBase . 'plugins/select2-4.1.0-rc.0/dist/js/select2.js', ['depends' => [\yii\web\JqueryAsset::class]]);
        $this->view->registerJsFile($fsBase . 'plugins/dropzone/dropzone.js', ['depends' => [\yii\web\JqueryAsset::class]]);
        $this->view->registerJsFile($fsBase . 'js/custom.js', ['depends' => [\yii\web\JqueryAsset::class]]);

        // CompanyId for JS
        $companyId = $_SESSION['companyId'] ?? '';
        $this->view->registerJs("const companyId = '{$companyId}';", \yii\web\View::POS_HEAD);

        return $this->render($viewName, [
            'connection' => $connection,
            'fsBase' => $fsBase,
            'homeUrl' => $homeUrl,
        ]);
    }

    public function actionDashboard()
    {
        $this->view->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['depends' => [\yii\web\JqueryAsset::class]]);
        return $this->renderFsPage('dashboard', 'Financial Dashboard');
    }

    public function actionPlPortal()
    {
        return $this->renderFsPage('pl-portal', 'P&L Forecast Portal');
    }

    public function actionPlPortalEdit()
    {
        return $this->renderFsPage('pl-portal-edit', 'P&L Forecast Edit');
    }

    public function actionConfiguration()
    {
        return $this->renderFsPage('configuration', 'Financial Configuration');
    }

    public function actionGoldenRatio()
    {
        return $this->renderFsPage('golden-ratio', 'Golden Ratio');
    }

    public function actionForecastAccounts()
    {
        return $this->renderFsPage('forecast-accounts', 'Forecast Accounts');
    }

    public function actionCurrencyManagement()
    {
        return $this->renderFsPage('currency-management', 'Currency Management');
    }

    public function actionCurrencyRegister()
    {
        return $this->renderFsPage('currency-register', 'Currency Register');
    }

    public function actionHistory()
    {
        return $this->renderFsPage('history', 'Financial History');
    }

    public function actionHistoryCreate()
    {
        return $this->renderFsPage('history-create', 'Financial History Create');
    }

    public function actionComparisonAnalysis()
    {
        return $this->renderFsPage('comparison-analysis', 'Comparison Analysis');
    }

    public function actionAllExpandedView()
    {
        return $this->renderFsPage('all-expanded-view', 'All Expanded View');
    }
}
