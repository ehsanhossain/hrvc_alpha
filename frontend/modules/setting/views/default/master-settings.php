<?php
/** @var yii\web\View $this */
/** @var array $currencies */
/** @var array $countries */
$this->title = 'Master Settings — HRVC';
$homeUrl = Yii::$app->homeUrl;

// Current language
$cookie = Yii::$app->request->cookies;
$currentLang = $cookie->has('language') ? $cookie->getValue('language') : 'en-US';

$languages = [
    'en-US' => ['name' => 'English', 'native' => 'English', 'flag' => 'usa'],
    'jp'    => ['name' => 'Japanese', 'native' => '日本語', 'flag' => 'japan'],
    'th'    => ['name' => 'Thai', 'native' => 'ไทย', 'flag' => 'thailand'],
    'cn'    => ['name' => 'Chinese', 'native' => '中文', 'flag' => 'china'],
    'vt'    => ['name' => 'Vietnamese', 'native' => 'Tiếng Việt', 'flag' => 'vietnam'],
    'id'    => ['name' => 'Indonesian', 'native' => 'Bahasa', 'flag' => 'bahasa'],
    'es'    => ['name' => 'Spanish', 'native' => 'Español', 'flag' => 'span'],
];

$timezones = [
    'Asia/Bangkok'     => ['label' => 'Bangkok (ICT)', 'offset' => 'UTC+7'],
    'Asia/Tokyo'       => ['label' => 'Tokyo (JST)', 'offset' => 'UTC+9'],
    'Asia/Shanghai'    => ['label' => 'Shanghai (CST)', 'offset' => 'UTC+8'],
    'Asia/Ho_Chi_Minh' => ['label' => 'Ho Chi Minh (ICT)', 'offset' => 'UTC+7'],
    'Asia/Jakarta'     => ['label' => 'Jakarta (WIB)', 'offset' => 'UTC+7'],
    'Asia/Singapore'   => ['label' => 'Singapore (SGT)', 'offset' => 'UTC+8'],
    'Asia/Kolkata'     => ['label' => 'Kolkata (IST)', 'offset' => 'UTC+5:30'],
    'Europe/London'    => ['label' => 'London (GMT)', 'offset' => 'UTC+0'],
    'America/New_York' => ['label' => 'New York (EST)', 'offset' => 'UTC-5'],
    'America/Los_Angeles' => ['label' => 'Los Angeles (PST)', 'offset' => 'UTC-8'],
];
?>

<link rel="stylesheet" href="<?= $homeUrl ?>css/finlytics.css">
<style>
/* ═══════ MASTER SETTINGS ═══════ */
.ms-page { padding: 24px 0; }

.ms-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 28px;
}

.ms-header-icon {
    width: 40px; height: 40px;
    border-radius: 6px;
    background: linear-gradient(135deg, #667EEA, #764BA2);
    display: flex; align-items: center; justify-content: center;
}

.ms-header h1 {
    font-family: 'Inter', sans-serif;
    font-size: 24px;
    font-weight: 700;
    color: #1A1A1A;
    margin: 0;
}

.ms-header p {
    font-family: 'Inter', sans-serif;
    font-size: 13px;
    color: #888;
    margin: 2px 0 0;
}

.ms-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.ms-card {
    background: #FFFFFF;
    border: 1px solid #F0F0F0;
    border-radius: 6px;
    padding: 24px;
    transition: box-shadow 0.2s ease;
}

.ms-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}

.ms-card-full {
    grid-column: 1 / -1;
}

.ms-card-title {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
}

.ms-card-icon {
    width: 32px; height: 32px;
    border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

.ms-card-title h3 {
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    font-weight: 600;
    color: #262626;
    margin: 0;
}

.ms-card-title .ms-badge {
    margin-left: auto;
    font-size: 11px;
    font-weight: 600;
    color: #34C759;
    background: #E8F9EE;
    padding: 3px 10px;
    border-radius: 6px;
}

/* ─── Language Selector ─── */
.ms-lang-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
}

.ms-lang-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 6px;
    border: 1.5px solid #F0F0F0;
    cursor: pointer;
    transition: all 0.15s ease;
    text-decoration: none;
    color: #333;
}

.ms-lang-item:hover {
    border-color: #D0D0D0;
    background: #FAFAFA;
    color: #333;
}

.ms-lang-item.active {
    border-color: #2580D3;
    background: #F0F7FF;
}

.ms-lang-item img {
    width: 24px; height: 24px;
    border-radius: 50%;
    object-fit: cover;
}

.ms-lang-name {
    font-size: 13px; font-weight: 500;
}

.ms-lang-native {
    font-size: 11px; color: #888;
}

.ms-lang-check {
    margin-left: auto;
    color: #2580D3;
    display: none;
}

.ms-lang-item.active .ms-lang-check { display: block; }

/* ─── Timezone Selector ─── */
.ms-tz-select {
    width: 100%;
    padding: 10px 14px;
    border-radius: 6px;
    border: 1.5px solid #E2E8F0;
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    color: #333;
    background: #F8FAFC;
    appearance: none;
    cursor: pointer;
    outline: none;
    transition: border-color 0.15s ease;
}

.ms-tz-select:focus {
    border-color: #2580D3;
    box-shadow: 0 0 0 3px rgba(37,128,211,0.1);
}

.ms-tz-current {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 12px;
    padding: 10px 14px;
    background: #F1F5F9;
    border-radius: 6px;
}

.ms-tz-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #34C759;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
}

.ms-tz-text {
    font-size: 13px; color: #555;
}

.ms-tz-text strong { color: #1A1A1A; }

/* ─── Location ─── */
.ms-loc-select {
    width: 100%;
    padding: 10px 14px;
    border-radius: 6px;
    border: 1.5px solid #E2E8F0;
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    color: #333;
    background: #F8FAFC;
    appearance: none;
    outline: none;
    transition: border-color 0.15s ease;
}

.ms-loc-select:focus {
    border-color: #2580D3;
    box-shadow: 0 0 0 3px rgba(37,128,211,0.1);
}

/* ─── Currency ─── */
.ms-curr-toolbar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
}

.ms-curr-search {
    flex: 1;
    padding: 8px 12px 8px 36px;
    border-radius: 6px;
    border: 1.5px solid #E2E8F0;
    font-size: 13px;
    background: #F8FAFC url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none'%3E%3Ccircle cx='11' cy='11' r='7' stroke='%23A3A3A3' stroke-width='2'/%3E%3Cpath d='M16.5 16.5L21 21' stroke='%23A3A3A3' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat 10px center;
    outline: none;
    transition: border-color 0.15s ease;
}

.ms-curr-search:focus {
    border-color: #2580D3;
}

.ms-btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-family: 'Inter', sans-serif;
    font-size: 13px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.15s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.ms-btn-primary {
    background: linear-gradient(135deg, #2580D3, #1A5A94);
    color: #FFFFFF;
}

.ms-btn-primary:hover {
    background: linear-gradient(135deg, #1A5A94, #134270);
    transform: translateY(-1px);
}

.ms-btn-secondary {
    background: #F1F5F9;
    color: #475569;
    border: 1px solid #E2E8F0;
}

.ms-btn-secondary:hover {
    background: #E8EAED;
}

.ms-curr-table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Inter', sans-serif;
}

.ms-curr-table thead th {
    font-size: 11px;
    font-weight: 600;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 10px 12px;
    border-bottom: 1px solid #F0F0F0;
    text-align: left;
}

.ms-curr-table tbody tr {
    transition: background 0.12s ease;
}

.ms-curr-table tbody tr:hover {
    background: #F8FAFC;
}

.ms-curr-table tbody td {
    font-size: 13px;
    color: #333;
    padding: 12px;
    border-bottom: 1px solid #F8F8F8;
}

.ms-curr-code {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px; height: 22px;
    border-radius: 4px;
    background: #EAF5FF;
    color: #1A5A94;
    font-size: 11px;
    font-weight: 700;
}

.ms-rate-badge {
    font-family: 'SF Mono', 'Fira Code', monospace;
    font-size: 12px;
    color: #475569;
}

.ms-curr-actions {
    display: flex; gap: 6px;
}

.ms-curr-del {
    width: 28px; height: 28px;
    border-radius: 6px;
    border: 1px solid #FEE2E2;
    background: #FFF5F5;
    color: #E53E3E;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    transition: all 0.12s ease;
    font-size: 14px;
}

.ms-curr-del:hover {
    background: #FED7D7;
}

/* ─── Add Currency Modal ─── */
.ms-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.4);
    z-index: 10000;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
}

.ms-modal-overlay.open { display: flex; }

.ms-modal {
    background: #FFFFFF;
    border-radius: 6px;
    width: 440px;
    max-height: 80vh;
    overflow-y: auto;
    padding: 28px;
    box-shadow: 0 16px 64px rgba(0,0,0,0.2);
    animation: modalIn 0.2s ease;
}

@keyframes modalIn {
    from { opacity: 0; transform: scale(0.96) translateY(8px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}

.ms-modal h3 {
    font-size: 18px;
    font-weight: 700;
    color: #1A1A1A;
    margin: 0 0 20px;
}

.ms-form-group {
    margin-bottom: 16px;
}

.ms-form-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.ms-form-input {
    width: 100%;
    padding: 10px 14px;
    border-radius: 6px;
    border: 1.5px solid #E2E8F0;
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    color: #333;
    background: #F8FAFC;
    outline: none;
    box-sizing: border-box;
    transition: border-color 0.15s ease;
}

.ms-form-input:focus {
    border-color: #2580D3;
    box-shadow: 0 0 0 3px rgba(37,128,211,0.1);
}

.ms-modal-footer {
    display: flex;
    gap: 10px;
    margin-top: 20px;
    justify-content: flex-end;
}

.ms-empty {
    text-align: center;
    padding: 40px 20px;
    color: #999;
}

.ms-empty svg { margin-bottom: 12px; }
.ms-translate-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 14px;
    padding: 8px 16px;
    border-radius: 6px;
    background: #F1F5F9;
    border: 1px solid #E2E8F0;
    color: #475569;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.15s ease;
}

.ms-translate-link:hover {
    background: #E2E8F0;
    color: #333;
}
</style>

<div class="ms-page">
    <!-- Header -->
    <div class="ms-header">
        <div class="ms-header-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" stroke="#fff" stroke-width="1.8"/>
                <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" stroke="#fff" stroke-width="1.8"/>
            </svg>
        </div>
        <div>
            <h1>Master Settings</h1>
            <p>Configure language, timezone, location and currency preferences</p>
        </div>
    </div>

    <div class="ms-grid">
        <!-- ═══ 1. LANGUAGE SELECTOR ═══ -->
        <div class="ms-card">
            <div class="ms-card-title">
                <div class="ms-card-icon" style="background:#EAF5FF;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="10" stroke="#2580D3" stroke-width="1.5"/>
                        <path d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" stroke="#2580D3" stroke-width="1.5"/>
                    </svg>
                </div>
                <h3>Language</h3>
                <span class="ms-badge"><?= $languages[$currentLang]['name'] ?? 'English' ?></span>
            </div>
            <div class="ms-lang-grid">
                <?php foreach ($languages as $code => $lang): ?>
                <a href="?language=<?= $code ?>" class="ms-lang-item <?= $currentLang === $code ? 'active' : '' ?>">
                    <img src="<?= $homeUrl ?>images/flag/<?= $lang['flag'] ?>.svg" alt="<?= $lang['name'] ?>">
                    <div>
                        <div class="ms-lang-name"><?= $lang['name'] ?></div>
                        <div class="ms-lang-native"><?= $lang['native'] ?></div>
                    </div>
                    <svg class="ms-lang-check" width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M5 13l4 4L19 7" stroke="#2580D3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <?php endforeach; ?>
            </div>
            <a href="<?= $homeUrl ?>language/default/grid" class="ms-translate-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#475569" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Manage Translations
            </a>
        </div>

        <!-- ═══ 2. TIMEZONE & LOCATION ═══ -->
        <div class="ms-card">
            <div class="ms-card-title">
                <div class="ms-card-icon" style="background:#FFF3E0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="10" stroke="#F59E0B" stroke-width="1.5"/>
                        <path d="M12 6v6l4 2" stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3>Timezone & Location</h3>
            </div>

            <div class="ms-form-group">
                <label class="ms-form-label">Timezone</label>
                <select class="ms-tz-select" id="timezoneSelect" onchange="saveTimezone(this.value)">
                    <?php foreach ($timezones as $tz => $info): ?>
                    <option value="<?= $tz ?>" <?= (date_default_timezone_get() === $tz) ? 'selected' : '' ?>>
                        <?= $info['label'] ?> (<?= $info['offset'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
                <div class="ms-tz-current">
                    <div class="ms-tz-dot"></div>
                    <span class="ms-tz-text">Current time: <strong id="currentTime"><?= date('l, F j, Y — h:i A') ?></strong></span>
                </div>
            </div>

            <div class="ms-form-group" style="margin-top:18px;">
                <label class="ms-form-label">Default Location</label>
                <select class="ms-loc-select" id="locationSelect">
                    <option value="">Select a country...</option>
                    <?php if (!empty($countries)): ?>
                        <?php foreach ($countries as $country): ?>
                        <option value="<?= $country['countryId'] ?>"><?= htmlspecialchars($country['countryName'] ?? '') ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="TH">Thailand</option>
                        <option value="JP">Japan</option>
                        <option value="CN">China</option>
                        <option value="VN">Vietnam</option>
                        <option value="SG">Singapore</option>
                        <option value="US">United States</option>
                        <option value="GB">United Kingdom</option>
                        <option value="ID">Indonesia</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <!-- ═══ 3. CURRENCY REGISTRATION ═══ -->
        <div class="ms-card ms-card-full">
            <div class="ms-card-title">
                <div class="ms-card-icon" style="background:#E8F9EE;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="10" stroke="#34C759" stroke-width="1.5"/>
                        <path d="M12 6v12M15 9.5c0-1.38-1.34-2.5-3-2.5s-3 1.12-3 2.5S10.34 12 12 12s3 1.12 3 2.5S13.66 17 12 17" stroke="#34C759" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3>Currency Registration</h3>
                <span class="ms-badge"><?= count($currencies) ?> Active</span>
            </div>

            <div class="ms-curr-toolbar">
                <input type="text" class="ms-curr-search" placeholder="Search currencies..." id="currSearch" oninput="filterCurrencies()">
                <button class="ms-btn ms-btn-secondary" onclick="fetchLiveRates()">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 4v6h6M23 20v-6h-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M20.49 9A9 9 0 005.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 013.51 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Sync Live Rates
                </button>
                <button class="ms-btn ms-btn-primary" onclick="openAddCurrency()">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="#fff" stroke-width="2.5" stroke-linecap="round"/></svg>
                    Add Currency
                </button>
            </div>

            <?php if (empty($currencies)): ?>
            <div class="ms-empty">
                <svg width="48" height="48" viewBox="0 0 64 64" fill="none"><circle cx="32" cy="32" r="24" stroke="#CBD5E1" stroke-width="2"/><path d="M32 20v24M26 26h12M24 32h16M26 38h12" stroke="#CBD5E1" stroke-width="1.5" stroke-linecap="round"/></svg>
                <p>No currencies registered yet. Click "Add Currency" to get started.</p>
            </div>
            <?php else: ?>
            <table class="ms-curr-table" id="currTable">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Symbol</th>
                        <th>Exchange Rate (USD)</th>
                        <th style="width:80px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($currencies as $curr): ?>
                    <tr data-id="<?= $curr['currencyId'] ?>">
                        <td><span class="ms-curr-code"><?= htmlspecialchars($curr['currencyCode']) ?></span></td>
                        <td><?= htmlspecialchars($curr['currencyName']) ?></td>
                        <td><?= htmlspecialchars($curr['currencySymbol'] ?? '') ?></td>
                        <td><span class="ms-rate-badge"><?= $curr['exchangeRate'] ? number_format($curr['exchangeRate'], 4) : '—' ?></span></td>
                        <td>
                            <div class="ms-curr-actions">
                                <button class="ms-curr-del" title="Remove" onclick="deleteCurrency('<?= $curr['currencyId'] ?>', this)">×</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Add Currency Modal -->
<div class="ms-modal-overlay" id="addCurrModal">
    <div class="ms-modal">
        <h3>Add Currency</h3>
        <div class="ms-form-group">
            <label class="ms-form-label">Currency Code</label>
            <input type="text" class="ms-form-input" id="newCurrCode" placeholder="e.g. THB, USD, EUR" maxlength="5" style="text-transform:uppercase;">
        </div>
        <div class="ms-form-group">
            <label class="ms-form-label">Currency Name</label>
            <input type="text" class="ms-form-input" id="newCurrName" placeholder="e.g. Thai Baht">
        </div>
        <div class="ms-form-group">
            <label class="ms-form-label">Symbol</label>
            <input type="text" class="ms-form-input" id="newCurrSymbol" placeholder="e.g. ฿, $, €" maxlength="5">
        </div>
        <div class="ms-form-group">
            <label class="ms-form-label">Exchange Rate (to 1 USD)</label>
            <input type="number" step="0.0001" class="ms-form-input" id="newCurrRate" placeholder="e.g. 35.5">
        </div>
        <div class="ms-modal-footer">
            <button class="ms-btn ms-btn-secondary" onclick="closeAddCurrency()">Cancel</button>
            <button class="ms-btn ms-btn-primary" onclick="saveCurrency()">Save Currency</button>
        </div>
    </div>
</div>

<script>
// ─── Live Clock ───
function updateClock() {
    var el = document.getElementById('currentTime');
    if (el) {
        var now = new Date();
        var options = { weekday:'long', year:'numeric', month:'long', day:'numeric', hour:'2-digit', minute:'2-digit', second:'2-digit' };
        el.textContent = now.toLocaleDateString('en-US', options);
    }
}
setInterval(updateClock, 1000);

// ─── Currency Modal ───
function openAddCurrency() {
    document.getElementById('addCurrModal').classList.add('open');
}

function closeAddCurrency() {
    document.getElementById('addCurrModal').classList.remove('open');
    document.getElementById('newCurrCode').value = '';
    document.getElementById('newCurrName').value = '';
    document.getElementById('newCurrSymbol').value = '';
    document.getElementById('newCurrRate').value = '';
}

// ─── Save Currency ───
function saveCurrency() {
    var code = document.getElementById('newCurrCode').value.toUpperCase().trim();
    var name = document.getElementById('newCurrName').value.trim();
    var symbol = document.getElementById('newCurrSymbol').value.trim();
    var rate = document.getElementById('newCurrRate').value;

    if (!code || !name) {
        alert('Currency code and name are required.');
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?= $homeUrl ?>setting/default/save-currency', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var res = JSON.parse(xhr.responseText);
                if (res.success) { location.reload(); return; }
            } catch(ex) {}
        }
        alert('Failed to save currency.');
    };
    var csrf = '<?= Yii::$app->request->csrfParam ?>=<?= urlencode(Yii::$app->request->csrfToken) ?>';
    xhr.send(csrf + '&currencyCode=' + encodeURIComponent(code) + '&currencyName=' + encodeURIComponent(name) + '&currencySymbol=' + encodeURIComponent(symbol) + '&exchangeRate=' + encodeURIComponent(rate));
}

// ─── Delete Currency ───
function deleteCurrency(id, btn) {
    if (!confirm('Remove this currency?')) return;
    var row = btn.closest('tr');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?= $homeUrl ?>setting/default/delete-currency', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var res = JSON.parse(xhr.responseText);
                if (res.success && row) {
                    row.style.opacity = '0';
                    row.style.transition = 'opacity 0.3s ease';
                    setTimeout(function() { row.remove(); }, 300);
                    return;
                }
            } catch(ex) {}
        }
        alert('Failed to delete currency.');
    };
    var csrf = '<?= Yii::$app->request->csrfParam ?>=<?= urlencode(Yii::$app->request->csrfToken) ?>';
    xhr.send(csrf + '&currencyId=' + encodeURIComponent(id));
}

// ─── Fetch Live Rates ───
function fetchLiveRates() {
    var btn = event.currentTarget;
    btn.disabled = true;
    btn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" style="animation:spin 1s linear infinite"><path d="M1 4v6h6M23 20v-6h-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M20.49 9A9 9 0 005.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 013.51 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Syncing...';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?= $homeUrl ?>setting/default/fetch-exchange-rates?base=USD', true);
    xhr.onload = function() {
        btn.disabled = false;
        btn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 4v6h6M23 20v-6h-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M20.49 9A9 9 0 005.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 013.51 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Sync Live Rates';
        
        if (xhr.status === 200) {
            try {
                var res = JSON.parse(xhr.responseText);
                if (res.success && res.rates) {
                    // Update rate badges in table
                    var rows = document.querySelectorAll('#currTable tbody tr');
                    var updated = 0;
                    rows.forEach(function(row) {
                        var codeEl = row.querySelector('.ms-curr-code');
                        var rateEl = row.querySelector('.ms-rate-badge');
                        if (codeEl && rateEl) {
                            var code = codeEl.textContent.trim();
                            if (res.rates[code]) {
                                rateEl.textContent = res.rates[code].toFixed(4);
                                rateEl.style.color = '#34C759';
                                setTimeout(function() { rateEl.style.color = ''; }, 2000);
                                updated++;
                            }
                        }
                    });
                    alert('Updated ' + updated + ' exchange rates from ExchangeRate API.');
                    return;
                }
            } catch(ex) {}
        }
        alert('Failed to fetch live rates. Try again later.');
    };
    xhr.send();
}

// ─── Filter Currencies ───
function filterCurrencies() {
    var q = document.getElementById('currSearch').value.toLowerCase();
    var rows = document.querySelectorAll('#currTable tbody tr');
    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.indexOf(q) !== -1 ? '' : 'none';
    });
}

// ─── Save Timezone (cookie) ───
function saveTimezone(tz) {
    document.cookie = 'hrvc_timezone=' + tz + ';path=/;max-age=31536000';
}

// Close modal on outside click
document.addEventListener('click', function(e) {
    var overlay = document.getElementById('addCurrModal');
    if (e.target === overlay) closeAddCurrency();
});

// Spin animation
var style = document.createElement('style');
style.textContent = '@keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }';
document.head.appendChild(style);
</script>
