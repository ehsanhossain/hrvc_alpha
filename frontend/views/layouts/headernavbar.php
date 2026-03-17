<?php

use common\models\ModelMaster;
use common\helpers\CompanyContext;
use frontend\models\hrvc\DefaultLanguage;
use frontend\models\hrvc\User;
use frontend\models\hrvc\Company;

// Get company context data
$selectedCompanyId = CompanyContext::getCompanyId();
$selectedCompanyName = CompanyContext::getCompanyName();
$userCompanies = CompanyContext::getUserCompanies();
$homeUrl = Yii::$app->homeUrl;

// Get selected company picture
$companyPicture = '';
if ($selectedCompanyId) {
    $companyPicture = Company::companyPicture(Company::companyImage($selectedCompanyId));
}

// Generate initials as fallback
$companyInitials = $selectedCompanyId
    ? strtoupper(substr($selectedCompanyName, 0, 1))
    : '⊞';
$companyLabel = $selectedCompanyId ? 'Company' : 'ALL COMPANIES';

?>
<div class="col-12">
    <div class="hdr-bar">
        <!-- ═══ LEFT: Company Selector + Search ═══ -->
        <div class="hdr-left">
            <!-- Company Chip -->
            <div class="hdr-company" id="companyChip" onclick="toggleCompanySelector(event)">
                <div class="hdr-company-logo" id="companyLogoWrap">
                    <?php if ($companyPicture && $companyPicture !== 'image/userProfile.png'): ?>
                        <img src="<?= $homeUrl . $companyPicture ?>" alt="<?= htmlspecialchars($selectedCompanyName) ?>" class="hdr-company-logo-img" id="companyLogo">
                    <?php else: ?>
                        <span class="hdr-company-initials" id="companyInitials"><?= $companyInitials ?></span>
                    <?php endif; ?>
                </div>
                <div class="hdr-company-info">
                    <span class="hdr-company-name"><?= htmlspecialchars($selectedCompanyName) ?></span>
                    <span class="hdr-company-label"><?= $companyLabel ?></span>
                </div>
                <svg class="hdr-company-caret" width="12" height="8" viewBox="0 0 12 8" fill="none">
                    <path d="M1 1.5L6 6.5L11 1.5" stroke="#94A3B8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <!-- Company Dropdown Menu -->
                <div class="hdr-dropdown" id="companyDropdownMenu">
                    <!-- All Companies Option -->
                    <div class="hdr-dropdown-item <?= !$selectedCompanyId ? 'active' : '' ?>"
                         onclick="switchCompany(0, event)">
                        <div class="hdr-dropdown-icon" style="background:linear-gradient(135deg,#4F8CFF,#6C5CE7);">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M3 21h18M3 7v14m18-14v14M9 10h1m5 0h1M9 14h1m5 0h1M9 18h1m5 0h1M9 6V3h6v3" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div class="hdr-dropdown-text">
                            <span class="hdr-dropdown-name">All Companies</span>
                            <span class="hdr-dropdown-sub">View all data</span>
                        </div>
                        <?php if (!$selectedCompanyId): ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="#4F8CFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($userCompanies)): ?>
                    <div class="hdr-dropdown-divider"></div>
                    <div class="hdr-dropdown-section-label">Companies</div>
                    <?php foreach ($userCompanies as $company):
                        $cPic = Company::companyPicture(!empty($company['picture']) ? $company['picture'] : '');
                        $isActive = $selectedCompanyId == $company['companyId'];
                    ?>
                    <div class="hdr-dropdown-item <?= $isActive ? 'active' : '' ?>"
                         onclick="switchCompany(<?= $company['companyId'] ?>, event)">
                        <div class="hdr-dropdown-icon" style="background:<?= $isActive ? '#34C759' : '#E8E8E8' ?>;">
                            <?php if ($cPic && $cPic !== 'image/userProfile.png'): ?>
                                <img src="<?= $homeUrl . $cPic ?>" width="18" height="18" style="border-radius:4px;object-fit:cover;">
                            <?php else: ?>
                                <span style="font-size:12px;font-weight:700;color:<?= $isActive ? '#fff' : '#666' ?>;"><?= strtoupper(substr($company['companyName'], 0, 1)) ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="hdr-dropdown-text">
                            <span class="hdr-dropdown-name"><?= htmlspecialchars($company['companyName']) ?></span>
                            <?php if (!empty($company['displayName']) && $company['displayName'] !== $company['companyName']): ?>
                            <span class="hdr-dropdown-sub"><?= htmlspecialchars($company['displayName']) ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if ($isActive): ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="#34C759" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Search Pill -->
            <div class="hdr-search" onclick="document.getElementById('globalSearch').focus();">
                <svg class="hdr-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="#A3A3A3" stroke-width="2"/>
                    <path d="M16.5 16.5L21 21" stroke="#A3A3A3" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <input type="text" id="globalSearch"
                    placeholder="<?= Yii::t('app', 'Search') ?>"
                    autocomplete="off"
                    class="hdr-search-input">
                <div class="hdr-search-shortcut">
                    <span class="hdr-search-key">⌘</span>
                    <span class="hdr-search-key">K</span>
                </div>
            </div>
        </div>

        <!-- ═══ RIGHT: Profile Info + Avatar + Notifications ═══ -->
        <div class="hdr-right">
            <!-- User Name & Title -->
            <div class="hdr-user-info">
                <span class="hdr-user-name"><?= isset(Yii::$app->user->id) ? User::userHeaderName() : 'Login' ?></span>
                <span class="hdr-user-title"><?= isset(Yii::$app->user->id) ? User::employeeTitleDepartment() : '' ?></span>
            </div>

            <!-- Profile Pill -->
            <div class="hdr-profile-pill" onclick="toggleProfileMenu()">
                <img src="<?= $homeUrl ?><?= isset(Yii::$app->user->id) ? User::userHeaderImage() : 'image/user.png' ?>" class="hdr-profile-img" alt="Profile">
                <svg class="hdr-profile-caret" width="10" height="7" viewBox="0 0 10 7" fill="none">
                    <path d="M1 1L5 5L9 1" stroke="#2580D3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <!-- Profile Dropdown -->
                <div class="hdr-profile-menu" id="profileMenu">
                    <?php if (isset(Yii::$app->user->id)):
                        $employeeId = User::employeeIdFromUserId(); ?>
                        <a href="<?= $homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(["employeeId" => $employeeId]) ?>" class="hdr-profile-link">
                            <img src="<?= $homeUrl ?>images/icons/black-icons/navbar/profile.svg" width="16" height="16">
                            <?= Yii::t('app', 'My Profile') ?>
                        </a>
                    <?php endif; ?>
                    <a href="<?= $homeUrl ?>setting/default/master-settings" class="hdr-profile-link">
                        <img src="<?= $homeUrl ?>images/icons/black-icons/navbar/setting.svg" width="16" height="16">
                        <?= Yii::t('app', 'Settings') ?>
                    </a>
                    <a href="#" class="hdr-profile-link">
                        <img src="<?= $homeUrl ?>images/icons/black-icons/navbar/help.svg" width="16" height="16">
                        <?= Yii::t('app', 'Help & Support') ?>
                    </a>
                    <div class="hdr-profile-divider"></div>
                    <a href="<?= $homeUrl ?>site/logout" class="hdr-profile-logout">
                        <img src="<?= $homeUrl ?>images/icons/black-icons/navbar/logout.svg" width="16" height="16">
                        <?= Yii::t('app', 'Logout') ?>
                    </a>
                </div>
            </div>

            <!-- Notification Pill -->
            <a href="<?= $homeUrl ?>site/notifications" class="hdr-noti-pill" id="notiPill" style="text-decoration:none;">
                <img src="<?= $homeUrl ?>image/notification-ring.svg" class="hdr-noti-bell" id="notiIconRing" width="22" height="22" style="display:none;">
                <img src="<?= $homeUrl ?>image/no-notification.svg" class="hdr-noti-bell" id="notiIconNone" width="22" height="22">
                <span class="hdr-noti-count" id="notiCount" style="display:none;">0</span>
            </a>
        </div>
    </div>
</div>

<?php
// Language setup (kept for cookie/session)
$cookie = Yii::$app->request->cookies;
if (isset($_GET['language'])) {
    $language = $_GET['language'];
} else {
    if ($cookie->has('language')) {
        $language = $cookie->getValue('language');
    } else {
        $language = DefaultLanguage::userDefaultLanguage();
        if ($language == '') { $language = "en-US"; }
    }
}
?>

<script>
function toggleCompanySelector(e) {
    if (e) e.stopPropagation();
    var menu = document.getElementById('companyDropdownMenu');
    var profileMenu = document.getElementById('profileMenu');
    if (profileMenu) profileMenu.classList.remove('open');
    menu.classList.toggle('open');
}

function switchCompany(companyId, e) {
    if (e) e.stopPropagation();
    var items = document.querySelectorAll('.hdr-dropdown-item');
    items.forEach(function(item) { item.style.opacity = '0.5'; item.style.pointerEvents = 'none'; });

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?= $homeUrl ?>site/switch-company', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-CSRF-Token', document.querySelector('meta[name="csrf-token"]')?.content || '');
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var res = JSON.parse(xhr.responseText);
                if (res.success) { window.location.reload(); return; }
            } catch(ex) {}
        }
        items.forEach(function(item) { item.style.opacity = '1'; item.style.pointerEvents = ''; });
        alert('Failed to switch company.');
    };
    xhr.onerror = function() {
        items.forEach(function(item) { item.style.opacity = '1'; item.style.pointerEvents = ''; });
    };
    var csrfParam = '<?= Yii::$app->request->csrfParam ?>';
    var csrfToken = '<?= Yii::$app->request->csrfToken ?>';
    xhr.send(csrfParam + '=' + encodeURIComponent(csrfToken) + '&companyId=' + companyId);
}

function toggleProfileMenu() {
    var menu = document.getElementById('profileMenu');
    var companyMenu = document.getElementById('companyDropdownMenu');
    if (companyMenu) companyMenu.classList.remove('open');
    menu.classList.toggle('open');
}

// Close all menus when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('#companyChip')) {
        var cm = document.getElementById('companyDropdownMenu');
        if (cm) cm.classList.remove('open');
    }
    if (!e.target.closest('.hdr-profile-pill')) {
        var pm = document.getElementById('profileMenu');
        if (pm) pm.classList.remove('open');
    }
});

// Keyboard shortcut: Ctrl/Cmd + K → focus search
document.addEventListener('keydown', function(e) {
    if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
        e.preventDefault();
        var input = document.getElementById('globalSearch');
        if (input) input.focus();
    }
});

// ─── Notification count loader ───
function loadNotificationCount() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?= $homeUrl ?>site/notification-count', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var res = JSON.parse(xhr.responseText);
                var count = parseInt(res.count) || 0;
                var pill = document.getElementById('notiPill');
                var countEl = document.getElementById('notiCount');
                var ringIcon = document.getElementById('notiIconRing');
                var noneIcon = document.getElementById('notiIconNone');
                
                if (count > 0) {
                    ringIcon.style.display = '';
                    noneIcon.style.display = 'none';
                    countEl.style.display = '';
                    countEl.textContent = count > 99 ? '99+' : count;
                    pill.style.background = '#EAF5FF';
                } else {
                    ringIcon.style.display = 'none';
                    noneIcon.style.display = '';
                    countEl.style.display = 'none';
                    pill.style.background = '#F0F2F4';
                }
            } catch(ex) {}
        }
    };
    xhr.send();
}

// Load on page load + poll every 30s
loadNotificationCount();
setInterval(loadNotificationCount, 30000);
</script>