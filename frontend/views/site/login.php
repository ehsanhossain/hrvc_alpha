<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'HRVC Login';
?>

<div class="login-page">
    <div class="login-card">
        <div class="login-card-inner">
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'options' => [
                    'enctype' => 'multipart/form-data',
                    'style' => 'width:100%;display:flex;flex-direction:column;align-items:center;gap:48px;',
                ],
                'fieldConfig' => [
                    'options' => ['tag' => false],
                    'template' => '{input}{error}',
                ],
            ]); ?>

            <!-- Header: Logo + Subtitle -->
            <div class="login-header-fields">
                <div class="login-logo-block">
                    <div class="login-logo">
                        <img src="<?= Yii::$app->homeUrl ?>image/hrvc-logo.svg" alt="HRVC" style="width:100%;height:100%;object-fit:contain;">
                    </div>
                    <div class="login-subtitle">Enter your credentials to access HRVC.</div>
                </div>

                <!-- Flash messages -->
                <?php if (Yii::$app->session->hasFlash('error')): ?>
                    <div class="login-alert login-alert-error">
                        <?= Yii::$app->session->getFlash('error') ?>
                    </div>
                <?php endif; ?>
                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="login-alert login-alert-success">
                        <?= Yii::$app->session->getFlash('success') ?>
                    </div>
                <?php endif; ?>

                <?php if ($model->hasErrors()): ?>
                    <div class="login-alert login-alert-error">
                        <?php foreach ($model->getFirstErrors() as $error): ?>
                            <?= Html::encode($error) ?><br>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Input Fields -->
                <div class="login-fields">
                    <!-- Work Email -->
                    <div class="login-field">
                        <div class="login-label-group">
                            <label class="login-label" for="login-email">Work Email</label>
                            <div class="login-input-frame">
                                <div class="login-input-left">
                                    <div class="login-input-icon">
                                        <svg viewBox="0 0 20 20" fill="none">
                                            <path d="M18.1249 5.62501V14.375C18.1249 15.4105 17.2854 16.25 16.2499 16.25H3.7499C2.71437 16.25 1.8749 15.4105 1.8749 14.375V5.62501M18.1249 5.62501C18.1249 4.58947 17.2854 3.75001 16.2499 3.75001H3.7499C2.71437 3.75001 1.8749 4.58947 1.8749 5.62501M18.1249 5.62501V5.82727C18.1249 6.47838 17.7871 7.08288 17.2326 7.42413L10.9826 11.2703C10.3799 11.6411 9.61986 11.6411 9.01722 11.2703L2.76722 7.42413C2.21269 7.08288 1.8749 6.47838 1.8749 5.82727V5.62501" stroke="#A3A3A3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <input type="email" id="login-email" name="LoginForm[username]" class="login-input" placeholder="name@company.com" required value="<?= Html::encode($model->username) ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="login-field">
                        <div class="login-label-group">
                            <label class="login-label" for="login-password">Password</label>
                            <div class="login-input-frame">
                                <div class="login-input-left">
                                    <div class="login-input-icon">
                                        <svg viewBox="0 0 20 20" fill="none">
                                            <path d="M13.75 8.75006V5.62506C13.75 3.554 12.0711 1.87506 10 1.87506C7.92893 1.87506 6.25 3.554 6.25 5.62506V8.75006M5.625 18.1251H14.375C15.4105 18.1251 16.25 17.2856 16.25 16.2501V10.6251C16.25 9.58953 15.4105 8.75006 14.375 8.75006H5.625C4.58947 8.75006 3.75 9.58953 3.75 10.6251V16.2501C3.75 17.2856 4.58946 18.1251 5.625 18.1251Z" stroke="#A3A3A3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <input type="password" id="login-password" name="LoginForm[password]" class="login-input" placeholder="Enter password here" required>
                                </div>
                                <div class="login-input-right" onclick="hrvcTogglePassword()" title="Show/hide password">
                                    <svg id="eye-icon" viewBox="0 0 20 20" fill="none">
                                        <path d="M2.5 10C2.5 10 5 4.375 10 4.375C15 4.375 17.5 10 17.5 10C17.5 10 15 15.625 10 15.625C5 15.625 2.5 10 2.5 10Z" stroke="#A3A3A3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5Z" stroke="#A3A3A3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <a class="login-forgot" href="javascript:void(0)" onclick="alert('Forgot password feature coming soon.')">Forgot password?</a>
                    </div>

                    <!-- Remember Me -->
                    <div class="login-remember-row">
                        <div class="login-remember-inner">
                            <div class="login-switch active" id="remember-switch" onclick="hrvcToggleRemember()">
                                <div class="login-switch-bg"></div>
                                <div class="login-switch-knob"></div>
                            </div>
                            <input type="hidden" name="LoginForm[rememberMe]" id="remember-input" value="1">
                            <div class="login-remember-text">Remember me</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Login Button -->
            <button type="submit" class="login-btn">
                <div class="login-btn-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M8.25 9V5.25C8.25 4.00736 9.25736 3 10.5 3L16.5 3C17.7426 3 18.75 4.00736 18.75 5.25L18.75 18.75C18.75 19.9926 17.7426 21 16.5 21H10.5C9.25736 21 8.25 19.9926 8.25 18.75V15M12 9L15 12M15 12L12 15M15 12L2.25 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                Login
            </button>

            <!-- Footer -->
            <div class="login-footer">
                <div class="login-terms">
                    By continuing you confirm that you agree with our
                    <a href="#">Privacy Policy</a>,
                    <a href="#">Disclosures</a>
                    &amp;
                    <a href="#">Terms and Conditions</a>.
                </div>
                <div class="login-help">
                    <span class="login-help-text">Having trouble signing in? </span>
                    <a class="login-help-link" href="#">Help Center</a>
                    <div class="login-help-arrow">
                        <svg viewBox="0 0 10 10" fill="none">
                            <path d="M1 9.00052L7.80449 1.76102" stroke="#1F6DB3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.18492 1.38054L8.56532 5.56558" stroke="#1F6DB3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.18505 1.38053L3.99999 1.00006" stroke="#1F6DB3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script>
function hrvcTogglePassword() {
    var input = document.getElementById('login-password');
    var icon = document.getElementById('eye-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.style.opacity = '1';
    } else {
        input.type = 'password';
        icon.style.opacity = '0.5';
    }
}

function hrvcToggleRemember() {
    var sw = document.getElementById('remember-switch');
    var input = document.getElementById('remember-input');
    if (sw.classList.contains('active')) {
        sw.classList.remove('active');
        input.value = '0';
    } else {
        sw.classList.add('active');
        input.value = '1';
    }
}
</script>