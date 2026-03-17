<?php
/** @var yii\web\View $this */
/** @var array $translations */
/** @var array $missingCounts */
/** @var int $totalCount */
$this->title = 'Translation Manager — HRVC';
$homeUrl = Yii::$app->homeUrl;

$langCols = [
    'japanese'   => ['label' => 'Japanese', 'native' => '日本語', 'flag' => 'japan'],
    'thai'       => ['label' => 'Thai', 'native' => 'ไทย', 'flag' => 'thailand'],
    'chinese'    => ['label' => 'Chinese', 'native' => '中文', 'flag' => 'china'],
    'vietnam'    => ['label' => 'Vietnamese', 'native' => 'Tiếng Việt', 'flag' => 'vietnam'],
    'spanish'    => ['label' => 'Spanish', 'native' => 'Español', 'flag' => 'span'],
    'indonesian' => ['label' => 'Indonesian', 'native' => 'Bahasa', 'flag' => 'bahasa'],
];

$totalMissing = 0;
foreach ($missingCounts as $cnt) $totalMissing += $cnt;
?>

<style>
.tl-page { padding: 24px 0; }

.tl-header {
    display: flex; align-items: center; gap: 12px; margin-bottom: 20px;
}

.tl-header-icon {
    width: 40px; height: 40px; border-radius: 6px;
    background: linear-gradient(135deg, #6366F1, #8B5CF6);
    display: flex; align-items: center; justify-content: center;
}

.tl-header h1 {
    font-family: 'Inter', sans-serif; font-size: 24px; font-weight: 700; color: #1A1A1A; margin: 0;
}

.tl-header p {
    font-family: 'Inter', sans-serif; font-size: 13px; color: #888; margin: 2px 0 0;
}

.tl-header-actions {
    margin-left: auto; display: flex; gap: 8px; align-items: center;
}

.tl-header-btn {
    padding: 8px 16px; border-radius: 6px; border: 1px solid #E2E8F0;
    font-family: 'Inter', sans-serif; font-size: 13px; font-weight: 500;
    color: #475569; background: #F8FAFC; cursor: pointer;
    transition: all 0.15s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
}

.tl-header-btn:hover { background: #E2E8F0; color: #333; }

.tl-header-btn-primary {
    background: linear-gradient(135deg, #2580D3, #1A5A94); color: #fff; border-color: transparent;
}

.tl-header-btn-primary:hover { background: linear-gradient(135deg, #1A5A94, #134270); color: #fff; }

/* Stats bar */
.tl-stats {
    display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap;
}

.tl-stat {
    display: flex; align-items: center; gap: 8px;
    padding: 10px 14px; background: #FFFFFF; border: 1px solid #F0F0F0;
    border-radius: 6px; min-width: 130px;
}

.tl-stat-flag { width: 20px; height: 20px; border-radius: 50%; object-fit: cover; }

.tl-stat-info { display: flex; flex-direction: column; }

.tl-stat-lang { font-size: 12px; font-weight: 600; color: #333; }

.tl-stat-missing { font-size: 11px; }

.tl-stat-ok { color: #34C759; }
.tl-stat-warn { color: #F59E0B; }
.tl-stat-bad { color: #E53E3E; }

/* Search */
.tl-search-wrap {
    margin-bottom: 16px;
}

.tl-search {
    width: 100%; padding: 10px 14px 10px 36px; border-radius: 6px;
    border: 1.5px solid #E2E8F0; font-family: 'Inter', sans-serif;
    font-size: 14px; background: #F8FAFC url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none'%3E%3Ccircle cx='11' cy='11' r='7' stroke='%23A3A3A3' stroke-width='2'/%3E%3Cpath d='M16.5 16.5L21 21' stroke='%23A3A3A3' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat 10px center;
    outline: none; transition: border-color 0.15s ease;
}

.tl-search:focus { border-color: #2580D3; box-shadow: 0 0 0 3px rgba(37,128,211,0.1); }

/* Table */
.tl-table-wrap {
    background: #FFFFFF; border: 1px solid #F0F0F0; border-radius: 6px;
    overflow: hidden;
}

.tl-table {
    width: 100%; border-collapse: collapse; font-family: 'Inter', sans-serif;
    table-layout: fixed;
}

.tl-table thead th {
    font-size: 11px; font-weight: 700; color: #888; text-transform: uppercase;
    letter-spacing: 0.4px; padding: 12px 10px; border-bottom: 1px solid #F0F0F0;
    text-align: left; position: sticky; top: 0; background: #FAFBFC; z-index: 2;
}

.tl-table thead th:first-child {
    width: 50px; text-align: center;
}

.tl-table thead th:nth-child(2) {
    width: 200px;
}

.tl-table tbody tr { transition: background 0.1s ease; }
.tl-table tbody tr:hover { background: #F8FBFF; }

.tl-table tbody td {
    font-size: 13px; color: #333; padding: 8px 10px;
    border-bottom: 1px solid #F8F8F8; vertical-align: top;
    word-break: break-word;
}

.tl-table tbody td:first-child {
    text-align: center; color: #A3A3A3; font-size: 11px;
}

.tl-english {
    font-weight: 600; color: #1A1A1A;
}

.tl-cell-empty {
    color: #E53E3E; font-style: italic; font-size: 12px;
}

.tl-cell-filled {
    color: #475569;
}

.tl-cell-edit {
    width: 100%; border: none; background: transparent;
    font-family: 'Inter', sans-serif; font-size: 13px; color: #333;
    padding: 2px; outline: none; border-radius: 4px;
}

.tl-cell-edit:focus {
    background: #F0F7FF; box-shadow: 0 0 0 2px #2580D3;
}

.tl-table-scroll {
    max-height: calc(100vh - 340px); overflow-y: auto;
}

.tl-table thead th .tl-flag {
    width: 16px; height: 16px; border-radius: 50%; vertical-align: middle;
    margin-right: 4px;
}

.tl-count-tag {
    display: inline-block; font-size: 9px; font-weight: 700;
    padding: 1px 5px; border-radius: 4px; margin-left: 4px;
    vertical-align: middle;
}

.tl-count-ok { background: #E8F9EE; color: #34C759; }
.tl-count-warn { background: #FFF3E0; color: #F59E0B; }
.tl-count-bad { background: #FEE2E2; color: #E53E3E; }
</style>

<div class="tl-page">
    <!-- Header -->
    <div class="tl-header">
        <div class="tl-header-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="1.5"/>
                <path d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" stroke="#fff" stroke-width="1.5"/>
            </svg>
        </div>
        <div>
            <h1>Translation Manager</h1>
            <p><?= $totalCount ?> words · <?= $totalMissing ?> missing translations</p>
        </div>
        <div class="tl-header-actions">
            <a href="<?= $homeUrl ?>setting/default/master-settings" class="tl-header-btn">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Back to Settings
            </a>
            <a href="<?= $homeUrl ?>language/default/create" class="tl-header-btn tl-header-btn-primary">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="#fff" stroke-width="2.5" stroke-linecap="round"/></svg>
                Add Word
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="tl-stats">
        <div class="tl-stat">
            <div style="width:20px;height:20px;border-radius:50%;background:#EAF5FF;display:flex;align-items:center;justify-content:center;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="#2580D3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div class="tl-stat-info">
                <span class="tl-stat-lang">Total Words</span>
                <span style="font-size:16px;font-weight:700;color:#1A1A1A;"><?= $totalCount ?></span>
            </div>
        </div>
        <?php foreach ($langCols as $key => $lang):
            $miss = $missingCounts[$key] ?? 0;
            $pct = $totalCount > 0 ? round((($totalCount - $miss) / $totalCount) * 100) : 0;
            $cssClass = $miss === 0 ? 'tl-stat-ok' : ($miss > $totalCount * 0.3 ? 'tl-stat-bad' : 'tl-stat-warn');
        ?>
        <div class="tl-stat">
            <img src="<?= $homeUrl ?>images/flag/<?= $lang['flag'] ?>.svg" class="tl-stat-flag" alt="<?= $lang['label'] ?>">
            <div class="tl-stat-info">
                <span class="tl-stat-lang"><?= $lang['label'] ?></span>
                <span class="<?= $cssClass ?>"><?= $miss === 0 ? '✓ Complete' : $miss . ' missing (' . $pct . '%)' ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Search -->
    <div class="tl-search-wrap">
        <input type="text" class="tl-search" placeholder="Search translations..." id="tlSearch" oninput="filterTranslations()">
    </div>

    <!-- Table -->
    <div class="tl-table-wrap">
        <div class="tl-table-scroll">
            <table class="tl-table" id="tlTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>English (Source)</th>
                        <?php foreach ($langCols as $key => $lang):
                            $miss = $missingCounts[$key] ?? 0;
                            $tagClass = $miss === 0 ? 'tl-count-ok' : ($miss > $totalCount * 0.3 ? 'tl-count-bad' : 'tl-count-warn');
                        ?>
                        <th>
                            <img src="<?= $homeUrl ?>images/flag/<?= $lang['flag'] ?>.svg" class="tl-flag">
                            <?= $lang['label'] ?>
                            <?php if ($miss > 0): ?>
                            <span class="tl-count-tag <?= $tagClass ?>"><?= $miss ?></span>
                            <?php endif; ?>
                        </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($translations as $idx => $t): ?>
                    <tr data-id="<?= $t['translatorId'] ?>">
                        <td><?= $idx + 1 ?></td>
                        <td><span class="tl-english"><?= htmlspecialchars($t['english']) ?></span></td>
                        <?php foreach ($langCols as $key => $lang):
                            $val = trim($t[$key] ?? '');
                        ?>
                        <td>
                            <?php if ($val): ?>
                                <span class="tl-cell-filled"><?= htmlspecialchars($val) ?></span>
                            <?php else: ?>
                                <span class="tl-cell-empty">— missing</span>
                            <?php endif; ?>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function filterTranslations() {
    var q = document.getElementById('tlSearch').value.toLowerCase();
    var rows = document.querySelectorAll('#tlTable tbody tr');
    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.indexOf(q) !== -1 ? '' : 'none';
    });
}
</script>
