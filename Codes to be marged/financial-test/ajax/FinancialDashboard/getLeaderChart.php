<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$currentYear = date('Y');
$currencyMonth = date('m');
$previousMonth = date('m', strtotime('-1 month'));

$companyId = mysqli_real_escape_string($connection, $_POST['companyId']);
$breakdownId = mysqli_real_escape_string($connection, $_POST['breakdownId']);
$currencyFocus = mysqli_real_escape_string($connection, $_POST['currencyId']);

$sql_current_month = "SELECT 
        a.branchId,
        a.branchName,
        a.branchName,
        a.branchImage,
        a.currency_default,
        (
            SELECT SUM(f.actual_amount)
            FROM tbl_branch_pl_account_code e
            LEFT JOIN tbl_branch_pl_data f ON e.account_id = f.account_id
            WHERE e.breakdown_id = '$breakdownId' 
            AND f.month = '$currencyMonth' 
            AND f.year = '$currentYear' 
            AND e.branchId = a.branchId
        ) AS sumCurrentMonth,
        (
            SELECT SUM(f.actual_amount)
            FROM tbl_branch_pl_account_code e
            LEFT JOIN tbl_branch_pl_data f ON e.account_id = f.account_id
            WHERE e.breakdown_id = '$breakdownId' 
            AND f.month = '$previousMonth' 
            AND f.year = '$currentYear' 
            AND e.branchId = a.branchId
        ) AS sumPreviousMonth
    FROM branch a
    WHERE a.companyId = '$companyId' AND a.status = 1 AND a.financial_start_month IS NOT NULL
    ORDER BY sumCurrentMonth DESC LIMIT 8 ;";
$res_current_month = mysqli_query($connection, $sql_current_month);
$row_current_month = mysqli_fetch_all($res_current_month, MYSQLI_ASSOC);

$arrayData = array();

foreach ($row_current_month as $keyCurrencyMonth => $currencyMonth) {

    $branchId = $currencyMonth['branchId'];
    $branchName = $currencyMonth['branchName'];
    $branchImage = $currencyMonth['branchImage'];
    $currencyDefault = $currencyMonth['currency_default'];
    $sumCurrentMonth = $currencyMonth['sumCurrentMonth'];
    $listOrderCurrentMonth = $keyCurrencyMonth;

    $arrayData[] = array(
        "branchName" => $branchName,
        "branchImage" => $branchImage,
        "value" => round($sumCurrentMonth, 2),
    );
}
// "value" => number_format(changeCurrencyValue($currencyDefault, $currencyFocus, $sumCurrentMonth), 2),

echo json_encode($arrayData);
