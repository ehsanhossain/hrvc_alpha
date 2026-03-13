<?php

use common\helpers\Path;
use common\models\ModelMaster;
use frontend\models\hrvc\UserRole;

$session = Yii::$app->session;
$role = UserRole::userRight();
$isHr = UserRole::isHr();
$homeUrl = Yii::$app->homeUrl;

// ─── Module Definitions ──────────────────────────────────────────
$modules = [
    'organization' => [
        'id' => 'organization',
        'name' => Yii::t('app', 'Organization'),
        'subtitle' => Yii::t('app', 'Workspace Management'),
        'icon' => $homeUrl . 'images/icons/white-icons/MasterSetting/group.svg',
        'color' => '#4F8CFF',
        'roleMin' => 2,
        'sections' => [
            [
                'label' => Yii::t('app', 'MANAGEMENT'),
                'items' => array_filter([
                    ($role >= 5) ? ['label' => Yii::t('app', 'Group Configuration'), 'icon' => $homeUrl . 'images/icons/white-icons/MasterSetting/group.svg', 'url' => $homeUrl . 'setting/group/display-group'] : null,
                    ($role >= 5) ? ['label' => Yii::t('app', 'Company Information'), 'icon' => $homeUrl . 'images/icons/white-icons/MasterSetting/company.svg', 'url' => $homeUrl . 'setting/company/display-company'] : null,
                    ($role >= 5) ? ['label' => Yii::t('app', 'Branch'), 'icon' => $homeUrl . 'images/icons/white-icons/others/branch.svg', 'url' => $homeUrl . 'setting/branch/no-branch/' . ModelMaster::encodeParams(['companyId' => ''])] : null,
                    ($role >= 5) ? ['label' => Yii::t('app', 'Department'), 'icon' => $homeUrl . 'images/icons/white-icons/MasterSetting/department.svg', 'url' => $homeUrl . 'setting/department/no-department/' . ModelMaster::encodeParams(['branchId' => ''])] : null,
                    ($role >= 5) ? ['label' => Yii::t('app', 'Title'), 'icon' => $homeUrl . 'images/icons/white-icons/MasterSetting/title.svg', 'url' => $homeUrl . 'setting/title/no-title/' . ModelMaster::encodeParams(['departmentId' => ''])] : null,
                    ($role >= 5) ? ['label' => Yii::t('app', 'Team'), 'icon' => $homeUrl . 'images/icons/white-icons/MasterSetting/team.svg', 'url' => $homeUrl . 'setting/team/no-team/' . ModelMaster::encodeParams(['departmentId' => ''])] : null,
                    ($isHr == 1 || $role >= 5) ? ['label' => Yii::t('app', 'Employee'), 'icon' => $homeUrl . 'images/icons/white-icons/BehavioralEvaluation/my_portal.svg', 'url' => $homeUrl . 'setting/employee/no-employee/' . ModelMaster::encodeParams(['companyId' => ''])] : null,
                ]),
            ],
        ],
    ],
    'pim' => [
        'id' => 'pim',
        'name' => Yii::t('app', 'PIM'),
        'subtitle' => Yii::t('app', 'Performance Indicators'),
        'icon' => $homeUrl . 'images/icons/white-icons/PerformanceMatrices/performance.svg',
        'color' => '#34C759',
        'roleMin' => 0,
        'sections' => [
            [
                'label' => Yii::t('app', 'DASHBOARD'),
                'items' => [
                    ['label' => Yii::t('app', 'Dashboard'), 'icon' => $homeUrl . 'images/icons/white-icons/FinancialSystem/dashboard.svg', 'url' => $homeUrl . 'home/default/dashboard'],
                ],
            ],
            [
                'label' => Yii::t('app', 'FINANCIALS'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'Financials'), 'icon' => $homeUrl . 'images/icons/white-icons/PerformanceMatrices/KFI.svg', 'url' => $homeUrl . 'kfi/management/grid',
                        'children' => [
                            ['label' => Yii::t('app', 'Company KFI'), 'icon' => $homeUrl . 'images/icons/white-icons/PerformanceMatrices/company.svg', 'url' => $homeUrl . 'kfi/management/grid'],
                        ],
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'GOALS'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'Goals'), 'icon' => $homeUrl . 'images/icons/white-icons/PerformanceMatrices/KGI.svg', 'url' => $homeUrl . 'kgi/management/grid',
                        'children' => [
                            ['label' => Yii::t('app', 'Company KGI'), 'icon' => $homeUrl . 'images/icons/white-icons/PerformanceMatrices/company.svg', 'url' => $homeUrl . 'kgi/management/grid'],
                            ['label' => Yii::t('app', 'Team KGI'), 'icon' => $homeUrl . 'images/icons/white-icons/PerformanceMatrices/team.svg', 'url' => $homeUrl . 'kgi/kgi-team/team-kgi-grid'],
                            ['label' => Yii::t('app', 'Self KGI'), 'icon' => $homeUrl . 'images/icons/white-icons/PerformanceMatrices/self.svg', 'url' => $homeUrl . 'kgi/kgi-personal/individual-kgi-grid'],
                        ],
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'PERFORMANCE'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'Performance'), 'icon' => $homeUrl . 'images/icons/white-icons/PerformanceMatrices/KPI.svg', 'url' => $homeUrl . 'kpi/management/grid',
                        'children' => [
                            ['label' => Yii::t('app', 'Company KPI'), 'icon' => $homeUrl . 'images/icons/white-icons/PerformanceMatrices/company.svg', 'url' => $homeUrl . 'kpi/management/grid'],
                            ['label' => Yii::t('app', 'Team KPI'), 'icon' => $homeUrl . 'images/icons/white-icons/PerformanceMatrices/team.svg', 'url' => $homeUrl . 'kpi/kpi-team/team-kpi-grid'],
                            ['label' => Yii::t('app', 'Self KPI'), 'icon' => $homeUrl . 'images/icons/white-icons/PerformanceMatrices/self.svg', 'url' => $homeUrl . 'kpi/kpi-personal/individual-kpi-grid'],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'appraisal360' => [
        'id' => 'appraisal360',
        'name' => Yii::t('app', 'Appraisal360'),
        'subtitle' => Yii::t('app', 'Performance Management'),
        'icon' => $homeUrl . 'images/icons/white-icons/Evaluation/evaluation_system.svg',
        'color' => '#FF9F0A',
        'roleMin' => 0,
        'sections' => [
            [
                'label' => Yii::t('app', 'DASHBOARD'),
                'items' => [
                    ['label' => Yii::t('app', 'Evaluation Hub'), 'icon' => $homeUrl . 'images/icons/white-icons/Evaluation/evaluation_system.svg', 'url' => $homeUrl . 'evaluation/environment/index'],
                    ['label' => Yii::t('app', 'My Dashboard'), 'icon' => $homeUrl . 'images/icons/white-icons/FinancialSystem/dashboard.svg', 'url' => $homeUrl . 'home/default/dashboard'],
                ],
            ],
            [
                'label' => Yii::t('app', 'EVALUATION'),
                'items' => [
                    ['label' => Yii::t('app', 'Evaluation Dashboard'), 'icon' => $homeUrl . 'images/icons/white-icons/Evaluation/progress.svg', 'url' => ''],
                    ['label' => Yii::t('app', 'Active Evaluation'), 'icon' => $homeUrl . 'images/icons/white-icons/Evaluation/performance.svg', 'url' => ''],
                    ['label' => Yii::t('app', 'Create Evaluation'), 'icon' => $homeUrl . 'images/icons/white-icons/Evaluation/evaluation_system.svg', 'url' => ''],
                    ['label' => Yii::t('app', 'History'), 'icon' => $homeUrl . 'images/icons/white-icons/Evaluation/salary.svg', 'url' => ''],
                    ['label' => Yii::t('app', 'Rank Setup'), 'icon' => $homeUrl . 'images/icons/white-icons/Evaluation/company.svg', 'url' => ''],
                    ['label' => Yii::t('app', 'Results & Reports'), 'icon' => $homeUrl . 'images/icons/white-icons/Evaluation/self.svg', 'url' => ''],
                ],
            ],
            [
                'label' => Yii::t('app', 'COMPENSATION'),
                'items' => [
                    ['label' => Yii::t('app', 'Salary Sheet'), 'icon' => $homeUrl . 'images/icons/white-icons/Evaluation/salary.svg', 'url' => $homeUrl . 'evaluation/salary/salary-sheet'],
                    ['label' => Yii::t('app', 'Bonus'), 'icon' => $homeUrl . 'images/icons/white-icons/Evaluation/company.svg', 'url' => ''],
                ],
            ],
        ],
    ],
    'finance' => [
        'id' => 'finance',
        'name' => Yii::t('app', 'Finance'),
        'subtitle' => Yii::t('app', 'Financial Planning'),
        'icon' => $homeUrl . 'images/icons/white-icons/FinancialSystem/fs.svg',
        'color' => '#AF52DE',
        'roleMin' => 0,
        'sections' => [
            [
                'label' => Yii::t('app', 'PLANNING'),
                'items' => [
                    ['label' => Yii::t('app', 'Dashboard'), 'icon' => $homeUrl . 'images/icons/white-icons/FinancialSystem/dashboard.svg', 'url' => $homeUrl . 'fs/default/dashboard'],
                    ['label' => Yii::t('app', 'PL Forecast'), 'icon' => $homeUrl . 'images/icons/white-icons/FinancialSystem/pl_forecase.svg', 'url' => $homeUrl . 'fs/planning/index'],
                    ['label' => Yii::t('app', 'PL Configuration'), 'icon' => $homeUrl . 'images/icons/white-icons/FinancialSystem/pl_config.svg', 'url' => $homeUrl . 'fs/config/index'],
                ],
            ],
            [
                'label' => Yii::t('app', 'ANALYSIS'),
                'items' => [
                    ['label' => Yii::t('app', 'Golden Ratio'), 'icon' => $homeUrl . 'images/icons/white-icons/FinancialSystem/golden.svg', 'url' => $homeUrl . 'fs/planning/index'],
                    ['label' => Yii::t('app', 'Forecast Account'), 'icon' => $homeUrl . 'images/icons/white-icons/FinancialSystem/forecast_account.svg', 'url' => $homeUrl . 'fs/config/pl-flow'],
                    ['label' => Yii::t('app', 'Currency Management'), 'icon' => $homeUrl . 'images/icons/white-icons/FinancialSystem/currency.svg', 'url' => $homeUrl . 'fs/default/dashboard'],
                ],
            ],
        ],
    ],
];

// Pass modules as JSON for JS
$modulesJson = json_encode($modules);

// Current URL for active item detection
$currentUrl = Yii::$app->request->url;
?>

<div class="sidebar-inner">
    <!-- ─── Logo ─── -->
    <div class="sidebar-logo-section">
        <a href="<?= $homeUrl ?>site/index">
            <div class="sidebar-logo-wrap">
                <img src="<?= $homeUrl ?>image/hrvc-logo.svg" class="main-logo sidebar-logo-full" style="max-width:120px;">
                <img src="<?= $homeUrl ?>image/hrvc-collapsed-logo.svg" class="main-logo sidebar-logo-collapsed" style="max-width:28px;display:none;">
            </div>
        </a>
    </div>

    <!-- ─── Module Selector ─── -->
    <div class="module-selector" id="moduleSelector" onclick="toggleModuleDropdown(event)">
        <div class="module-selector-inner">
            <div class="module-selector-icon" id="moduleSelectorIcon">
                <img src="" id="moduleSelectorImg" width="20" height="20">
            </div>
            <div class="module-selector-info sidebar-text-hide">
                <span class="module-selector-name" id="moduleSelectorName"></span>
                <span class="module-selector-subtitle" id="moduleSelectorSubtitle"></span>
            </div>
            <div class="module-selector-chevron sidebar-text-hide">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M3 5L6 8L9 5" stroke="rgba(255,255,255,0.6)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
        </div>
        <!-- Dropdown -->
        <div class="module-dropdown" id="moduleDropdown">
            <?php foreach ($modules as $mod): ?>
                <?php if ($mod['roleMin'] <= $role): ?>
                <div class="module-dropdown-item" data-module="<?= $mod['id'] ?>" onclick="switchModule('<?= $mod['id'] ?>', event)">
                    <div class="module-dropdown-icon" style="background: <?= $mod['color'] ?>20;">
                        <img src="<?= $mod['icon'] ?>" width="18" height="18">
                    </div>
                    <div class="module-dropdown-info">
                        <span class="module-dropdown-name"><?= $mod['name'] ?></span>
                        <span class="module-dropdown-subtitle"><?= $mod['subtitle'] ?></span>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ─── Home Button ─── -->
    <a href="<?= $homeUrl ?>site/index" class="sidebar-home-btn">
        <img src="<?= $homeUrl ?>images/icons/white-icons/others/home.svg" width="18" height="18">
        <span class="sidebar-text-hide"><?= Yii::t('app', 'Home') ?></span>
    </a>

    <!-- ─── Dynamic Menu Area ─── -->
    <div class="sidebar-menu-area" id="sidebarMenuArea">
        <?php foreach ($modules as $mod): ?>
            <?php if ($mod['roleMin'] <= $role): ?>
            <div class="sidebar-module-panel" id="panel-<?= $mod['id'] ?>" style="display: none;">
                <?php foreach ($mod['sections'] as $sIdx => $section): ?>
                    <?php if (!empty($section['items'])): ?>
                    <div class="sidebar-section">
                        <div class="sidebar-section-label sidebar-text-hide" onclick="toggleSidebarSection(this)">
                            <?= $section['label'] ?>
                            <svg class="sidebar-section-chevron" width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2.5 4L5 6.5L7.5 4" stroke="rgba(255,255,255,0.35)" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div class="sidebar-section-items">
                            <?php foreach ($section['items'] as $item): ?>
                                <?php
                                    $isActive = !empty($item['url']) && $item['url'] !== '#' && strpos($currentUrl, parse_url($item['url'], PHP_URL_PATH) ?: '') !== false;
                                    $hasChildren = !empty($item['children']);
                                    $childId = $mod['id'] . '-' . $sIdx . '-' . preg_replace('/[^a-z0-9]/', '', strtolower($item['label']));
                                ?>
                                <div class="sidebar-item-group">
                                    <a href="<?= !empty($item['url']) ? $item['url'] : 'javascript:void(0)' ?>"
                                       class="sidebar-item <?= $isActive ? 'active' : '' ?>"
                                       <?= $hasChildren ? 'onclick="toggleChildren(event, \'' . $childId . '\')"' : '' ?>>
                                        <img src="<?= $item['icon'] ?>" class="sidebar-item-icon" width="16" height="16">
                                        <span class="sidebar-text-hide"><?= $item['label'] ?></span>
                                        <?php if ($hasChildren): ?>
                                            <svg class="sidebar-item-chevron sidebar-text-hide" width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2.5 4L5 6.5L7.5 4" stroke="rgba(255,255,255,0.4)" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <?php endif; ?>
                                    </a>
                                    <?php if ($hasChildren): ?>
                                        <div class="sidebar-children" id="<?= $childId ?>">
                                            <?php foreach ($item['children'] as $child): ?>
                                                <?php $childActive = !empty($child['url']) && $child['url'] !== '#' && strpos($currentUrl, parse_url($child['url'], PHP_URL_PATH) ?: '') !== false; ?>
                                                <a href="<?= $child['url'] ?>" class="sidebar-child-item <?= $childActive ? 'active' : '' ?>">
                                                    <img src="<?= $child['icon'] ?>" class="sidebar-child-icon" width="14" height="14">
                                                    <span class="sidebar-text-hide"><?= $child['label'] ?></span>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- ─── Bottom Settings ─── -->
    <div class="sidebar-bottom">
        <a href="<?= $homeUrl ?>language/default/index" class="sidebar-home-btn">
            <img src="<?= $homeUrl ?>images/icons/white-icons/others/8.svg" width="18" height="18">
            <span class="sidebar-text-hide"><?= Yii::t('app', 'Settings') ?></span>
        </a>
    </div>
</div>

<script>
// Module data
var HRVC_MODULES = <?= $modulesJson ?>;
var HRVC_CURRENT_MODULE = localStorage.getItem('hrvc_active_module') || 'pim';

// Initialize sidebar on load
document.addEventListener('DOMContentLoaded', function() {
    // Validate saved module
    if (!document.getElementById('panel-' + HRVC_CURRENT_MODULE)) {
        HRVC_CURRENT_MODULE = Object.keys(HRVC_MODULES)[0] || 'pim';
    }
    activateModule(HRVC_CURRENT_MODULE);
    highlightActiveItems();
});

function activateModule(moduleId) {
    var mod = HRVC_MODULES[moduleId];
    if (!mod) return;

    // Update selector display
    document.getElementById('moduleSelectorImg').src = mod.icon;
    document.getElementById('moduleSelectorName').textContent = mod.name;
    document.getElementById('moduleSelectorSubtitle').textContent = mod.subtitle;
    document.getElementById('moduleSelectorIcon').style.background = mod.color + '25';

    // Show only the selected module's panel
    var panels = document.querySelectorAll('.sidebar-module-panel');
    panels.forEach(function(p) { p.style.display = 'none'; });
    var activePanel = document.getElementById('panel-' + moduleId);
    if (activePanel) activePanel.style.display = 'block';

    // Highlight active dropdown item
    var items = document.querySelectorAll('.module-dropdown-item');
    items.forEach(function(item) {
        item.classList.toggle('active', item.getAttribute('data-module') === moduleId);
    });

    HRVC_CURRENT_MODULE = moduleId;
    localStorage.setItem('hrvc_active_module', moduleId);
}

function switchModule(moduleId, e) {
    if (e) e.stopPropagation();
    activateModule(moduleId);
    closeModuleDropdown();
}

function toggleModuleDropdown(e) {
    e.stopPropagation();
    var dd = document.getElementById('moduleDropdown');
    dd.classList.toggle('open');
}

function closeModuleDropdown() {
    var dd = document.getElementById('moduleDropdown');
    if (dd) dd.classList.remove('open');
}

function toggleChildren(e, childId) {
    e.preventDefault();
    e.stopPropagation();
    var el = document.getElementById(childId);
    if (el) {
        el.classList.toggle('open');
        // Rotate chevron
        var chevron = e.currentTarget.querySelector('.sidebar-item-chevron');
        if (chevron) chevron.classList.toggle('rotated');
    }
}

function toggleSidebarSection(el) {
    var items = el.nextElementSibling;
    var chevron = el.querySelector('.sidebar-section-chevron');
    if (items) items.classList.toggle('collapsed');
    if (chevron) chevron.classList.toggle('rotated');
}

function highlightActiveItems() {
    var path = window.location.pathname;
    document.querySelectorAll('.sidebar-item, .sidebar-child-item').forEach(function(a) {
        var href = a.getAttribute('href');
        if (href && href !== '#' && href !== 'javascript:void(0)' && path.indexOf(href.replace(/^https?:\/\/[^\/]+/, '')) !== -1) {
            a.classList.add('active');
            // Expand parent children container if it's a child item
            var parent = a.closest('.sidebar-children');
            if (parent) parent.classList.add('open');
        }
    });
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('#moduleSelector')) {
        closeModuleDropdown();
    }
});
</script>