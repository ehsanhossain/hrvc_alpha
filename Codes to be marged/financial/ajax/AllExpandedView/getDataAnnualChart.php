<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

function calculateDivide($numerator, $denominator)
{
    return $denominator == 0 ? 0 : $numerator / $denominator;
}

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$current_year = mysqli_real_escape_string($connection, $_POST['year']);
$rate = mysqli_real_escape_string($connection, $_POST['rate']);
$currencyFocus = mysqli_real_escape_string($connection, $_POST['currencyId']);

$sql_currencyFocus = "SELECT currencySymbol FROM tbl_currency WHERE currencyId = '$currencyFocus' ";
$res_currencyFocus = mysqli_query($connection, $sql_currencyFocus) or die($connection->error);
$row_currencyFocus = mysqli_fetch_assoc($res_currencyFocus);
$currencySymbol = $row_currencyFocus['currencySymbol'];
$arrayData['currencySymbol'] = $currencySymbol;

$previous_year = $current_year - 1;

$array_data = array();

// for ($i = 0; $i < 8; $i++) {
//     $array_data[] = array(
//         "list" => $i,
//         "data" => array($categories[$i]),
//         "data_budget" => array($budgets[$i]),
//     );
// }

$sql_select = "SELECT financial_start_month,currency_default FROM branch WHERE branchId = '$branchId' ";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
$row_select = mysqli_fetch_assoc($res_select);
$startMonth = $row_select['financial_start_month'];
$currencyDefaul = $row_select['currency_default'];

$list_time = array();
$list_month = array();

$startYear = $previous_year;

for ($j = 0; $j < 3; $j++) {
    for ($i = 0; $i < 12; $i++) {
        $currentMonth = ($startMonth + $i - 1) % 12 + 1;
        $currentYear = $startYear + floor(($startMonth + $i - 1) / 12);
        $monthName = date('M', mktime(0, 0, 0, $currentMonth, 1));

        $formattedDate = sprintf("%s%d", substr($monthName, 0, 3), substr($currentYear, -2));

        // $array_data[0]['data'][] = $formattedDate;

        $list_time[] = array(
            "list" => $i,
            "monthName" => $monthName,
            "month" => $currentMonth,
            "year" => $currentYear,
            "format" => date('My', strtotime($currentYear . '/' . $currentMonth . '/01')),
        );
    }

    $startYear++;
}

$list_month = $list_time;

$breakdownId = 1;

for ($list = 0; $list < 8; $list++) {
    $count = 0;
    foreach ($list_month as $rowMonth) {
        $format = $rowMonth['format'];
        $monthName = $rowMonth['monthName'];
        $month = $rowMonth['month'];
        $year = $rowMonth['year'];

        $sql_data = "SELECT 
        SUM(a.actual_amount) AS actual_amount,
        SUM(a.target_amount) AS target_amount
        FROM tbl_branch_pl_data a 
        LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id 
        WHERE b.branchId = '$branchId' AND b.breakdown_id = '$breakdownId' AND a.month = '$month' AND a.year = '$year' 
        ORDER BY a.month ASC,a.year ASC";

        $res_data = mysqli_query($connection, $sql_data) or die($connection->error);
        $row_data = mysqli_fetch_assoc($res_data);

        $actual_amount = ($row_data['actual_amount'] == "" ? 0 : $row_data['actual_amount']);
        $target_amount = ($row_data['target_amount'] == "" ? 0 : $row_data['target_amount']);
        $actual_amount = round(changeCurrencyValue($currencyDefaul, $currencyFocus, $actual_amount) / $rate, 2);
        $target_amount = round(changeCurrencyValue($currencyDefaul, $currencyFocus, $target_amount) / $rate, 2);

        $arrayData[$list]['data'][$count] = ['x' => $format, 'y' => $actual_amount];
        $arrayData[$list]['budget'][$count] = ['x' => $format, 'y' => $target_amount];

        $count++;
        if ($count == 36) {
            $count = 0;
        }
    }
    $breakdownId++;
}

echo json_encode($arrayData);
