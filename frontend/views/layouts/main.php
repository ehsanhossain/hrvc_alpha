<?php

/** @var \yii\web\View $this */
/** @var string $content */


use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\NavBar;
use yii\helpers\Html as HelpersHtml;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">


<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl; ?>/image/hrvc-favicon.png?v=2" type="image/png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <?= HelpersHtml::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php
    $js = <<<JS
$(document).ajaxSend(function(event, jqxhr, settings) {
    if (!settings.data) {
        settings.data = '';
    }
    var csrfParam = $('meta[name="csrf-param"]').attr('content');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (settings.type === 'POST' && csrfParam && csrfToken) {
        if (typeof settings.data === 'string') {
            settings.data += '&' + encodeURIComponent(csrfParam) + '=' + encodeURIComponent(csrfToken);
        } else if (typeof settings.data === 'object') {
            settings.data[csrfParam] = csrfToken;
        }
    }
});
JS;
    $this->registerJs($js, \yii\web\View::POS_END);
    ?>

</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
    <div class="col-4 alert-box2 text-center mt-20">
        <?= Yii::t('app', 'Saved') ?>
    </div>
    <!-- <header>

        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-white fixed-top',
            ],

        ]);
        NavBar::end();
        ?>

    </header> -->

    <main role="main">
        <div class="d-flex align-items-start justify-content-start">
            <div class="menu-left-side" id="sidebar">
                <div class="sidebar-toggle-btn" id="sidebarToggle" onclick="toggleSidebar()" title="Collapse sidebar">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" id="toggleChevron">
                        <path d="M13 4L7 10L13 16" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <?= $this->render("@frontend/views/site/menu_left")
                ?>
            </div>
            <div class="main-content d-flex flex-grow-1">
                <div class="header-top bg-white">
                    <?= $this->render("@frontend/views/layouts/headernavbar")
                    ?>
                </div>
                <div class="submain-content">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </main>
    <script>
    function toggleSidebar() {
        document.body.classList.toggle('sidebar-collapsed');
        var collapsed = document.body.classList.contains('sidebar-collapsed');
        localStorage.setItem('hrvc_sidebar_collapsed', collapsed ? '1' : '0');
        // Update tooltip
        var toggleBtn = document.getElementById('sidebarToggle');
        if (toggleBtn) {
            toggleBtn.title = collapsed ? 'Expand sidebar' : 'Collapse sidebar';
        }
    }
    // Restore sidebar state on load
    (function() {
        if (localStorage.getItem('hrvc_sidebar_collapsed') === '1') {
            document.body.classList.add('sidebar-collapsed');
            var toggleBtn = document.getElementById('sidebarToggle');
            if (toggleBtn) toggleBtn.title = 'Expand sidebar';
        }
    })();
    </script>
    <?php
    if (class_exists('yii\debug\Module')) {
        $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
    }
    $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
