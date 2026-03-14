<?php
use common\helpers\CompanyContext;
$contextCompanyId = CompanyContext::getCompanyId();
if (!empty($contextCompanyId) && empty($companyId)) {
    $companyId = $contextCompanyId;
}
?>
<div class="row">
    <div class="col-12 d-flex align-items-center gap-2 mb-2">
        <div class="pim-search-box d-flex align-items-center">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/search.svg" class="pim-search-input-icon">
            <input type="text" class="form-control pim-search-input" id="pim-search" placeholder="<?= Yii::t('app', 'Search...') ?>" autocomplete="off" onkeyup="pimSearchFilter(this.value)">
        </div>
        <button type="button" class="pim-filter-trigger" onclick="pimOpenFilter()">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg">
            <?= Yii::t('app', 'Filter') ?>
        </button>
    </div>
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
            <select id="company-filter" onchange="applySelectStyle(this)">
                <option value=""><?= Yii::t('app', 'All Companies') ?></option>
                <?php
                if (isset($companies) && count($companies) > 0) {
                    foreach ($companies as $company) :
                        if ($role <= 4) {
                            if ($companyId == $company["companyId"]) {
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
            <select id="branch-filter" disabled onchange="applySelectStyle(this)">
                <option value=""><?= Yii::t('app', 'All Branches') ?></option>
            </select>
        </div>
        <div>
            <label><?= Yii::t('app', 'Month') ?></label>
            <select id="month-filter" onchange="applySelectStyle(this)">
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
            <select id="year-filter" onchange="applySelectStyle(this)">
                <option value=""><?= Yii::t('app', 'All Years') ?></option>
                <?php
                $year = 2022;
                $i = 1;
                while ($i < 20) {
                ?>
                    <option value=" <?= $year ?>"><?= $year ?></option>
                <?php
                    $year += 1;
                    $i++;
                }
                ?>
            </select>
        </div>
        <div>
            <label><?= Yii::t('app', 'Status') ?></label>
            <select id="status-filter" onchange="applySelectStyle(this)">
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
            applySelectStyle(s);
        });
    }

    function pimSearchFilter(query) {
        query = query.toLowerCase().trim();
        var items = document.querySelectorAll('.pim-big-box');
        if (items.length > 0) {
            items.forEach(function(item) {
                var nameEl = item.querySelector('.pim-name');
                var name = nameEl ? nameEl.textContent.toLowerCase() : '';
                item.style.display = name.includes(query) ? '' : 'none';
            });
        } else {
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
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') pimCloseFilter();
    });
</script>