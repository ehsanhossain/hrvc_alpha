<?php

/** @var yii\web\View $this */
/** @var string $employeeName */
/** @var string $companyName */
/** @var string $loginEmail */
/** @var string $tempPassword */
/** @var string $loginUrl */
?>
Welcome to HRVC! We're Excited to Have You Onboard!!
=====================================================

Dear <?= $employeeName ?>,

Welcome to <?= $companyName ?>

HRVC is built to empower organizations through smarter people management — from performance and skills to evaluation, growth, and beyond.

New Account Details
-------------------
Login ID: <?= $loginEmail ?>

Temporary Password: <?= $tempPassword ?>

System URL: <?= $loginUrl ?>


For security, please sign in and change your password immediately.
We recommend using a strong password:
- At least 8 characters
- Uppercase and lowercase letters
- A number
- A symbol

Sign in here: <?= $loginUrl ?>


If you have any issues accessing your account, please contact the HR department or email hr@tcghrvc.com

Best regards,
Shuhei Takahashi
Director, TCG
