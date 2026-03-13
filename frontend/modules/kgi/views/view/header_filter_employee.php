<div class="d-flex header-filter-pim">
    <div class="pim-head-upderline d-flex align-items-start justify-content-start">

        <div class="header-kgi-active">
            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid" style="text-decoration: none;color: #3C3D48;">
                <span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KGI.svg"
                        class="mr-5 pim-filter-head-icon">
                </span>
                <?= Yii::t('app', 'Key Goal Indicator') ?>
            </a>
        </div>
        <div class="pim-center-line"></div>
        <div class="pim-type-box" style="min-width:235px;">
            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid" style="text-decoration: none;color: #30313D;">
                <span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KPI.svg"
                        class="mr-5 pim-filter-head-icon">
                </span>
                <?= Yii::t('app', 'Key Performance Indicator') ?>
            </a>
        </div>
    </div>
</div>