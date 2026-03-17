<?php
/** @var yii\web\View $this */
$this->title = 'Currency Management — Finlytics';
$this->registerCssFile(Yii::$app->homeUrl . 'css/finlytics.css', ['depends' => [\frontend\assets\AppAsset::class]]);
?>
<div class="finlytics-module">
    <div class="fl-title-bar">
        <div class="fl-title-icon">
            <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="#30313D" stroke-width="1.5"/><path d="M8 15V11M12 15V9M16 15V7" stroke="#30313D" stroke-width="1.5" stroke-linecap="round"/></svg>
        </div>
        <div class="fl-title-text">Finlytics</div>
    </div>
    <div class="fl-tab-bar">
        <a href="<?= \yii\helpers\Url::to(['/fs/default/pl-portal']) ?>" class="fl-tab">
            <div class="fl-tab-inner"><span class="fl-tab-label">P&L Forecast</span></div>
            <div class="fl-tab-underline"></div>
        </a>
        <a href="<?= \yii\helpers\Url::to(['/fs/default/golden-ratio']) ?>" class="fl-tab">
            <div class="fl-tab-inner"><span class="fl-tab-label">Golden Ratio</span></div>
            <div class="fl-tab-underline"></div>
        </a>
        <a href="<?= \yii\helpers\Url::to(['/fs/default/forecast-accounts']) ?>" class="fl-tab">
            <div class="fl-tab-inner"><span class="fl-tab-label">Forecast Accounts</span></div>
            <div class="fl-tab-underline"></div>
        </a>
    </div>
    <div class="fl-card" style="min-height:400px;display:flex;align-items:center;justify-content:center;">
        <div style="text-align:center;color:#8B8B8B;">
            <svg width="64" height="64" viewBox="0 0 64 64" fill="none"><circle cx="32" cy="32" r="20" stroke="#CBD5E1" stroke-width="2"/><path d="M32 20v24M26 26h12M24 32h16M26 38h12" stroke="#CBD5E1" stroke-width="1.5" stroke-linecap="round"/></svg>
            <p style="margin-top:16px;font-size:18px;font-weight:500;">Currency Management</p>
            <p style="font-size:14px;">Coming soon — Figma screen pending</p>
        </div>
    </div>
</div>
