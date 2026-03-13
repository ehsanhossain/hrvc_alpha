<?php
/**
 * @var yii\web\View $this
 * @var mysqli $connection
 * @var string $fsBase
 * @var string $homeUrl
 */

$ajaxBaseUrl = Yii::$app->urlManager->createUrl(['fs/ajax/index']);
$jsSetup = <<<JS
$.ajaxPrefilter(function(options, originalOptions, jqXHR) {
    if (options.url && options.url.indexOf('ajax/') === 0) {
        var parts = options.url.replace('ajax/', '').replace('.php', '').split('/');
        if (parts.length === 2) {
            options.url = '{$ajaxBaseUrl}' + ('{$ajaxBaseUrl}'.indexOf('?') > -1 ? '&' : '?') + 'module=' + parts[0] + '&act=' + parts[1];
        }
    }
});
JS;
$this->registerJs($jsSetup, \yii\web\View::POS_READY);

$financialDir = Yii::getAlias('@frontend/modules/fs/financial');
chdir($financialDir);
include($financialDir . '/FinancialProfitLossPortalEdit.php');
?>
