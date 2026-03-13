<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ResetPasswordForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Set New Password';
?>

<div class="login-page">
    <div class="login-card">
        <div class="login-card-inner">
            <?php $form = ActiveForm::begin([
                'id' => 'reset-password-form',
                'method' => 'post',
                'options' => [
                    'style' => 'width:100%;display:flex;flex-direction:column;align-items:center;gap:48px;',
                ],
                'fieldConfig' => [
                    'options' => ['tag' => false],
                    'template' => '{input}{error}',
                ],
            ]); ?>

            <!-- Header: Logo + Description -->
            <div class="login-header-fields">
                <div class="login-logo-block">
                    <div class="login-logo">
                        <img src="<?= Yii::$app->homeUrl ?>image/hrvc-logo.svg" alt="HRVC" style="width:100%;height:100%;object-fit:contain;">
                    </div>
                    <div class="login-subtitle">Choose your new password to complete the reset.</div>
                </div>

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

                <!-- Password Field -->
                <div class="login-fields">
                    <div class="login-field">
                        <div class="login-label-group">
                            <label class="login-label" for="reset-pw-input">New Password</label>
                            <div class="login-input-frame">
                                <div class="login-input-left">
                                    <div class="login-input-icon">
                                        <svg viewBox="0 0 20 20" fill="none">
                                            <path d="M13.75 8.75006V5.62506C13.75 3.554 12.0711 1.87506 10 1.87506C7.92893 1.87506 6.25 3.554 6.25 5.62506V8.75006M5.625 18.1251H14.375C15.4105 18.1251 16.25 17.2856 16.25 16.2501V10.6251C16.25 9.58953 15.4105 8.75006 14.375 8.75006H5.625C4.58947 8.75006 3.75 9.58953 3.75 10.6251V16.2501C3.75 17.2856 4.58946 18.1251 5.625 18.1251Z" stroke="#A3A3A3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <input type="password" id="reset-pw-input" name="ResetPasswordForm[password]" class="login-input" placeholder="Enter new password (min 8 characters)" required autofocus>
                                </div>
                                <div class="login-input-right" onclick="hrvcTogglePw()" title="Show/hide password">
                                    <svg id="pw-eye-icon" viewBox="0 0 20 20" fill="none">
                                        <path d="M2.5 10C2.5 10 5 4.375 10 4.375C15 4.375 17.5 10 17.5 10C17.5 10 15 15.625 10 15.625C5 15.625 2.5 10 2.5 10Z" stroke="#A3A3A3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5Z" stroke="#A3A3A3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <button type="submit" class="login-btn">
                <div class="login-btn-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                Save New Password
            </button>

            <!-- Footer -->
            <div class="login-footer">
                <div class="login-help">
                    <span class="login-help-text">Go back to </span>
                    <a class="login-help-link" href="<?= Yii::$app->homeUrl ?>site/login">Login</a>
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
function hrvcTogglePw() {
    var input = document.getElementById('reset-pw-input');
    var icon = document.getElementById('pw-eye-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.style.opacity = '1';
    } else {
        input.type = 'password';
        icon.style.opacity = '0.5';
    }
}
</script>
