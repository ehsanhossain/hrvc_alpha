<?php
/**
 * Shim importMenu.php for Yii2 integration.
 * The sidebar menu is provided by Yii2's menu_left.php partial.
 * This file just sets up the variables that FS page scripts expect.
 */

$branchId = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $branchId = $_GET['id'];
} else {
    $branchId = $_SESSION['firstBranchId'] ?? '';
}

// Setup URL variables used by footer.php JavaScript
$url = Yii::$app->request->baseUrl . '/';
$urlimg = $url;
?>
