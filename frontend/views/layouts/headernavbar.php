<?php

use common\models\ModelMaster;
use frontend\models\hrvc\DefaultLanguage;
use frontend\models\hrvc\User;


?>
<div class="col-12">
    <div class="d-flex align-items-center justify-content-end pl-0 pr-0" style="gap: 8px; height: 55px;">
        <!-- Company/Workspace Selector -->
        <div class="company-selector" onclick="toggleCompanySelector()" style="margin-right: 0;">
            <div class="company-dot"></div>
            <div class="company-selector-info">
                <span class="company-selector-name"><?= isset(Yii::$app->user->id) ? \frontend\models\hrvc\User::companyName() : 'Select Company' ?></span>
                <span class="company-selector-label">COMPANY</span>
            </div>
            <div class="company-selector-chevron">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M3 5L6 8L9 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
        </div>

        <!-- Global Search -->
        <div style="flex: 1; max-width: 280px; margin-right: auto; margin-left: 8px;">
            <div style="position: relative;">
                <img src="<?= Yii::$app->homeUrl ?>image/search.svg" 
                    style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 13px; height: 13px; opacity: 0.45;">
                <input type="text" id="globalSearch" 
                    placeholder="<?= Yii::t('app', 'Search...') ?>" 
                    autocomplete="off"
                    style="width: 100%; height: 32px; padding: 0 12px 0 30px; border: 1px solid #E0E0E0; border-radius: 6px; font-size: 12px; background: #F8F9FA; outline: none; transition: all 0.15s ease; color: #333;">
            </div>
        </div>

        <!-- User Name & Title -->
        <div class="header-name">
            <?= isset(Yii::$app->user->id) ? User::userHeaderName() : 'Login' ?>
            <div class="header-pepartment text-end">
                <?= isset(Yii::$app->user->id) ? User::employeeTitleDepartment() : '' ?>
            </div>
        </div>

        <!-- Profile Pill -->
        <div class="profile-dropdown" style="cursor: pointer; position: relative;" onclick="toggleProfileMenu()">
            <img src="<?= Yii::$app->homeUrl ?><?= isset(Yii::$app->user->id) ? User::userHeaderImage() : 'image/user.png' ?>" class="width-ehsan-small">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-blue.svg" class="ms-1" style="width: 10px;">
            <div class="profile-box-menu text-start profile-menu" id="profileMenu">
                <?php
                if (isset(Yii::$app->user->id)) {
                    $employeeId = User::employeeIdFromUserId(); ?>
                    <a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(["employeeId" => $employeeId]) ?>"
                        style="text-decoration:none;color:#30313D;">
                        <div class="col-12 head-list-menu">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/navbar/profile.svg" class="mr-12 profile-menu-icon">
                            <?= Yii::t('app', 'My Profile') ?>
                        </div>
                    </a>
                <?php
                }
                ?>
                <div class="col-12 head-list-menu">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/navbar/setting.svg" class="mr-12 profile-menu-icon">
                    <?= Yii::t('app', 'Setting') ?>
                </div>
                <div class="col-12 head-list-menu">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/navbar/help.svg" class="mr-12 profile-menu-icon">
                    <?= Yii::t('app', 'Help & Support') ?>
                </div>
                <div class="col-12 mt-1 px-3">
                    <a href="<?= Yii::$app->homeUrl ?>site/logout" style="text-decoration:none;color:#FFFFFF;">
                        <div class="logout-button text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/navbar/logout.svg" class="mr-13 profile-menu-icon">
                            <?= Yii::t('app', 'Logout') ?>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <?php
        $cookie = Yii::$app->request->cookies;
        if (isset($_GET['language'])) {
            $language = $_GET['language'];
        } else {
            if ($cookie->has('language')) {
                $language = $cookie->getValue('language');
            } else {
                $language = DefaultLanguage::userDefaultLanguage();
                if ($language == '') {
                    $language = "en-US";
                }
            }
        }
        switch ($language) {
            case 'en-US':
                $image = 'usa';
                $text = 'EN';
                break;
            case 'jp':
                $image = 'japan';
                $text = 'JP';
                break;
            case 'th':
                $image = 'thailand';
                $text = 'TH';
                break;
            case 'vt':
                $image = 'vietnam';
                $text = 'VT';
                break;
            case 'cn':
                $image = 'china';
                $text = 'CN';
                break;
            case 'es':
                $image = 'span';
                $text = 'ES';
                break;
            case 'id':
                $image = 'bahasa';
                $text = 'ID';
                break;
        }
        ?>
        <input type="hidden" value="<?= $text ?>">

        <!-- Language Pill -->
        <div class="language-dropdown" style="cursor: pointer; position: relative;" onclick="toggleCountryMenu()">
            <img src="<?= Yii::$app->homeUrl ?>images/flag/<?= $image ?>.svg" style="width: 22px; height: 22px; border-radius: 50%;">
            <span class="language-text ms-1" style="font-size: 12px; font-weight: 600;"><?= $text ?></span>
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-blue.svg" class="ms-1" style="width: 10px;">
            <div class="country-box-menu text-start" id="countryMenu">
                <a href="?language=jp" style="text-decoration:none;color:#30313D;display:<?= $text == 'JP' ? 'none' : '' ?>">
                    <div class="col-12 head-list-menu">
                        <img src="<?= Yii::$app->homeUrl ?>images/flag/japan.svg" class="mr-12 profile-menu-icon">
                        日本語
                    </div>
                </a>
                <a href="?language=en-US" style="text-decoration:none;color:#30313D;display:<?= $text == 'EN' ? 'none' : '' ?>">
                    <div class="col-12 head-list-menu">
                        <img src="<?= Yii::$app->homeUrl ?>images/flag/usa.svg" class="mr-12 profile-menu-icon">
                        English
                    </div>
                </a>
                <a href="?language=th" style="text-decoration:none;color:#30313D;display:<?= $text == 'th' ? 'none' : '' ?>">
                    <div class="col-12 head-list-menu">
                        <img src="<?= Yii::$app->homeUrl ?>images/flag/thailand.svg" class="mr-12 profile-menu-icon">
                        ไทย
                    </div>
                </a>
                <a href="?language=cn" style="text-decoration:none;color:#30313D;display:<?= $text == 'CN' ? 'none' : '' ?>">
                    <div class="col-12 head-list-menu">
                        <img src="<?= Yii::$app->homeUrl ?>images/flag/china.svg" class="mr-12 profile-menu-icon">
                        中文
                    </div>
                </a>
                <a href="?language=vt" style="text-decoration:none;color:#30313D;display:<?= $text == 'VT' ? 'none' : '' ?>">
                    <div class="col-12 head-list-menu">
                        <img src="<?= Yii::$app->homeUrl ?>images/flag/vietnam.svg" class="mr-12 profile-menu-icon">
                        Tiếng Việt
                    </div>
                </a>
                <a href="?language=id" style="text-decoration:none;color:#30313D;display:<?= $text == 'ID' ? 'none' : '' ?>">
                    <div class="col-12 head-list-menu">
                        <img src="<?= Yii::$app->homeUrl ?>images/flag/bahasa.svg" class="mr-12 profile-menu-icon">
                        Bahasa
                    </div>
                </a>
                <a href="?language=es" style="text-decoration:none;color:#30313D;display:<?= $text == 'ES' ? 'none' : '' ?>">
                    <div class="col-12 head-list-menu">
                        <img src="<?= Yii::$app->homeUrl ?>images/flag/span.svg" class="mr-12 profile-menu-icon">
                        Español
                    </div>
                </a>
            </div>
        </div>

        <!-- Notification Pill (gray = no notifications) -->
        <div class="notification-pill" style="margin-right: 8px;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/no-noti.svg" class="bell-noti" style="opacity: 0.5;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-blue.svg" class="ms-1" style="width: 10px; opacity: 0.5;">
        </div>
    </div>
</div>

<script>
function toggleCompanySelector() {
    // TODO: Implement company selector dropdown with AJAX company list
    console.log('Company selector clicked — dropdown coming soon');
}

function toggleProfileMenu() {
    var menu = document.getElementById('profileMenu');
    var countryMenu = document.getElementById('countryMenu');
    if (countryMenu) countryMenu.style.display = 'none';
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

function toggleCountryMenu() {
    var menu = document.getElementById('countryMenu');
    var profileMenu = document.getElementById('profileMenu');
    if (profileMenu) profileMenu.style.display = 'none';
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

// Close menus when clicking outside
document.addEventListener('click', function(e) {
    var profileDropdown = document.querySelector('.profile-dropdown[onclick]');
    var langDropdown = document.querySelector('.language-dropdown[onclick]');
    var profileMenu = document.getElementById('profileMenu');
    var countryMenu = document.getElementById('countryMenu');
    
    if (profileMenu && profileDropdown && !profileDropdown.contains(e.target)) {
        profileMenu.style.display = 'none';
    }
    if (countryMenu && langDropdown && !langDropdown.contains(e.target)) {
        countryMenu.style.display = 'none';
    }
});

// Global search focus effect
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('globalSearch');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            this.style.borderColor = '#2580D3';
            this.style.background = '#FFFFFF';
            this.style.boxShadow = '0 0 0 2px rgba(37,128,211,0.1)';
        });
        searchInput.addEventListener('blur', function() {
            this.style.borderColor = '#E0E0E0';
            this.style.background = '#F8F9FA';
            this.style.boxShadow = 'none';
        });
    }
});
</script>