<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ResetPasswordByCodeForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Verify & Reset Password';
?>
<style>
/* Code input boxes – extends the login design system */
.reset-code-group {
    display: flex;
    gap: 12px;
    justify-content: center;
    align-self: stretch;
}
.reset-code-box {
    width: 56px;
    height: 60px;
    border: 1px solid #e5e5e5;
    border-radius: 6px;
    text-align: center;
    font-size: 28px;
    font-weight: 700;
    color: #171717;
    outline: none;
    font-family: Inter, sans-serif;
    background: #fff;
    box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.04);
    transition: border-color 0.2s, box-shadow 0.2s;
}
.reset-code-box:focus {
    border-color: #2580d3;
    box-shadow: 0 0 0 3px rgba(37, 128, 211, 0.1);
}
.reset-divider {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #a3a3a3;
    font-size: 13px;
}
.reset-divider::before,
.reset-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #e5e5e5;
}
@media (max-width: 480px) {
    .reset-code-box {
        width: 48px;
        height: 52px;
        font-size: 24px;
    }
    .reset-code-group {
        gap: 8px;
    }
}
</style>

<div class="login-page">
    <div class="login-card">
        <div class="login-card-inner">
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'options' => [
                    'style' => 'width:100%;display:flex;flex-direction:column;align-items:center;gap:36px;',
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
                    <div class="login-subtitle">Enter the 4-digit code sent to your email and choose a new password.</div>
                </div>

                <!-- Flash messages -->
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
                    <!-- Email Field -->
                    <div class="login-field">
                        <div class="login-label-group">
                            <label class="login-label" for="reset-code-email">Work Email</label>
                            <div class="login-input-frame">
                                <div class="login-input-left">
                                    <div class="login-input-icon">
                                        <svg viewBox="0 0 20 20" fill="none">
                                            <path d="M18.1249 5.62501V14.375C18.1249 15.4105 17.2854 16.25 16.2499 16.25H3.7499C2.71437 16.25 1.8749 15.4105 1.8749 14.375V5.62501M18.1249 5.62501C18.1249 4.58947 17.2854 3.75001 16.2499 3.75001H3.7499C2.71437 3.75001 1.8749 4.58947 1.8749 5.62501M18.1249 5.62501V5.82727C18.1249 6.47838 17.7871 7.08288 17.2326 7.42413L10.9826 11.2703C10.3799 11.6411 9.61986 11.6411 9.01722 11.2703L2.76722 7.42413C2.21269 7.08288 1.8749 6.47838 1.8749 5.82727V5.62501" stroke="#A3A3A3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <input type="email" id="reset-code-email" name="ResetPasswordByCodeForm[email]" class="login-input" placeholder="name@company.com" required value="<?= Html::encode($model->email) ?>" <?= !empty($model->email) ? 'readonly' : '' ?>>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Verification Code -->
                    <div class="login-field">
                        <label class="login-label" style="text-align:center;align-self:center;">Verification Code</label>
                        <div class="reset-code-group">
                            <input type="text" class="reset-code-box" maxlength="1" data-index="0" inputmode="numeric" pattern="[0-9]*" autofocus>
                            <input type="text" class="reset-code-box" maxlength="1" data-index="1" inputmode="numeric" pattern="[0-9]*">
                            <input type="text" class="reset-code-box" maxlength="1" data-index="2" inputmode="numeric" pattern="[0-9]*">
                            <input type="text" class="reset-code-box" maxlength="1" data-index="3" inputmode="numeric" pattern="[0-9]*">
                        </div>
                        <!-- Hidden real code field -->
                        <input type="hidden" name="ResetPasswordByCodeForm[code]" id="code-hidden" value="">
                    </div>

                    <div class="reset-divider">or use the reset link from email</div>

                    <!-- New Password -->
                    <div class="login-field">
                        <div class="login-label-group">
                            <label class="login-label" for="reset-new-password">New Password</label>
                            <div class="login-input-frame">
                                <div class="login-input-left">
                                    <div class="login-input-icon">
                                        <svg viewBox="0 0 20 20" fill="none">
                                            <path d="M13.75 8.75006V5.62506C13.75 3.554 12.0711 1.87506 10 1.87506C7.92893 1.87506 6.25 3.554 6.25 5.62506V8.75006M5.625 18.1251H14.375C15.4105 18.1251 16.25 17.2856 16.25 16.2501V10.6251C16.25 9.58953 15.4105 8.75006 14.375 8.75006H5.625C4.58947 8.75006 3.75 9.58953 3.75 10.6251V16.2501C3.75 17.2856 4.58946 18.1251 5.625 18.1251Z" stroke="#A3A3A3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <input type="password" id="reset-new-password" name="ResetPasswordByCodeForm[password]" class="login-input" placeholder="Enter new password (min 8 characters)" required>
                                </div>
                                <div class="login-input-right" onclick="hrvcToggleResetPw()" title="Show/hide password">
                                    <svg id="reset-eye-icon" viewBox="0 0 20 20" fill="none">
                                        <path d="M2.5 10C2.5 10 5 4.375 10 4.375C15 4.375 17.5 10 17.5 10C17.5 10 15 15.625 10 15.625C5 15.625 2.5 10 2.5 10Z" stroke="#A3A3A3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5Z" stroke="#A3A3A3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reset Password Button -->
            <button type="submit" class="login-btn">
                <div class="login-btn-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                Reset Password
            </button>

            <!-- Footer -->
            <div class="login-footer">
                <div class="login-help">
                    <span class="login-help-text">Didn't receive a code? </span>
                    <a class="login-help-link" href="<?= Yii::$app->homeUrl ?>site/request-password-reset">Request again</a>
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
document.addEventListener('DOMContentLoaded', function() {
    var boxes = document.querySelectorAll('.reset-code-box');
    var hiddenInput = document.getElementById('code-hidden');

    function updateHidden() {
        var code = '';
        boxes.forEach(function(b) { code += b.value; });
        hiddenInput.value = code;
    }

    boxes.forEach(function(box, i) {
        box.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            updateHidden();
            if (this.value && i < boxes.length - 1) {
                boxes[i + 1].focus();
            }
        });
        box.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !this.value && i > 0) {
                boxes[i - 1].focus();
                boxes[i - 1].value = '';
                updateHidden();
            }
        });
        box.addEventListener('paste', function(e) {
            e.preventDefault();
            var text = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
            for (var j = 0; j < Math.min(text.length, 4); j++) {
                boxes[j].value = text[j];
            }
            updateHidden();
            var nextIndex = Math.min(text.length, boxes.length - 1);
            boxes[nextIndex].focus();
        });
    });
});

function hrvcToggleResetPw() {
    var input = document.getElementById('reset-new-password');
    var icon = document.getElementById('reset-eye-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.style.opacity = '1';
    } else {
        input.type = 'password';
        icon.style.opacity = '0.5';
    }
}
</script>
