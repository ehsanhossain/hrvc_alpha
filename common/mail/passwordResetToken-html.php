<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */
/** @var string $resetLink */
/** @var string $resetCode */

$code = str_split($resetCode);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Your Password - HRVC</title>
</head>
<body style="margin:0;padding:0;background-color:#f5f5f5;font-family:'Segoe UI',Arial,Helvetica,sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f5f5f5;padding:40px 20px;">
<tr><td align="center">

<!-- Main Card -->
<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:12px;overflow:hidden;max-width:600px;width:100%;">

<!-- Logo -->
<tr><td align="center" style="padding:40px 40px 20px;">
    <img src="https://app.tcghrvc.com/images/hrvc-logo.svg" alt="HRVC" width="100" style="display:block;">
</td></tr>

<!-- Reset Icon -->
<tr><td align="center" style="padding:0 40px 16px;">
    <div style="width:52px;height:52px;border-radius:50%;background:#e8f4fd;display:inline-flex;align-items:center;justify-content:center;">
        <img src="https://app.tcghrvc.com/images/icons/Settings/reset-icon.svg" alt="" width="28" height="28" style="display:block;">
    </div>
</td></tr>

<!-- Title -->
<tr><td align="center" style="padding:0 40px 16px;">
    <h1 style="margin:0;font-size:22px;font-weight:600;color:#1a1a1a;line-height:1.3;">Reset password instruction</h1>
</td></tr>

<!-- Description -->
<tr><td align="center" style="padding:0 40px 24px;">
    <p style="margin:0;font-size:14px;line-height:1.6;color:#666666;text-align:center;">
        You've recently initiated a password reset for your HRVC account. To proceed with the reset, please utilize the button below. Note that this message will expire within 24 hours.
    </p>
</td></tr>

<!-- Reset Button -->
<tr><td align="center" style="padding:0 40px 24px;">
    <table role="presentation" cellpadding="0" cellspacing="0">
    <tr><td align="center" style="background-color:#2580D3;border-radius:8px;">
        <a href="<?= Html::encode($resetLink) ?>" target="_blank" style="display:inline-block;padding:12px 32px;font-size:14px;font-weight:600;color:#ffffff;text-decoration:none;border-radius:8px;">Reset Password</a>
    </td></tr>
    </table>
</td></tr>

<!-- Or Code Text -->
<tr><td align="center" style="padding:0 40px 16px;">
    <p style="margin:0;font-size:14px;color:#666666;">Or use the following verification code</p>
</td></tr>

<!-- Code Boxes -->
<tr><td align="center" style="padding:0 40px 28px;">
    <table role="presentation" cellpadding="0" cellspacing="0">
    <tr>
        <?php foreach ($code as $digit): ?>
        <td style="padding:0 5px;">
            <div style="width:48px;height:56px;border:2px solid #e0e0e0;border-radius:10px;text-align:center;line-height:56px;font-size:24px;font-weight:700;color:#1a1a1a;"><?= Html::encode($digit) ?></div>
        </td>
        <?php endforeach; ?>
    </tr>
    </table>
</td></tr>

<!-- Divider -->
<tr><td style="padding:0 40px;"><hr style="border:none;border-top:1px solid #eeeeee;margin:0;"></td></tr>

<!-- Security Notice -->
<tr><td style="padding:20px 40px 30px;">
    <p style="margin:0;font-size:12px;line-height:1.7;color:#999999;">
        Your security is important to us. If you did not initiate this password reset or suspect any unauthorized activity, please contact our <a href="mailto:support@tcghrvc.com" style="color:#2580D3;font-weight:600;text-decoration:none;">support team</a> immediately. Never share your password or verification codes with anyone. Thank you for choosing HRVC and ensuring the safety of your account.
    </p>
</td></tr>

</table>
<!-- End Main Card -->

<!-- Social Icons -->
<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;">
<tr><td align="center" style="padding:24px 40px 12px;">
    <table role="presentation" cellpadding="0" cellspacing="0">
    <tr>
        <td style="padding:0 6px;"><a href="#"><img src="https://app.tcghrvc.com/images/icons/social/facebook.png" alt="Facebook" width="20" height="20"></a></td>
        <td style="padding:0 6px;"><a href="#"><img src="https://app.tcghrvc.com/images/icons/social/x.png" alt="X" width="20" height="20"></a></td>
        <td style="padding:0 6px;"><a href="#"><img src="https://app.tcghrvc.com/images/icons/social/linkedin.png" alt="LinkedIn" width="20" height="20"></a></td>
        <td style="padding:0 6px;"><a href="#"><img src="https://app.tcghrvc.com/images/icons/social/dribbble.png" alt="Dribbble" width="20" height="20"></a></td>
        <td style="padding:0 6px;"><a href="#"><img src="https://app.tcghrvc.com/images/icons/social/instagram.png" alt="Instagram" width="20" height="20"></a></td>
    </tr>
    </table>
</td></tr>

<!-- Footer Text -->
<tr><td align="center" style="padding:8px 40px 4px;">
    <p style="margin:0;font-size:12px;color:#999999;">
        Have questions or concerns? Reach out to us at <a href="mailto:support@tcghrvc.com" style="color:#2580D3;text-decoration:none;">support@tcghrvc.com</a>
    </p>
</td></tr>
<tr><td align="center" style="padding:0 40px 4px;">
    <p style="margin:0;font-size:12px;color:#999999;">
        If you no longer wish to receive emails from HRVC, <a href="#" style="color:#2580D3;text-decoration:none;font-weight:600;">unsubscribe</a> here.
    </p>
</td></tr>
<tr><td align="center" style="padding:12px 40px 40px;">
    <p style="margin:0;font-size:11px;color:#cccccc;">Copyright &copy; <?= date('Y') ?> TCG. All rights reserved.</p>
</td></tr>
</table>

</td></tr>
</table>
</body>
</html>
