<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var string $employeeName */
/** @var string $companyName */
/** @var string $loginEmail */
/** @var string $tempPassword */
/** @var string $loginUrl */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to HRVC</title>
</head>
<body style="margin:0;padding:0;background-color:#f5f5f5;font-family:'Segoe UI',Arial,Helvetica,sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f5f5f5;padding:40px 20px;">
<tr><td align="center">

<!-- Main Card -->
<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:12px;overflow:hidden;max-width:600px;width:100%;">

<!-- Logo -->
<tr><td align="center" style="padding:40px 40px 28px;">
    <img src="https://app.tcghrvc.com/images/hrvc-logo.svg" alt="HRVC" width="100" style="display:block;">
</td></tr>

<!-- Welcome Title -->
<tr><td style="padding:0 40px 20px;">
    <h1 style="margin:0;font-size:20px;font-weight:700;color:#1a1a1a;line-height:1.4;">Welcome to HRVC 🚀 We're Excited to Have You Onboard!!</h1>
</td></tr>

<!-- Greeting -->
<tr><td style="padding:0 40px 8px;">
    <p style="margin:0;font-size:14px;color:#333333;">Dear <?= Html::encode($employeeName) ?>,</p>
</td></tr>

<tr><td style="padding:0 40px 16px;">
    <p style="margin:0;font-size:14px;color:#333333;">Welcome to <strong><?= Html::encode($companyName) ?></strong></p>
</td></tr>

<!-- Welcome Paragraphs -->
<tr><td style="padding:0 40px 12px;">
    <p style="margin:0;font-size:13px;line-height:1.7;color:#555555;">
        HRVC is built to empower organizations through smarter people management — from performance and skills to evaluation, growth, and beyond. As part of this mission, you'll have the opportunity to contribute to a platform that helps companies unlock the full potential of their people.
    </p>
</td></tr>

<tr><td style="padding:0 40px 20px;">
    <p style="margin:0;font-size:13px;line-height:1.7;color:#555555;">
        Here at HRVC, we believe in collaboration, innovation, and growth — both for businesses and for every individual who is part of them. We're confident that your skills and passion will make a real impact, and we're here to support you every step of the way.
    </p>
</td></tr>

<!-- New Account Details -->
<tr><td style="padding:0 40px 20px;">
    <h2 style="margin:0 0 12px;font-size:15px;font-weight:700;color:#1a1a1a;">New Account Details</h2>
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
    <tr><td style="padding:4px 0;font-size:13px;color:#555;">
        <strong>Login ID:</strong> <?= Html::encode($loginEmail) ?>
    </td></tr>
    <tr><td style="padding:4px 0;font-size:13px;color:#555;">
        <strong>Temporary Password:</strong> <span style="background:#FFF3CD;padding:2px 8px;border-radius:4px;font-weight:600;color:#856404;"><?= Html::encode($tempPassword) ?></span>
    </td></tr>
    <tr><td style="padding:4px 0;font-size:13px;color:#555;">
        <strong>System URL:</strong> <a href="<?= Html::encode($loginUrl) ?>" style="color:#2580D3;text-decoration:none;"><?= Html::encode($loginUrl) ?></a>
    </td></tr>
    </table>
</td></tr>

<!-- Divider -->
<tr><td style="padding:0 40px;"><hr style="border:none;border-top:1px solid #eeeeee;margin:0;"></td></tr>

<!-- Security Recommendations -->
<tr><td style="padding:16px 40px 8px;">
    <p style="margin:0;font-size:13px;color:#555555;line-height:1.6;">
        For security, please sign in and change your password immediately.<br>
        We recommend using a strong password:
    </p>
    <ul style="margin:8px 0 0;padding-left:20px;font-size:12px;color:#777;line-height:1.8;">
        <li>At least 8 characters</li>
        <li>Uppercase and lowercase letters</li>
        <li>A number</li>
        <li>A symbol</li>
    </ul>
</td></tr>

<!-- Sign In Button -->
<tr><td align="center" style="padding:20px 40px 24px;">
    <table role="presentation" cellpadding="0" cellspacing="0">
    <tr><td align="center" style="background-color:#2580D3;border-radius:8px;">
        <a href="<?= Html::encode($loginUrl) ?>" target="_blank" style="display:inline-flex;align-items:center;gap:6px;padding:12px 28px;font-size:14px;font-weight:600;color:#ffffff;text-decoration:none;border-radius:8px;">
            🔐 Sign in to HRVC
        </a>
    </td></tr>
    </table>
</td></tr>

<!-- Divider -->
<tr><td style="padding:0 40px;"><hr style="border:none;border-top:1px solid #eeeeee;margin:0;"></td></tr>

<!-- HR Contact -->
<tr><td style="padding:16px 40px 20px;">
    <p style="margin:0;font-size:12px;line-height:1.6;color:#999999;">
        If you have any issues accessing your account, please contact the HR department or email <a href="mailto:hr@tcghrvc.com" style="color:#2580D3;text-decoration:none;">hr@tcghrvc.com</a>
    </p>
</td></tr>

<!-- Director Signature -->
<tr><td style="padding:0 40px;"><hr style="border:none;border-top:1px solid #eeeeee;margin:0;"></td></tr>
<tr><td align="center" style="padding:20px 40px 8px;">
    <img src="https://app.tcghrvc.com/images/director-avatar.png" alt="Shuhei Takahashi" width="48" height="48" style="border-radius:50%;display:block;margin:0 auto;">
</td></tr>
<tr><td align="center" style="padding:4px 40px 4px;">
    <p style="margin:0;font-size:14px;font-weight:600;color:#1a1a1a;">Shuhei Takahashi</p>
</td></tr>
<tr><td align="center" style="padding:0 40px 24px;">
    <p style="margin:0;font-size:12px;color:#999999;">Director, TCG</p>
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

<!-- Footer -->
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
