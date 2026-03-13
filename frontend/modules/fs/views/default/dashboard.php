<?php
/**
 * @var yii\web\View $this
 * @var mysqli $connection
 * @var string $fsBase
 * @var string $homeUrl
 */

// Set up the AJAX base URL rewriting script
$ajaxBaseUrl = Yii::$app->urlManager->createUrl(['fs/ajax/index']);
$jsSetup = <<<JS
// Rewrite FS AJAX relative URLs to Yii2 AJAX proxy
$.ajaxPrefilter(function(options, originalOptions, jqXHR) {
    if (options.url && options.url.indexOf('ajax/') === 0) {
        // Extract module and action from path like 'ajax/FinancialDashboard/getData.php'
        var parts = options.url.replace('ajax/', '').replace('.php', '').split('/');
        if (parts.length === 2) {
            options.url = '{$ajaxBaseUrl}' + ('{$ajaxBaseUrl}'.indexOf('?') > -1 ? '&' : '?') + 'module=' + parts[0] + '&act=' + parts[1];
        }
    }
});
JS;
$this->registerJs($jsSetup, \yii\web\View::POS_READY);

// Include the original page file
$financialDir = Yii::getAlias('@frontend/modules/fs/financial');
chdir($financialDir);
include($financialDir . '/FinancialDashboard.php');
?>
