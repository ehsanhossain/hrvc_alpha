<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\PasswordResetRequestForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Reset Password';
?>

<div class="login-page">
    <div class="login-card">
        <div class="login-card-inner">
            <?php $form = ActiveForm::begin([
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
                    <div class="login-subtitle">Enter your email to receive a password reset code.</div>
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
                    <!-- Email Field -->
                    <div class="login-field">
                        <div class="login-label-group">
                            <label class="login-label" for="reset-email">Work Email</label>
                            <div class="login-input-frame">
                                <div class="login-input-left">
                                    <div class="login-input-icon">
                                        <svg viewBox="0 0 20 20" fill="none">
                                            <path d="M18.1249 5.62501V14.375C18.1249 15.4105 17.2854 16.25 16.2499 16.25H3.7499C2.71437 16.25 1.8749 15.4105 1.8749 14.375V5.62501M18.1249 5.62501C18.1249 4.58947 17.2854 3.75001 16.2499 3.75001H3.7499C2.71437 3.75001 1.8749 4.58947 1.8749 5.62501M18.1249 5.62501V5.82727C18.1249 6.47838 17.7871 7.08288 17.2326 7.42413L10.9826 11.2703C10.3799 11.6411 9.61986 11.6411 9.01722 11.2703L2.76722 7.42413C2.21269 7.08288 1.8749 6.47838 1.8749 5.82727V5.62501" stroke="#A3A3A3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <input type="email" id="reset-email" name="PasswordResetRequestForm[email]" class="login-input" placeholder="name@company.com" required value="<?= Html::encode($model->email) ?>" autofocus>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Send Reset Code Button -->
            <button type="submit" class="login-btn">
                <div class="login-btn-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M21.75 6.75V17.25C21.75 18.4926 20.7426 19.5 19.5 19.5H4.5C3.25736 19.5 2.25 18.4926 2.25 17.25V6.75M21.75 6.75C21.75 5.50736 20.7426 4.5 19.5 4.5H4.5C3.25736 4.5 2.25 5.50736 2.25 6.75M21.75 6.75V6.993C21.75 7.77382 21.3446 8.49946 20.679 8.909L13.179 13.524C12.4558 13.9693 11.5442 13.9693 10.821 13.524L3.321 8.909C2.65536 8.49946 2.25 7.77382 2.25 6.993V6.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                Send Reset Code
            </button>

            <!-- Footer -->
            <div class="login-footer">
                <div class="login-help">
                    <span class="login-help-text">Remember your password? </span>
                    <a class="login-help-link" href="<?= Yii::$app->homeUrl ?>site/login">Back to Login</a>
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
