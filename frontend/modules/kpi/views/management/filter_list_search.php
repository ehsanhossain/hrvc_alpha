<?php

use common\helpers\CompanyContext;
use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Team;

// If a company is selected in the header navbar, use it as the default filter
$contextCompanyId = CompanyContext::getCompanyId();
if (!empty($contextCompanyId) && empty($companyId)) {
    $companyId = $contextCompanyId;
}

?>

<div class="pim-search-box d-flex align-items-center">
    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/search.svg" class="pim-search-input-icon">
    <input type="text" class="form-control pim-search-input" id="pim-search" placeholder="<?= Yii::t('app', 'Search...') ?>" autocomplete="off" onkeyup="pimSearchFilter(this.value)">
</div>
<button type="button" class="pim-filter-trigger" onclick="pimOpenFilter()">
    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg">
    <?= Yii::t('app', 'Filter') ?>
</button>
<div class="btn-group <?= (Yii::$app->controller->action->id == 'draft' || Yii::$app->controller->action->id == 'draft-result') ? 'd-none' : '' ?>"
    role="group">
    <?php
    if ($page == 'grid') { ?>
        <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg" style="cursor: pointer; margin-top:2px;">
        </a>
        <a href="<?= Yii::$app->homeUrl . 'kpi/management/index' ?>"
            class="btn btn-outline-primary font-size-12 pim-change-modes" style="border-color: #CBD5E1 !important;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg" style="cursor: pointer; margin-top:2px;">
        </a>
    <?php
    } else { ?>
        <a href="<?= Yii::$app->homeUrl . 'kpi/management/grid' ?>"
            class="btn btn-outline-primary font-size-12 pim-change-modes" style="border-color: #CBD5E1 !important;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg" style="cursor: pointer; margin-top:2px;">
        </a>
        <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listwhite.svg" style="cursor: pointer; margin-top:2px;">
        </a>
    <?php
    }
    ?>
</div>

<!-- Filter Drawer -->
<div class="pim-filter-overlay" id="pim-filter-overlay" onclick="pimCloseFilter()"></div>
<div class="pim-filter-drawer" id="pim-filter-drawer">
    <div class="pim-filter-drawer-header">
        <h3>
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" style="width:18px;height:18px;filter:brightness(0.3);">
            <?= Yii::t('app', 'Filter Options') ?>
        </h3>
        <button class="pim-filter-drawer-close" onclick="pimCloseFilter()">&times;</button>
    </div>
    <div class="pim-filter-drawer-body">
        <div>
            <label><?= Yii::t('app', 'Company') ?></label>
            <select id="company-filter">
                <?php
                if (isset($companyId) && $companyId != "") { ?>
                    <option value="<?= $companyId ?>"><?= Company::companyName($companyId) ?></option>
                <?php
                }
                if (isset($companies) && count($companies) > 0) { ?>
                    <option value=""><?= Yii::t('app', 'All Companies') ?></option>
                    <?php
                    foreach ($companies as $company) :
                        if ($role <= 4) {
                            if (isset($employeeCompanyId) && $employeeCompanyId != "" && $employeeCompanyId == $company["companyId"] && !isset($companyId)) {
                    ?>
                                <option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
                            <?php
                            }
                        } else { ?>
                            <option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
                        <?php
                        }
                    endforeach;
                }
                ?>
            </select>
        </div>
        <div>
            <label><?= Yii::t('app', 'Branch') ?></label>
            <select id="branch-filter" <?= $branchId == "" ? 'disabled' : '' ?>>
                <?php
                if (isset($branchId) && $branchId != "") { ?>
                    <option value="<?= $branchId ?>"><?= Branch::branchName($branchId) ?></option>
                <?php
                }
                ?>
                <option value=""><?= Yii::t('app', 'All Branches') ?></option>
                <?php
                if (isset($branches) && count($branches) > 0) {
                    foreach ($branches as $branch) : ?>
                        <option value="<?= $branch['branchId'] ?>"><?= $branch['branchName'] ?></option>
                <?php
                    endforeach;
                }
                ?>
            </select>
        </div>
        <div>
            <label><?= Yii::t('app', 'Month') ?></label>
            <select id="month-filter">
                <?php
                if (isset($month) && $month != "") { ?>
                    <option value="<?= $month ?>"><?= ModelMaster::monthFull()[$month] ?></option>
                <?php
                }
                ?>
                <option value=""><?= Yii::t('app', 'All Months') ?></option>
                <?php
                if (isset($months) && count($months) > 0) {
                    foreach ($months as $value => $month) : ?>
                        <option value="<?= $value ?>"><?= $month ?></option>
                <?php
                    endforeach;
                }
                ?>
            </select>
        </div>
        <div>
            <label><?= Yii::t('app', 'Year') ?></label>
            <select id="year-filter">
                <?php
                if (isset($yearSelected) && $yearSelected != "") { ?>
                    <option value="<?= $yearSelected ?>"><?= $yearSelected ?></option>
                <?php
                }
                ?>
                <option value=""><?= Yii::t('app', 'All Years') ?></option>
                <?php
                $year = 2022;
                $i = 1;
                while ($i < 20) {
                    if ($year != $yearSelected) {
                ?>
                        <option value="<?= $year ?>"><?= $year ?></option>
                <?php
                    }
                    $year += 1;
                    $i++;
                }
                ?>
            </select>
        </div>
        <div>
            <label><?= Yii::t('app', 'Status') ?></label>
            <select id="status-filter">
                <?php
                if (isset($status) && $status != "") {
                    if ($status == 1) { $text = 'In Progress'; }
                    if ($status == 2) { $text = 'Completed'; }
                    if ($status == 3) { $text = 'Due Passed'; }
                    if ($status == 4) { $text = 'Not Set'; }
                ?>
                    <option value="<?= $status ?>"><?= $text ?></option>
                <?php
                }
                ?>
                <option value=""><?= Yii::t('app', 'All Statuses') ?></option>
                <option value="1"><?= Yii::t('app', 'In Progress') ?></option>
                <option value="3"><?= Yii::t('app', 'Due Passed') ?></option>
                <option value="4"><?= Yii::t('app', 'Not Set') ?></option>
                <option value="2"><?= Yii::t('app', 'Completed') ?></option>
            </select>
        </div>
    </div>
    <div class="pim-filter-drawer-footer">
        <button class="pim-filter-apply-btn" onclick="kpiFilter(); pimCloseFilter();">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" style="width:14px;height:14px;filter:brightness(10);">
            <?= Yii::t('app', 'Apply Filter') ?>
        </button>
        <button class="pim-filter-reset-btn" onclick="pimResetFilters()" title="<?= Yii::t('app', 'Reset') ?>">&#8634;</button>
    </div>
</div>

<script>
    function applySelectStyle(selectElement) {
        if (selectElement.value) {
            selectElement.classList.remove('select-pim');
            selectElement.classList.add('select-pimselect');
        } else {
            selectElement.classList.remove('select-pimselect');
            selectElement.classList.add('select-pim');
        }
    }

    function pimOpenFilter() {
        document.getElementById('pim-filter-overlay').classList.add('active');
        document.getElementById('pim-filter-drawer').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function pimCloseFilter() {
        document.getElementById('pim-filter-overlay').classList.remove('active');
        document.getElementById('pim-filter-drawer').classList.remove('active');
        document.body.style.overflow = '';
    }

    function pimResetFilters() {
        var selects = document.querySelectorAll('#pim-filter-drawer select');
        selects.forEach(function(s) {
            s.selectedIndex = 0;
            s.value = '';
        });
    }

    function pimSearchFilter(query) {
        query = query.toLowerCase().trim();
        var rows = document.querySelectorAll('#main-body tbody tr');
        var prevSpacerHidden = false;
        rows.forEach(function(row) {
            if (row.querySelector('.pim-div-border')) {
                var name = row.textContent.toLowerCase();
                var show = name.includes(query);
                row.style.display = show ? '' : 'none';
                prevSpacerHidden = !show;
            } else if (row.getAttribute('height') === '10') {
                row.style.display = prevSpacerHidden ? 'none' : '';
            }
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') pimCloseFilter();
    });
</script>