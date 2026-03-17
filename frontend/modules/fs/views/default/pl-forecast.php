<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'P&L Forecast — Finlytics';

// Register CSS
$this->registerCssFile(Yii::$app->homeUrl . 'css/finlytics.css', ['depends' => [\frontend\assets\AppAsset::class]]);

// ─── Static demo data ───────────────────────────────────────────────
$currentYear = 2024;
$plContents = [
    'Sales', 'Variable Expense', 'Gross Profit (or Loss)', 'Labour Cost',
    'Fixed Expense (Other)', 'Fixed Expense', 'Operating Profit (or Lo..)',
    'Non-Operating Incom..', 'Break-even Sales', 'EBITDA', 'COGS',
    'Loan', 'Cashflow', 'Other Expenses', 'Other Costs',
    'Foreign Income', 'Inward Remittance', 'Outward Remittance', 'Discounts'
];

// indicator percentages for each row (LP, CP, CT, NT)
$indicators = [
    [71, 12, 100, 120], [71, 12, 100, 120], [71, 12, 100, 120],
    [71, 12, 100, 120], [71, 12, 100, 120], [71, 12, 100, 120],
    [71, 12, 100, 120], [71, 12, 100, 120], [71, 12, 100, 120],
    [71, 12, 100, 120], [71, 12, 100, 120], [71, 12, 100, 120],
    [71, 12, 100, 120], [71, 12, 100, 120], [71, 12, 100, 120],
    [71, 12, 100, 120], [71, 12, 100, 120], [71, 12, 100, 120],
    [71, 12, 100, 120],
];

$months = ['January', 'February', 'March'];
$quarters = [
    ['label' => '1st Quarter', 'months' => ['January', 'February', 'March']],
];

// Sample data for each cell (two rows per cell: row1 and row2)
$cellData = [
    ['21.9m', '0', '0.8m', '0.00078m'],
    ['11.6m', '0', '0.9m', '0.872m'],
];

// Period colors
$periodColors = [
    'lp' => ['bg' => '#E05757', 'label' => 'LP', 'year' => ($currentYear - 1)],
    'cp' => ['bg' => '#2D7F06', 'label' => 'CP', 'year' => $currentYear],
    'ct' => ['bg' => '#FDCA40', 'label' => 'CT', 'year' => $currentYear],
    'nt' => ['bg' => '#2F42ED', 'label' => 'NT', 'year' => ($currentYear + 1)],
];

// Circle colors
$circleColors = [
    ['light' => '#FFD0D0', 'dark' => '#E05757'],
    ['light' => '#CAE3C7', 'dark' => '#2D7F06'],
    ['light' => '#F8ECCE', 'dark' => '#FFC731'],
    ['light' => '#D6DAFF', 'dark' => '#2F42ED'],
];
?>

<div class="finlytics-module">
    <!-- ═══ Title Bar ═══ -->
    <div class="fl-title-bar">
        <div class="fl-title-icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" stroke="#30313D" stroke-width="1.5"/>
                <path d="M8 15V11M12 15V9M16 15V7" stroke="#30313D" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </div>
        <div class="fl-title-text">Finlytics</div>
    </div>

    <!-- ═══ Tab Bar ═══ -->
    <div class="fl-tab-bar">
        <a href="<?= Url::to(['/fs/default/index']) ?>" class="fl-tab active">
            <div class="fl-tab-inner">
                <div class="fl-tab-icon">
                    <svg viewBox="0 0 18 18" fill="none"><path d="M2 3h14v12H2z" stroke="#30313D" stroke-width="1.2"/><path d="M5 8h3v5H5zM10 6h3v7h-3z" fill="#30313D"/></svg>
                </div>
                <span class="fl-tab-label">P&L Forecast</span>
            </div>
            <div class="fl-tab-underline"></div>
        </a>
        <a href="<?= Url::to(['/fs/default/golden-ratio']) ?>" class="fl-tab">
            <div class="fl-tab-inner">
                <div class="fl-tab-icon">
                    <svg viewBox="0 0 18 18" fill="none"><rect x="1" y="1" width="16" height="16" rx="1" stroke="#30313D" stroke-width="1.2"/><rect x="1" y="1" width="10" height="10" rx="1" stroke="#30313D" stroke-width="1"/><rect x="1" y="1" width="6" height="6" rx="1" stroke="#30313D" stroke-width="0.8"/></svg>
                </div>
                <span class="fl-tab-label">Golden Ratio</span>
            </div>
            <div class="fl-tab-underline"></div>
        </a>
        <a href="<?= Url::to(['/fs/default/forecast-accounts']) ?>" class="fl-tab">
            <div class="fl-tab-inner">
                <div class="fl-tab-icon">
                    <svg viewBox="0 0 18 18" fill="none"><path d="M3 3h4v4H3zM11 3h4v4h-4zM3 11h4v4H3z" stroke="#3C3D48" stroke-width="1.2"/><path d="M11 13h4M13 11v4" stroke="#3C3D48" stroke-width="1.2" stroke-linecap="round"/></svg>
                </div>
                <span class="fl-tab-label">Forecast Accounts</span>
            </div>
            <div class="fl-tab-underline"></div>
        </a>
    </div>

    <!-- ═══ Main Card ═══ -->
    <div class="fl-card">
        <!-- ── Toolbar ── -->
        <div class="fl-toolbar">
            <div class="fl-toolbar-left">
                <div class="fl-breadcrumb">
                    <button class="fl-back" onclick="history.back()">Back</button>
                    <div class="fl-chevron-right">
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none"><path d="M1 1L7 7L1 13" stroke="#2580D3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <span class="fl-page-title">Profit & Loss Portal</span>
                </div>
                <div style="display:flex;gap:14px;align-items:center">
                    <button class="fl-btn fl-btn-primary" id="btnEdit">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M10.5 1.5L12.5 3.5L4 12H2V10L10.5 1.5Z" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Edit
                    </button>
                    <button class="fl-btn fl-btn-outline" id="btnImport">
                        Import Data
                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none"><path d="M1 10v3a2 2 0 002 2h8a2 2 0 002-2v-3M7 1v9M4 7l3 3 3-3" stroke="#2580D3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            </div>
            <div class="fl-toolbar-right">
                <button class="fl-btn fl-btn-light" id="btnDataDict">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 2h10v10H2z" stroke="#2580D3" stroke-width="1.2"/><path d="M5 5h4M5 7h4M5 9h2" stroke="#2580D3" stroke-width="1" stroke-linecap="round"/></svg>
                    Data Dictionary
                </button>
                <button class="fl-btn fl-btn-light" id="btnExport">
                    <svg width="12" height="14" viewBox="0 0 12 14" fill="none"><path d="M1 10v2a1 1 0 001 1h8a1 1 0 001-1v-2M6 1v8M3 4l3-3 3 3" stroke="#2580D3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Export Report
                </button>
                <button class="fl-btn fl-btn-primary" id="btnCharts">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 13h12M3 9v4M6 6v7M9 3v10M12 1v12" stroke="white" stroke-width="1.2" stroke-linecap="round"/></svg>
                    Charts
                </button>
                <button class="fl-btn fl-btn-pill fl-btn-pill-filled" id="btnFilter">
                    <svg width="12" height="14" viewBox="0 0 12 14" fill="none"><path d="M1 1h10L7.5 6v5l-3 2V6L1 1z" fill="white"/></svg>
                    Filter
                </button>
            </div>
        </div>

        <!-- ── Two-panel layout ── -->
        <div class="fl-panels">
            <!-- ══ LEFT PANEL: Annual Performance ══ -->
            <div class="fl-left-panel">
                <!-- Section header: Current Financial Year -->
                <div class="fl-section-header">
                    <div class="fl-section-header-left">
                        <div class="fl-section-header-icon">
                            <svg viewBox="0 0 16 16" fill="none"><rect x="1" y="2" width="14" height="12" rx="1" stroke="#3C3D48" stroke-width="1.2"/><path d="M1 6h14M5 1v2M11 1v2" stroke="#3C3D48" stroke-width="1.2" stroke-linecap="round"/></svg>
                        </div>
                        <span class="fl-section-header-title">Current Financial Year</span>
                    </div>
                    <div class="fl-section-header-right">
                        <div class="fl-year-pill" id="yearSelector">
                            <span><?= $currentYear ?></span>
                            <span class="caret">▾</span>
                        </div>
                        <div class="fl-nav-circle" title="Previous year">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M6 2L3 5L6 8" stroke="#2580D3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div class="fl-nav-circle" title="Next year">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M4 2L7 5L4 8" stroke="#2580D3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Label -->
                <div class="fl-section-divider">
                    <span class="fl-section-label">Annual Performance</span>
                </div>

                <!-- PL Contents header -->
                <div class="fl-pl-header">
                    <div style="display:flex;align-items:center;gap:42px;width:100%">
                        <div class="fl-pl-header-left">
                            <span class="fl-pl-badge fl-pl-badge-pl">PL</span>
                            <span class="fl-pl-header-title">PL Contents</span>
                        </div>
                        <div class="fl-pl-legend">
                            <?php foreach ($periodColors as $key => $p): ?>
                            <div class="fl-legend-item">
                                <span class="fl-pl-badge fl-pl-badge-<?= $key ?>"><?= $p['label'] ?></span>
                                <span class="fl-legend-year"><?= $p['year'] ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- PL Rows with circular progress -->
                <div class="fl-pl-rows">
                    <?php foreach ($plContents as $i => $name): ?>
                    <div class="fl-pl-row" data-row="<?= $i ?>">
                        <span class="fl-pl-row-name" title="<?= Html::encode($name) ?>"><?= Html::encode($name) ?></span>
                        <div class="fl-pl-row-indicators">
                            <?php foreach ($circleColors as $ci => $cc): ?>
                            <div class="fl-indicator-group">
                                <?php
                                    $pct = $indicators[$i][$ci];
                                    $r = 15; $circ = 2 * M_PI * $r;
                                    $dashoffset = $circ * (1 - min($pct, 100) / 100);
                                ?>
                                <div class="fl-circle-progress">
                                    <svg viewBox="0 0 37 37">
                                        <circle class="track" cx="18.5" cy="18.5" r="<?= $r ?>" stroke="<?= $cc['light'] ?>"/>
                                        <circle class="fill" cx="18.5" cy="18.5" r="<?= $r ?>"
                                            stroke="<?= $cc['dark'] ?>"
                                            stroke-dasharray="<?= round($circ, 2) ?>"
                                            stroke-dashoffset="<?= round($dashoffset, 2) ?>"/>
                                    </svg>
                                </div>
                                <span class="fl-indicator-pct"><?= $pct ?>%</span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ══ Vertical separator ══ -->
            <div class="fl-vertical-sep"></div>

            <!-- ══ RIGHT PANEL: Data Grid ══ -->
            <div class="fl-right-panel">
                <!-- Controls bar -->
                <div class="fl-controls-bar">
                    <div class="fl-controls-left">
                        <div class="fl-control-group">
                            <span class="fl-control-label">Currency</span>
                            <div class="fl-dropdown" id="currencyDropdown">
                                <span>฿</span>
                                <span>Thai Bhat</span>
                                <span class="caret">▾</span>
                            </div>
                        </div>
                        <div class="fl-control-group">
                            <span class="fl-control-label">Round Up</span>
                            <div class="fl-dropdown fl-dropdown-dark" id="roundupDropdown">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 10l3-3 2 2 5-5" stroke="#3C3D48" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>Millions</span>
                                <span class="caret">▾</span>
                            </div>
                        </div>
                    </div>
                    <div class="fl-controls-right">
                        <div class="fl-quarter-tabs">
                            <div class="fl-quarter-tab-icon" title="Calendar">
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><rect x="1" y="2" width="11" height="9" rx="1" stroke="#3C3D48" stroke-width="1"/><path d="M1 5h11M4 1v2M9 1v2" stroke="#3C3D48" stroke-width="1" stroke-linecap="round"/></svg>
                            </div>
                            <button class="fl-quarter-tab" data-q="all">All</button>
                            <button class="fl-quarter-tab active" data-q="q1">Q1</button>
                            <button class="fl-quarter-tab" data-q="q2">Q2</button>
                            <button class="fl-quarter-tab" data-q="q3">Q3</button>
                            <button class="fl-quarter-tab" data-q="q4">Q4</button>
                        </div>
                        <button class="fl-collapse-all-btn" id="collapseAllBtn">Collapse All</button>
                    </div>
                </div>

                <!-- Quarter label -->
                <div class="fl-quarter-label">
                    <span class="fl-quarter-label-text">1<sup>st</sup> Quarter</span>
                </div>

                <!-- Month data grid -->
                <div class="fl-data-grid">
                    <?php foreach ($months as $mi => $month): ?>
                    <div class="fl-month-col" data-month="<?= $mi ?>">
                        <!-- Month header -->
                        <div class="fl-month-header">
                            <div class="fl-month-header-top">
                                <span class="fl-month-name"><?= $month ?></span>
                                <div class="fl-collapse-badge" onclick="toggleMonth(this)" title="Collapse this month">Collapse</div>
                            </div>
                            <div class="fl-month-header-bottom">
                                <?php foreach ($periodColors as $key => $p): ?>
                                <div class="fl-legend-item">
                                    <span class="fl-pl-badge fl-pl-badge-<?= $key ?>"><?= $p['label'] ?></span>
                                    <span class="fl-legend-year"><?= $p['year'] ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Data cells (one per PL content row) -->
                        <div class="fl-data-rows">
                            <?php foreach ($plContents as $ri => $rowName): ?>
                            <div class="fl-data-cell" data-row="<?= $ri ?>">
                                <?php foreach ($cellData as $rowData): ?>
                                <div class="fl-data-row">
                                    <?php foreach ($rowData as $val): ?>
                                    <div class="fl-data-value <?= $val === '0' ? 'fl-data-value-zero' : '' ?>">
                                        <?= $val ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
// ── Quarter tab switching ──
document.querySelectorAll('.fl-quarter-tab').forEach(function(tab) {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.fl-quarter-tab').forEach(function(t) { t.classList.remove('active'); });
        this.classList.add('active');
    });
});

// ── Month collapse/expand ──
window.toggleMonth = function(badge) {
    var col = badge.closest('.fl-month-col');
    col.classList.toggle('collapsed');
    badge.textContent = col.classList.contains('collapsed') ? 'Expand' : 'Collapse';
};

// ── Collapse All ──
document.getElementById('collapseAllBtn').addEventListener('click', function() {
    var cols = document.querySelectorAll('.fl-month-col');
    var allCollapsed = Array.from(cols).every(function(c) { return c.classList.contains('collapsed'); });
    cols.forEach(function(col) {
        if (allCollapsed) {
            col.classList.remove('collapsed');
            col.querySelector('.fl-collapse-badge').textContent = 'Collapse';
        } else {
            col.classList.add('collapsed');
            col.querySelector('.fl-collapse-badge').textContent = 'Expand';
        }
    });
    this.textContent = allCollapsed ? 'Collapse All' : 'Expand All';
});

// ── Row hover sync (left panel ↔ right panel) ──
document.querySelectorAll('.fl-pl-row').forEach(function(row) {
    var idx = row.dataset.row;
    row.addEventListener('mouseenter', function() {
        document.querySelectorAll('[data-row="' + idx + '"]').forEach(function(el) {
            el.style.background = '#EBF3FD';
        });
    });
    row.addEventListener('mouseleave', function() {
        document.querySelectorAll('[data-row="' + idx + '"]').forEach(function(el) {
            el.style.background = '';
        });
    });
});

// Sync hover from data cells to left panel
document.querySelectorAll('.fl-data-cell').forEach(function(cell) {
    var idx = cell.dataset.row;
    cell.addEventListener('mouseenter', function() {
        document.querySelectorAll('[data-row="' + idx + '"]').forEach(function(el) {
            el.style.background = '#EBF3FD';
        });
    });
    cell.addEventListener('mouseleave', function() {
        document.querySelectorAll('[data-row="' + idx + '"]').forEach(function(el) {
            el.style.background = '';
        });
    });
});

// ── Animate circle progress on scroll into view ──
var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.3 });
document.querySelectorAll('.fl-circle-progress').forEach(function(el) { observer.observe(el); });
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>
