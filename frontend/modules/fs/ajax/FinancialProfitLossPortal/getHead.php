<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

function calculateDivide($numerator, $denominator)
{
    return $denominator == 0 ? 0 : $numerator / $denominator;
}

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$quarter = mysqli_real_escape_string($connection, $_POST['quarter']);
$startYear = mysqli_real_escape_string($connection, $_POST['year']);
$rate = mysqli_real_escape_string($connection, $_POST['rate']);
$currencyFocus = mysqli_real_escape_string($connection, $_POST['currencyId']);

$list_breakdown = ["Sales", "Variable Expense", "Gross Profit (or Loss)", "Labor Cost", "Fixed Expense (Other)", "Fixed Expense", "Operating Profit (or Loss)", "Non-Operating Income", "Non-Operating Expense", "Ordinary Profit (or Loss)", "Break-Even Sales", "Marginal Profit Ratio"];
$list_breakdown_class = ["sale", "variable_expense", "gross_profit", "labor_cost", "fixed_expense_oth", "fixed_expense", "operating_profit", "non_operating_income", "non_operating_expense", "ordinary_profit", "break_even_sales", "marginal_profit_ratio"];
$list_breakdown_id = [1, 2, null, 3, 4, null, null, 5, 6, null, null, null];
$list_breakdown_data = array();
for ($i = 0; $i < 12; $i++) {
    $list_breakdown_data[] = array(
        "list" => $i,
        "breakdown" => $list_breakdown[$i],
        "breakdown_class" => $list_breakdown_class[$i],
        "data" => array()
    );
}

$list_breakdown_Interest = array();
for ($i = 0; $i < 4; $i++) {
    $list_breakdown_Interest[] = array(
        "list" => $i,
        "data" => array()
    );
}

$sql_select = "SELECT financial_start_month,currency_default FROM branch WHERE branchId = '$branchId' ";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
$row_select = mysqli_fetch_assoc($res_select);
$startMonth = $row_select['financial_start_month'];
$currencyDefaul = $row_select['currency_default'];

$list_time = array();
$list_month = array();

for ($i = 0; $i < 12; $i++) {
    $currentMonth = ($startMonth + $i - 1) % 12 + 1;
    $currentYear = $startYear + floor(($startMonth + $i - 1) / 12);
    $monthName = date('F', mktime(0, 0, 0, $currentMonth, 1));
    $Q = ceil(($i + 1) / 3);

    $list_time[] = array(
        "list" => $i,
        "monthName" => $monthName,
        "month" => $currentMonth,
        "year" => $currentYear,
        "quarter" => $Q
    );
}

if ($quarter != '') {
    $i = 0;
    foreach ($list_time as $key => $time) {
        if ($time['quarter'] == $quarter) {
            $list_month[] = array(
                "list" => $i,
                "monthName" => $time['monthName'],
                "month" => $time['month'],
                "year" => $time['year'],
                "quarter" => $time['quarter']
            );
            $i++;
        }
    }
} else {
    $list_month = $list_time;
}

$accum_last_act = 0.00;
$accum_act = 0.00;
$accum_tar = 0.00;
$accum_next_tar = 0.00;

$list_data = array();

for ($breakdown_id = 1; $breakdown_id <= 8; $breakdown_id++) {

    $list_data[] = array(
        "breakdown_id" => $breakdown_id,
        "data" => array()
    );

    foreach ($list_month as $rowMonth) {
        $monthName = $rowMonth['monthName'];
        $month = $rowMonth['month'];
        $year = $rowMonth['year'];
        $last_year = $year - 1;

        $sql_data = "SELECT 
        (
            SELECT IF(SUM(a.actual_amount), SUM(a.actual_amount), 0)
            FROM tbl_branch_pl_data a 
            LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id 
            WHERE b.branchId = '$branchId' AND b.breakdown_id = '$breakdown_id' AND a.month = '$month' AND a.year = '$last_year' 
        ) AS last_year_actual_amount,
        IF(SUM(a.actual_amount), SUM(a.actual_amount), 0) AS actual_amount,
        IF(SUM(a.target_amount), SUM(a.target_amount), 0) AS target_amount,
        IF(SUM(a.next_target_amount), SUM(a.next_target_amount), 0) AS next_target_amount
        FROM tbl_branch_pl_data a 
        LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id 
        WHERE b.branchId = '$branchId' AND b.breakdown_id = '$breakdown_id' AND a.month = '$month' AND a.year = '$year' ";
        // echo "<pre>";

        $res_data = mysqli_query($connection, $sql_data) or die($connection->error);
        $row_data = mysqli_fetch_assoc($res_data);

        $last_act = ($row_data['last_year_actual_amount'] == "" ? 0 : $row_data['last_year_actual_amount']);
        $accum_last_act += $last_act;

        $actual_amount = ($row_data['actual_amount'] == "" ? 0 : $row_data['actual_amount']);
        $target_amount = ($row_data['target_amount'] == "" ? 0 : $row_data['target_amount']);
        $next_target_amount = ($row_data['next_target_amount'] == "" ? 0 : $row_data['next_target_amount']);

        $accum_act += $actual_amount;
        $accum_tar += $target_amount;
        $accum_next_tar += $next_target_amount;


        $list_data[count($list_data) - 1]['data'][] = array(
            "list" => $rowMonth['list'],
            "breakdown_id" => $breakdown_id,
            "monthName" => $monthName,
            "month" => $month,
            "year" => $year,
            "last_actual_amount" => $last_act,
            "actual_amount" => $actual_amount,
            "target_amount" => $target_amount,
            "next_target_amount" => $next_target_amount,
            "accum_last_act" => $accum_last_act,
            "accum_act" => $accum_act,
            "accum_tar" => $accum_tar,
            "accum_next_tar" => $accum_next_tar
        );
    }

    $accum_last_act = 0.00;
    $accum_act = 0.00;
    $accum_tar = 0.00;
    $accum_next_tar = 0.00;
}

foreach ($list_data as $data) {

    if ($data['breakdown_id'] == 1) {
        $list_breakdown_data[0]['data'] = $data['data'];
    } else if ($data['breakdown_id'] == 2) {
        $list_breakdown_data[1]['data'] = $data['data'];
    } else if ($data['breakdown_id'] == 3) {
        $list_breakdown_data[3]['data'] = $data['data'];
    } else if ($data['breakdown_id'] == 4) {
        $list_breakdown_data[4]['data'] = $data['data'];
    } elseif ($data['breakdown_id'] == 5) {
        $list_breakdown_Interest[0]['data'] = $data['data'];
    } else if ($data['breakdown_id'] == 6) {
        $list_breakdown_Interest[1]['data'] = $data['data'];
    } elseif ($data['breakdown_id'] == 7) {
        $list_breakdown_Interest[2]['data'] = $data['data'];
    } else if ($data['breakdown_id'] == 8) {
        $list_breakdown_Interest[3]['data'] = $data['data'];
    }
}

for ($i = 0; $i <= count($list_month) - 1; $i++) {
    $last_act = floatval($list_breakdown_data[0]['data'][$i]['last_actual_amount']) - floatval($list_breakdown_data[1]['data'][$i]['last_actual_amount']);
    $actual_amount = floatval($list_breakdown_data[0]['data'][$i]['actual_amount']) - floatval($list_breakdown_data[1]['data'][$i]['actual_amount']);
    $target_amount = floatval($list_breakdown_data[0]['data'][$i]['target_amount']) - floatval($list_breakdown_data[1]['data'][$i]['target_amount']);
    $next_target_amount = floatval($list_breakdown_data[0]['data'][$i]['next_target_amount']) - floatval($list_breakdown_data[1]['data'][$i]['next_target_amount']);
    $accum_last_act = floatval($list_breakdown_data[0]['data'][$i]['accum_last_act']) - floatval($list_breakdown_data[1]['data'][$i]['accum_last_act']);
    $accum_act = floatval($list_breakdown_data[0]['data'][$i]['accum_act']) - floatval($list_breakdown_data[1]['data'][$i]['accum_act']);
    $accum_tar = floatval($list_breakdown_data[0]['data'][$i]['accum_tar']) - floatval($list_breakdown_data[1]['data'][$i]['accum_tar']);
    $accum_next_tar = floatval($list_breakdown_data[0]['data'][$i]['accum_next_tar']) - floatval($list_breakdown_data[1]['data'][$i]['accum_next_tar']);

    $list_breakdown_data[2]['data'][] = array(
        "list" => $list_breakdown_data[0]['data'][$i]['list'],
        "monthName" => $list_breakdown_data[0]['data'][$i]['monthName'],
        "month" => $list_breakdown_data[0]['data'][$i]['month'],
        "year" => $list_breakdown_data[0]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );

    $last_act = floatval($list_breakdown_data[3]['data'][$i]['last_actual_amount']) + floatval($list_breakdown_data[4]['data'][$i]['last_actual_amount']);
    $actual_amount = floatval($list_breakdown_data[3]['data'][$i]['actual_amount']) + floatval($list_breakdown_data[4]['data'][$i]['actual_amount']);
    $target_amount = floatval($list_breakdown_data[3]['data'][$i]['target_amount']) + floatval($list_breakdown_data[4]['data'][$i]['target_amount']);
    $next_target_amount = floatval($list_breakdown_data[3]['data'][$i]['next_target_amount']) + floatval($list_breakdown_data[4]['data'][$i]['next_target_amount']);
    $accum_last_act = floatval($list_breakdown_data[3]['data'][$i]['accum_last_act']) + floatval($list_breakdown_data[4]['data'][$i]['accum_last_act']);
    $accum_act = floatval($list_breakdown_data[3]['data'][$i]['accum_act']) + floatval($list_breakdown_data[4]['data'][$i]['accum_act']);
    $accum_tar = floatval($list_breakdown_data[3]['data'][$i]['accum_tar']) + floatval($list_breakdown_data[4]['data'][$i]['accum_tar']);
    $accum_next_tar = floatval($list_breakdown_data[3]['data'][$i]['accum_next_tar']) + floatval($list_breakdown_data[4]['data'][$i]['accum_next_tar']);

    $list_breakdown_data[5]['data'][] = array(
        "list" => $list_breakdown_data[3]['data'][$i]['list'],
        "monthName" => $list_breakdown_data[3]['data'][$i]['monthName'],
        "month" => $list_breakdown_data[3]['data'][$i]['month'],
        "year" => $list_breakdown_data[3]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );

    //Non-Operating Income + Interest and Devident Income
    $last_act = floatval($list_breakdown_Interest[0]['data'][$i]['last_actual_amount']) + floatval($list_breakdown_Interest[2]['data'][$i]['last_actual_amount']);
    $actual_amount = floatval($list_breakdown_Interest[0]['data'][$i]['actual_amount']) + floatval($list_breakdown_Interest[2]['data'][$i]['actual_amount']);
    $target_amount = floatval($list_breakdown_Interest[0]['data'][$i]['target_amount']) + floatval($list_breakdown_Interest[2]['data'][$i]['target_amount']);
    $next_target_amount = floatval($list_breakdown_Interest[0]['data'][$i]['next_target_amount']) + floatval($list_breakdown_Interest[2]['data'][$i]['next_target_amount']);
    $accum_last_act = floatval($list_breakdown_Interest[0]['data'][$i]['accum_last_act']) + floatval($list_breakdown_Interest[2]['data'][$i]['accum_last_act']);
    $accum_act = floatval($list_breakdown_Interest[0]['data'][$i]['accum_act']) + floatval($list_breakdown_Interest[2]['data'][$i]['accum_act']);
    $accum_tar = floatval($list_breakdown_Interest[0]['data'][$i]['accum_tar']) + floatval($list_breakdown_Interest[2]['data'][$i]['accum_tar']);
    $accum_next_tar = floatval($list_breakdown_Interest[0]['data'][$i]['accum_next_tar']) + floatval($list_breakdown_Interest[2]['data'][$i]['accum_next_tar']);

    $list_breakdown_data[7]['data'][] = array(
        "list" => $list_breakdown_Interest[0]['data'][$i]['list'],
        "breakdown_id" => $list_breakdown_Interest[0]['data'][$i]['breakdown_id'],
        "monthName" => $list_breakdown_Interest[0]['data'][$i]['monthName'],
        "month" => $list_breakdown_Interest[0]['data'][$i]['month'],
        "year" => $list_breakdown_Interest[0]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );

    //Non-Operating Expense + Interest Expense
    $last_act = floatval($list_breakdown_Interest[1]['data'][$i]['last_actual_amount']) + floatval($list_breakdown_Interest[3]['data'][$i]['last_actual_amount']);
    $actual_amount = floatval($list_breakdown_Interest[1]['data'][$i]['actual_amount']) + floatval($list_breakdown_Interest[3]['data'][$i]['actual_amount']);
    $target_amount = floatval($list_breakdown_Interest[1]['data'][$i]['target_amount']) + floatval($list_breakdown_Interest[3]['data'][$i]['target_amount']);
    $next_target_amount = floatval($list_breakdown_Interest[1]['data'][$i]['next_target_amount']) + floatval($list_breakdown_Interest[3]['data'][$i]['next_target_amount']);
    $accum_last_act = floatval($list_breakdown_Interest[1]['data'][$i]['accum_last_act']) + floatval($list_breakdown_Interest[3]['data'][$i]['accum_last_act']);
    $accum_act = floatval($list_breakdown_Interest[1]['data'][$i]['accum_act']) + floatval($list_breakdown_Interest[3]['data'][$i]['accum_act']);
    $accum_tar = floatval($list_breakdown_Interest[1]['data'][$i]['accum_tar']) + floatval($list_breakdown_Interest[3]['data'][$i]['accum_tar']);
    $accum_next_tar = floatval($list_breakdown_Interest[1]['data'][$i]['accum_next_tar']) + floatval($list_breakdown_Interest[3]['data'][$i]['accum_next_tar']);

    $list_breakdown_data[8]['data'][] = array(
        "list" => $list_breakdown_Interest[1]['data'][$i]['list'],
        "breakdown_id" => $list_breakdown_Interest[1]['data'][$i]['breakdown_id'],
        "monthName" => $list_breakdown_Interest[1]['data'][$i]['monthName'],
        "month" => $list_breakdown_Interest[1]['data'][$i]['month'],
        "year" => $list_breakdown_Interest[1]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );
}

for ($i = 0; $i <= count($list_month) - 1; $i++) {
    $last_act = floatval($list_breakdown_data[2]['data'][$i]['last_actual_amount']) - floatval($list_breakdown_data[5]['data'][$i]['last_actual_amount']);
    $actual_amount = floatval($list_breakdown_data[2]['data'][$i]['actual_amount']) - floatval($list_breakdown_data[5]['data'][$i]['actual_amount']);
    $target_amount = floatval($list_breakdown_data[2]['data'][$i]['target_amount']) - floatval($list_breakdown_data[5]['data'][$i]['target_amount']);
    $next_target_amount = floatval($list_breakdown_data[2]['data'][$i]['next_target_amount']) - floatval($list_breakdown_data[5]['data'][$i]['next_target_amount']);
    $accum_last_act = floatval($list_breakdown_data[2]['data'][$i]['accum_last_act']) - floatval($list_breakdown_data[5]['data'][$i]['accum_last_act']);
    $accum_act = floatval($list_breakdown_data[2]['data'][$i]['accum_act']) - floatval($list_breakdown_data[5]['data'][$i]['accum_act']);
    $accum_tar = floatval($list_breakdown_data[2]['data'][$i]['accum_tar']) - floatval($list_breakdown_data[5]['data'][$i]['accum_tar']);
    $accum_next_tar = floatval($list_breakdown_data[2]['data'][$i]['accum_next_tar']) - floatval($list_breakdown_data[5]['data'][$i]['accum_next_tar']);

    $list_breakdown_data[6]['data'][] = array(
        "list" => $list_breakdown_data[2]['data'][$i]['list'],
        "monthName" => $list_breakdown_data[2]['data'][$i]['monthName'],
        "month" => $list_breakdown_data[2]['data'][$i]['month'],
        "year" => $list_breakdown_data[2]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );
}

for ($i = 0; $i <= count($list_month) - 1; $i++) {

    $last_act = (floatval($list_breakdown_data[6]['data'][$i]['last_actual_amount']) + floatval($list_breakdown_data[7]['data'][$i]['last_actual_amount'])) - floatval($list_breakdown_data[8]['data'][$i]['last_actual_amount']);
    $actual_amount = (floatval($list_breakdown_data[6]['data'][$i]['actual_amount']) + floatval($list_breakdown_data[7]['data'][$i]['actual_amount'])) - floatval($list_breakdown_data[8]['data'][$i]['actual_amount']);
    $target_amount = (floatval($list_breakdown_data[6]['data'][$i]['target_amount']) + floatval($list_breakdown_data[7]['data'][$i]['target_amount'])) - floatval($list_breakdown_data[8]['data'][$i]['target_amount']);
    $next_target_amount = (floatval($list_breakdown_data[6]['data'][$i]['next_target_amount']) + floatval($list_breakdown_data[7]['data'][$i]['next_target_amount'])) - floatval($list_breakdown_data[8]['data'][$i]['next_target_amount']);
    $accum_last_act = (floatval($list_breakdown_data[6]['data'][$i]['accum_last_act']) + floatval($list_breakdown_data[7]['data'][$i]['accum_last_act'])) - floatval($list_breakdown_data[8]['data'][$i]['accum_last_act']);
    $accum_act = (floatval($list_breakdown_data[6]['data'][$i]['accum_act']) + floatval($list_breakdown_data[7]['data'][$i]['accum_act'])) - floatval($list_breakdown_data[8]['data'][$i]['accum_act']);
    $accum_tar = (floatval($list_breakdown_data[6]['data'][$i]['accum_tar']) + floatval($list_breakdown_data[7]['data'][$i]['accum_tar'])) - floatval($list_breakdown_data[8]['data'][$i]['accum_tar']);
    $accum_next_tar = (floatval($list_breakdown_data[6]['data'][$i]['accum_next_tar']) + floatval($list_breakdown_data[7]['data'][$i]['accum_next_tar'])) - floatval($list_breakdown_data[8]['data'][$i]['accum_next_tar']);

    $list_breakdown_data[9]['data'][] = array(
        "list" => $list_breakdown_data[6]['data'][$i]['list'],
        "monthName" => $list_breakdown_data[6]['data'][$i]['monthName'],
        "month" => $list_breakdown_data[6]['data'][$i]['month'],
        "year" => $list_breakdown_data[6]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );
}

for ($i = 0; $i <= count($list_month) - 1; $i++) {
    $last_act = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['last_actual_amount']), floatval($list_breakdown_data[0]['data'][$i]['last_actual_amount'])) * 100;
    $actual_amount = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['actual_amount']), floatval($list_breakdown_data[0]['data'][$i]['actual_amount'])) * 100;
    $target_amount = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['target_amount']), floatval($list_breakdown_data[0]['data'][$i]['target_amount'])) * 100;
    $next_target_amount = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['next_target_amount']), floatval($list_breakdown_data[0]['data'][$i]['next_target_amount'])) * 100;
    $accum_last_act = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_last_act']), floatval($list_breakdown_data[0]['data'][$i]['accum_last_act'])) * 100;
    $accum_act = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_act']), floatval($list_breakdown_data[0]['data'][$i]['accum_act'])) * 100;
    $accum_tar = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_tar']), floatval($list_breakdown_data[0]['data'][$i]['accum_tar'])) * 100;
    $accum_next_tar = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][$i]['accum_next_tar'])) * 100;

    $list_breakdown_data[11]['data'][] = array(
        "list" => $list_breakdown_data[2]['data'][$i]['list'],
        "monthName" => $list_breakdown_data[2]['data'][$i]['monthName'],
        "month" => $list_breakdown_data[2]['data'][$i]['month'],
        "year" => $list_breakdown_data[2]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );
}

for ($i = 0; $i <= count($list_month) - 1; $i++) {
    $last_act = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['last_actual_amount']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['last_actual_amount']), floatval($list_breakdown_data[0]['data'][$i]['last_actual_amount']))));
    $actual_amount = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['actual_amount']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['actual_amount']), floatval($list_breakdown_data[0]['data'][$i]['actual_amount']))));
    $target_amount = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['target_amount']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['target_amount']), floatval($list_breakdown_data[0]['data'][$i]['target_amount']))));
    $next_target_amount = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['next_target_amount']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['next_target_amount']), floatval($list_breakdown_data[0]['data'][$i]['next_target_amount']))));
    $accum_last_act = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['accum_last_act']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_last_act']), floatval($list_breakdown_data[0]['data'][$i]['accum_last_act']))));
    $accum_act = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['accum_act']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_act']), floatval($list_breakdown_data[0]['data'][$i]['accum_act']))));
    $accum_tar = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['accum_tar']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_tar']), floatval($list_breakdown_data[0]['data'][$i]['accum_tar']))));
    $accum_next_tar = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['accum_next_tar']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][$i]['accum_next_tar']))));

    $list_breakdown_data[10]['data'][] = array(
        "list" => $list_breakdown_data[5]['data'][$i]['list'],
        "monthName" => $list_breakdown_data[5]['data'][$i]['monthName'],
        "month" => $list_breakdown_data[5]['data'][$i]['month'],
        "year" => $list_breakdown_data[5]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );
}


///head
$listHead = array();
for ($i = 0; $i < 12; $i++) {
    $listHead[] = array(
        "list" => $i,
        "breakdown" => $list_breakdown[$i],
        "breakdown_class" => $list_breakdown_class[$i],
        "list_breakdown_id" => $list_breakdown_id[$i],
        "data" => array()
    );
}

$listHead[0]['data'][] = array(
    "breakdown_id" => $list_breakdown_data[0]['data'][count($list_month) - 1]['breakdown_id'],
    "last_actual_amount" => $list_breakdown_data[0]['data'][count($list_month) - 1]['last_actual_amount'],
    "actual_amount" => $list_breakdown_data[0]['data'][count($list_month) - 1]['actual_amount'],
    "target_amount" => $list_breakdown_data[0]['data'][count($list_month) - 1]['target_amount'],
    "next_target_amount" => $list_breakdown_data[0]['data'][count($list_month) - 1]['next_target_amount'],
    "accum_last_act" => $list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act'],
    "accum_act" => $list_breakdown_data[0]['data'][count($list_month) - 1]['accum_act'],
    "accum_tar" => $list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar'],
    "accum_next_tar" => $list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar'],
    "percent_accum_last_act" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']))) * 100,
    "percent_accum_act" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
    "percent_accum_tar" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
    "percent_accum_next_tar" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']))) * 100
);

for ($i = 1; $i < 11; $i++) {
    $listHead[$i]['data'][] = array(
        "breakdown_id" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['breakdown_id'],
        "last_actual_amount" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['last_actual_amount'],
        "actual_amount" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['actual_amount'],
        "target_amount" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['target_amount'],
        "next_target_amount" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['next_target_amount'],
        "accum_last_act" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_last_act'],
        "accum_act" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_act'],
        "accum_tar" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_tar'],
        "accum_next_tar" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_next_tar'],
        "percent_accum_last_act" => (calculateDivide(floatval($list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_last_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']))) * 100,
        "percent_accum_act" => (calculateDivide(floatval($list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
        "percent_accum_tar" => (calculateDivide(floatval($list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
        "percent_accum_next_tar" => (calculateDivide(floatval($list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']))) * 100
    );
}

$listHead[11]['data'][] = array(
    "breakdown_id" => $list_breakdown_data[11]['data'][count($list_month) - 1]['breakdown_id'],
    "last_actual_amount" => $list_breakdown_data[11]['data'][count($list_month) - 1]['last_actual_amount'],
    "actual_amount" => $list_breakdown_data[11]['data'][count($list_month) - 1]['actual_amount'],
    "target_amount" => $list_breakdown_data[11]['data'][count($list_month) - 1]['target_amount'],
    "next_target_amount" => $list_breakdown_data[11]['data'][count($list_month) - 1]['next_target_amount'],
    "percent_accum_last_act" => $list_breakdown_data[11]['data'][count($list_month) - 1]['accum_last_act'],
    "percent_accum_act" => $list_breakdown_data[11]['data'][count($list_month) - 1]['accum_act'],
    "percent_accum_tar" => $list_breakdown_data[11]['data'][count($list_month) - 1]['accum_tar'],
    "percent_accum_next_tar" => $list_breakdown_data[11]['data'][count($list_month) - 1]['accum_next_tar'],
    // "percent_accum_last_act" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']))) * 100,
    // "percent_accum_act" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
    // "percent_accum_tar" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
    // "percent_accum_next_tar" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']))) * 100
);

foreach ($listHead as $key => $listHead) {
    if ($listHead['list_breakdown_id'] != '') {
        $link = 'onclick="window.location.href=\'FinancialProfitLossPortalEdit?id=' . $branchId . '&&startYear=' . $_POST['year'] . '&&quarter=' . $_POST['quarter'] . '&&rate=' . $_POST['rate'] . '&&currencyId=' . $_POST['currencyId'] . '&&breakdown=' . $listHead['list_breakdown_id'] . '\'" style="cursor: pointer;"';
    } else {
        $link = '';
    }

?>
    <tr class="row-ratio <?php echo $listHead['breakdown_class']; ?>">
        <td><span class="px-2" <?php echo $link; ?>><?php echo $listHead['breakdown']; ?></span></td>
        <td class="text-center"><span>
                <div class="donut-chart donut-red" data-percent="<?php echo $listHead['data'][0]['percent_accum_last_act']; ?>"></div>
            </span></td>
        <td class="text-center"><span>
                <div class="donut-chart donut-green" data-percent="<?php echo $listHead['data'][0]['percent_accum_act']; ?>"></div>
            </span></td>
        <td class="text-center"><span>
                <div class="donut-chart donut-yellow" data-percent="<?php echo $listHead['data'][0]['percent_accum_tar']; ?>"></div>
            </span></td>
        <td class="text-center"><span>
                <div class="donut-chart donut-blue" data-percent="<?php echo $listHead['data'][0]['percent_accum_next_tar']; ?>"></div>
            </span></td>
    </tr>

<?php
}
?>