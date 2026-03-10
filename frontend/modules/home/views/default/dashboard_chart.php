<style>
/* ===== Chart Card ===== */
.chart-card {
    position: relative;
    width: 100%;
    background: #FFFFFF;
    border-radius: 10px;
    overflow: visible;
}

/* ===== Chart Toolbar ===== */
.chart-toolbar {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 12px 16px 6px;
    flex-wrap: nowrap;
}

/* LEFT: KFI/KGI/KPI Tabs + Sub-tabs */
.chart-tabs-section {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-shrink: 0;
}

/* KFI / KGI / KPI Tabs */
.chart-tabs {
    display: inline-flex;
    align-items: center;
    border-radius: 8px;
    background: #F0F2F4;
    padding: 3px;
    gap: 2px;
    flex-shrink: 0;
}

.chart-tab-btn {
    border: none;
    height: 28px;
    padding: 0 14px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #777;
    cursor: pointer;
    background: transparent;
    transition: all 0.2s ease;
    line-height: 28px;
    white-space: nowrap;
}

.chart-tab-btn:hover {
    background: rgba(0, 0, 0, 0.04);
    color: #333;
}

.chart-tab-btn.active-kfi {
    background: #A8BBFF;
    color: #2A3E7C;
    box-shadow: 0 1px 3px rgba(80, 120, 255, 0.25);
}

.chart-tab-btn.active-kgi {
    background: #FDCA40;
    color: #7A5D00;
    box-shadow: 0 1px 3px rgba(164, 120, 0, 0.25);
}

.chart-tab-btn.active-kpi {
    background: #FF715B;
    color: #fff;
    box-shadow: 0 1px 3px rgba(194, 29, 3, 0.25);
}

/* Separator */
.chart-tab-divider {
    width: 1px;
    height: 20px;
    background: #DDD;
    flex-shrink: 0;
}

/* Sub-tabs: Company / Team / Self */
.chart-subtabs {
    display: inline-flex;
    align-items: center;
    gap: 2px;
    flex-shrink: 0;
    opacity: 1;
    transition: opacity 0.2s ease;
}

.chart-subtabs.hidden {
    display: none;
}

.chart-subtab-btn {
    border: none;
    height: 28px;
    padding: 0 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 500;
    color: #888;
    cursor: pointer;
    background: transparent;
    transition: all 0.15s ease;
    line-height: 28px;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.chart-subtab-btn:hover {
    background: #F0F2F4;
    color: #333;
}

.chart-subtab-btn.active {
    background: #E8F2FC;
    color: #2580D3;
    font-weight: 600;
}

.chart-subtab-btn img {
    width: 13px;
    height: 13px;
}

/* RIGHT: Nav arrows + Info button */
.chart-toolbar-right {
    display: flex;
    align-items: center;
    gap: 4px;
    flex-shrink: 0;
}

.chart-nav-button {
    width: 28px;
    height: 28px;
    background: #F4F6F8;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.15s ease;
}

.chart-nav-button:hover {
    background: #E8ECF0;
}

.chart-nav-button:disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

.chart-nav-button:disabled:hover {
    background: #F4F6F8;
}

.chart-nav-button img {
    width: 16px;
    height: 16px;
}

/* ===== Legend Info Button ===== */
.chart-info-wrapper {
    position: relative;
    display: inline-flex;
}

.chart-info-btn {
    width: 28px;
    height: 28px;
    background: #F4F6F8;
    border: 1px solid #E8E8E8;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.15s ease;
    font-size: 13px;
    font-weight: 700;
    color: #999;
}

.chart-info-btn:hover {
    background: #E8F2FC;
    border-color: #B8D4F0;
    color: #2580D3;
}

.chart-info-popover {
    display: none;
    position: absolute;
    top: calc(100% + 6px);
    right: 0;
    background: #FFFFFF;
    border: 1px solid #E8E8E8;
    border-radius: 10px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    padding: 12px 14px;
    width: 200px;
    z-index: 100;
}

.chart-info-wrapper:hover .chart-info-popover {
    display: block;
}

.chart-info-popover-title {
    font-size: 11px;
    font-weight: 600;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.chart-info-row {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 5px 0;
}

.chart-info-row + .chart-info-row {
    border-top: 1px solid #F4F4F4;
}

.chart-info-icon {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

.chart-info-row span {
    font-size: 12px;
    font-weight: 500;
    color: #444;
}

/* ===== Chart Graph ===== */
.chart-graph-area {
    width: 100%;
}

.chart-graph-area #container {
    width: 100% !important;
    max-width: 100% !important;
    height: 340px;
    margin: 0;
    padding: 0;
    overflow: hidden;
    display: block;
    box-sizing: border-box;
}

.highcharts-container {
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow: hidden;
}

.highcharts-root {
    width: 100% !important;
}
</style>

<div class="chart-card">
    <!-- Toolbar Row -->
    <div class="chart-toolbar">
        <!-- LEFT: KFI/KGI/KPI tabs + sub-tabs -->
        <div class="chart-tabs-section">
            <div class="chart-tabs">
                <button id="KFI" class="chart-tab-btn active-kfi"><?= Yii::t('app', 'KFI') ?></button>
                <button id="KGI" class="chart-tab-btn"><?= Yii::t('app', 'KGI') ?></button>
                <button id="KPI" class="chart-tab-btn"><?= Yii::t('app', 'KPI') ?></button>
            </div>

            <div class="chart-tab-divider" id="subtabDivider" style="display:none;"></div>

            <!-- Sub-tabs for KGI/KPI (Company/Team/Self) -->
            <div class="chart-subtabs hidden" id="chartSubtabs">
                <button class="chart-subtab-btn active" id="subCompany" data-cat="Company">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg" alt="Company">
                    <?= Yii::t('app', 'Company') ?>
                </button>
                <button class="chart-subtab-btn" id="subTeam" data-cat="Team">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team">
                    <?= Yii::t('app', 'Team') ?>
                </button>
                <button class="chart-subtab-btn" id="subSelf" data-cat="Self">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self">
                    <?= Yii::t('app', 'Self') ?>
                </button>
            </div>
        </div>

        <!-- SPACER -->
        <div style="flex: 1;"></div>

        <!-- RIGHT: Info + Nav arrows -->
        <div class="chart-toolbar-right">
            <div class="chart-info-wrapper">
                <button class="chart-info-btn" title="Chart Legend">ℹ</button>
                <div class="chart-info-popover">
                    <div class="chart-info-popover-title">Chart Legend</div>
                    <div class="chart-info-row" id="legendRow1">
                        <img class="chart-info-icon" id="legendIcon1" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/KFI-target.svg" alt="">
                        <span id="legendLabel1">Performance</span>
                    </div>
                    <div class="chart-info-row" id="legendRow2">
                        <img class="chart-info-icon" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg" alt="">
                        <span>Target Line (100%)</span>
                    </div>
                    <div class="chart-info-row">
                        <svg width="16" height="16" viewBox="0 0 16 16"><rect x="3" y="6" width="10" height="4" rx="2" fill="#2580D3"/></svg>
                        <span>Today Marker</span>
                    </div>
                </div>
            </div>

            <button id="prevButton" class="chart-nav-button" disabled>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/left-off.svg" alt="Previous">
            </button>
            <button id="nextButton" class="chart-nav-button" disabled>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/right-off.svg" alt="Next">
            </button>
        </div>
    </div>

    <!-- Chart Graph -->
    <div class="chart-graph-area">
        <div id="container"></div>
    </div>
</div>


<?php
$currentYear = date("Y");
$currentYearShort = substr($currentYear, -2);
$currentMonth = date("n") - 1;
$currentDay = date("j");
$totalDaysInMonth = date("t");
$currentDayPosition = $currentMonth + ($currentDay - 1) / $totalDaysInMonth;

$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$categories = array_map(fn($month) => $month . ' ' . $currentYearShort, $months);
?>

<script src="<?= Yii::$app->homeUrl ?>js/highcharts.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const categories = <?php echo json_encode($categories); ?>;
        const currentMonth = <?php echo $currentDayPosition; ?>;
        let currentIndex = 0; // 0=KFI, 1=KGI, 2=KPI
        let currentCategory = "Company";
        let type = "KFI";

        var $baseUrl = '<?= Yii::$app->homeUrl ?>';
        $url = $baseUrl;

        // ===== Elements =====
        const tabButtons = {
            KFI: document.getElementById('KFI'),
            KGI: document.getElementById('KGI'),
            KPI: document.getElementById('KPI')
        };
        const subtabsContainer = document.getElementById('chartSubtabs');
        const subtabDivider = document.getElementById('subtabDivider');
        const subBtns = {
            Company: document.getElementById('subCompany'),
            Team: document.getElementById('subTeam'),
            Self: document.getElementById('subSelf')
        };
        const legendIcon1 = document.getElementById('legendIcon1');
        const legendLabel1 = document.getElementById('legendLabel1');

        // ===== Tab active state management =====
        function setActiveTab(activeType) {
            Object.values(tabButtons).forEach(btn => btn.className = 'chart-tab-btn');
            if (activeType === 'KFI') tabButtons.KFI.classList.add('active-kfi');
            else if (activeType === 'KGI') tabButtons.KGI.classList.add('active-kgi');
            else if (activeType === 'KPI') tabButtons.KPI.classList.add('active-kpi');

            // Show/hide sub-tabs
            if (activeType === 'KFI') {
                subtabsContainer.classList.add('hidden');
                subtabDivider.style.display = 'none';
            } else {
                subtabsContainer.classList.remove('hidden');
                subtabDivider.style.display = '';
            }

            // Update legend icon
            const iconMap = { KFI: 'KFI-target.svg', KGI: 'KGI-target.svg', KPI: 'KPI-target.svg' };
            legendIcon1.src = $baseUrl + 'images/icons/Settings/' + iconMap[activeType];
        }

        function setActiveSubtab(cat) {
            Object.values(subBtns).forEach(btn => btn.classList.remove('active'));
            if (subBtns[cat]) subBtns[cat].classList.add('active');
        }

        // ===== Nav button state =====
        function updateNavButtons() {
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');

            if (currentIndex !== 0) {
                // KGI/KPI: arrows enabled for Company/Team/Self cycling
                const imgRight = prevButton.parentElement.querySelector('img[src*="right-off.svg"]');
                const imgLeft = prevButton.parentElement.querySelector('img[src*="left-off.svg"]');
                if (imgRight) imgRight.src = imgRight.src.replace('right-off.svg', 'right.svg');
                if (imgLeft) imgLeft.src = imgLeft.src.replace('left-off.svg', 'left.svg');
                prevButton.disabled = false;
                nextButton.disabled = false;
            } else {
                // KFI: no sub-categories
                const imgRight = prevButton.parentElement.querySelector('img[src*="right.svg"]:not([src*="right-off.svg"])');
                const imgLeft = prevButton.parentElement.querySelector('img[src*="left.svg"]:not([src*="left-off.svg"])');
                if (imgRight) imgRight.src = imgRight.src.replace('right.svg', 'right-off.svg');
                if (imgLeft) imgLeft.src = imgLeft.src.replace('left.svg', 'left-off.svg');
                prevButton.disabled = true;
                nextButton.disabled = true;
            }
        }

        // ===== Render Chart =====
        const renderChart = (currentCategory, type) => {
            var url = $url + `home/dashboard/chart-dashbord`;

            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: url,
                data: {
                    currentCategory: currentCategory,
                    type: type
                },
                success: function(data) {
                    const chartsData = data.data;
                    const chartData = chartsData[0];

                    const maxData = chartData.series[0].data;
                    const maxValue = Math.max(...maxData);
                    const max = maxValue > 100 ? maxValue : 100;

                    Highcharts.chart('container', {
                        chart: {
                            type: 'line',
                            spacingTop: 10,
                            spacingBottom: 8,
                            spacingLeft: 8,
                            spacingRight: 8,
                            backgroundColor: 'transparent',
                            style: {
                                fontFamily: 'Inter, -apple-system, sans-serif'
                            }
                        },
                        title: {
                            text: chartData.title,
                            align: 'left',
                            style: {
                                fontSize: '14px',
                                fontWeight: '600',
                                color: '#30313D'
                            },
                            margin: 16,
                            x: 8,
                            y: 8
                        },
                        xAxis: {
                            categories: categories,
                            labels: {
                                style: { fontSize: '10px', color: '#999' }
                            },
                            lineColor: '#E8E8E8',
                            tickColor: '#E8E8E8',
                            plotLines: [{
                                color: '#2580D3',
                                width: 1,
                                value: currentMonth,
                                label: {
                                    text: 'Today',
                                    align: 'right',
                                    y: -8,
                                    x: 22,
                                    useHTML: true,
                                    formatter: function() {
                                        return '<div style="display:inline-flex;align-items:center;justify-content:center;padding:2px 8px;border-radius:10px;background:#2580D3;font-size:9px;font-weight:600;color:#fff;">Today</div>';
                                    },
                                    rotation: 0
                                },
                                zIndex: 3
                            }]
                        },
                        yAxis: {
                            title: {
                                text: '<?= Yii::t('app', 'Amount') ?>',
                                style: { color: '#999', fontWeight: '500', fontSize: '11px' },
                            },
                            min: 0,
                            max: max,
                            gridLineColor: '#F4F4F4',
                            gridLineDashStyle: 'Dash',
                            labels: {
                                formatter: function() { return this.value + '%'; },
                                style: { fontSize: '10px', color: '#999' }
                            }
                        },
                        legend: {
                            enabled: false  // Hidden — using info hover instead
                        },
                        tooltip: {
                            useHTML: true,
                            shared: false,
                            split: true,
                            backgroundColor: '#FFFFFF',
                            borderColor: '#E0E0E0',
                            borderRadius: 8,
                            shadow: { color: 'rgba(0,0,0,0.08)', offsetX: 0, offsetY: 2, width: 8 },
                            style: { fontSize: '12px' },
                            formatter: function() {
                                let result = '';
                                let gap = '';
                                let name = '';

                                if (this.points) {
                                    this.points.forEach(function(point) {
                                        if (point.series.name == 'Result') result = point.y.toFixed(2) + '%';
                                        else if (point.series.name == 'Gap') gap = point.y.toFixed(2) + '%';
                                        name = point.key;
                                    });
                                }

                                if (!result && !gap) {
                                    return '<span style="color:#999;font-size:12px;">No data available</span>';
                                }

                                return `
                                <div style="padding:4px 0;">
                                    <div style="font-weight:600;font-size:13px;color:#30313D;margin-bottom:6px;">${name}</div>
                                    <div style="display:flex;gap:16px;">
                                        <div>
                                            <div style="font-size:10px;color:#999;margin-bottom:2px;">Result</div>
                                            <div style="font-weight:600;font-size:13px;color:#30313D;">${result}</div>
                                        </div>
                                        <div>
                                            <div style="font-size:10px;color:#999;margin-bottom:2px;">Gap</div>
                                            <div style="font-weight:600;font-size:13px;color:#30313D;">${gap}</div>
                                        </div>
                                    </div>
                                </div>`;
                            }
                        },
                        plotOptions: {
                            line: {
                                lineWidth: 2,
                                marker: {
                                    radius: 3,
                                    lineWidth: 1,
                                    lineColor: '#FFFFFF'
                                }
                            },
                            area: {
                                fillOpacity: 0.08
                            }
                        },
                        credits: { enabled: false },
                        series: chartData.series
                    });
                }
            });
        };

        // ===== Tab click handlers =====
        document.getElementById('KFI').addEventListener('click', () => {
            currentIndex = 0;
            currentCategory = "Company";
            type = "KFI";
            setActiveTab('KFI');
            updateNavButtons();
            renderChart(currentCategory, type);
        });

        document.getElementById('KGI').addEventListener('click', () => {
            currentIndex = 1;
            type = "KGI";
            setActiveTab('KGI');
            setActiveSubtab(currentCategory);
            updateNavButtons();
            renderChart(currentCategory, type);
        });

        document.getElementById('KPI').addEventListener('click', () => {
            currentIndex = 2;
            type = "KPI";
            setActiveTab('KPI');
            setActiveSubtab(currentCategory);
            updateNavButtons();
            renderChart(currentCategory, type);
        });

        // ===== Sub-tab click handlers =====
        document.querySelectorAll('.chart-subtab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                currentCategory = btn.dataset.cat;
                setActiveSubtab(currentCategory);
                renderChart(currentCategory, type);
            });
        });

        // ===== Prev/Next handlers (cycle Company → Team → Self) =====
        document.getElementById('prevButton').addEventListener('click', () => {
            currentCategory = (currentCategory == 'Company') ? 'Self' : (currentCategory == 'Self') ? 'Team' : 'Company';
            setActiveSubtab(currentCategory);
            renderChart(currentCategory, type);
        });

        document.getElementById('nextButton').addEventListener('click', () => {
            currentCategory = (currentCategory == 'Company') ? 'Team' : (currentCategory == 'Team') ? 'Self' : 'Company';
            setActiveSubtab(currentCategory);
            renderChart(currentCategory, type);
        });

        // ===== Initial render =====
        setActiveTab('KFI');
        updateNavButtons();
        renderChart(currentCategory, type);
    });
</script>