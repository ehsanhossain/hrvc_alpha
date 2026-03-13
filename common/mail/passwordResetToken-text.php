<?php

/** @var yii\web\View $this */
/** @var common\models\User $user */
/** @var string $resetLink */
/** @var string $resetCode */
?>
Reset password instruction
==========================

Hello,

You've recently initiated a password reset for your HRVC account.
To proceed with the reset, please click the link below:

<?= $resetLink ?>

Or use the following verification code: <?= $resetCode ?>

Note that this message will expire within 24 hours.

If you did not initiate this password reset, please contact support@tcghrvc.com immediately.

- HRVC Team
