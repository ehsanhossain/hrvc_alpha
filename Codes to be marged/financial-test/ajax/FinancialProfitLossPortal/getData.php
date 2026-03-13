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



// ///head
// $listHead = array();
// for ($i = 0; $i < 12; $i++) {
//     $listHead[] = array(
//         "list" => $i,
//         "breakdown" => $list_breakdown[$i],
//         "data" => array()
//     );
// }

// $listHead[0]['data'][] = array(
//     "breakdown_id" => $list_breakdown_data[0]['data'][count($list_month) - 1]['breakdown_id'],
//     "last_actual_amount" => $list_breakdown_data[0]['data'][count($list_month) - 1]['last_actual_amount'],
//     "actual_amount" => $list_breakdown_data[0]['data'][count($list_month) - 1]['actual_amount'],
//     "target_amount" => $list_breakdown_data[0]['data'][count($list_month) - 1]['target_amount'],
//     "next_target_amount" => $list_breakdown_data[0]['data'][count($list_month) - 1]['next_target_amount'],
//     "accum_last_act" => $list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act'],
//     "accum_act" => $list_breakdown_data[0]['data'][count($list_month) - 1]['accum_act'],
//     "accum_tar" => $list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar'],
//     "accum_next_tar" => $list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar'],
//     // "percent_accum_last_act" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']))) * 100,
//     // "percent_accum_act" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
//     // "percent_accum_tar" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
//     // "percent_accum_next_tar" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']))) * 100
// );

// for ($i = 1; $i < 11; $i++) {
//     $listHead[$i]['data'][] = array(
//         "breakdown_id" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['breakdown_id'],
//         "last_actual_amount" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['last_actual_amount'],
//         "actual_amount" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['actual_amount'],
//         "target_amount" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['target_amount'],
//         "next_target_amount" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['next_target_amount'],
//         "accum_last_act" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_last_act'],
//         "accum_act" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_act'],
//         "accum_tar" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_tar'],
//         "accum_next_tar" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_next_tar'],
//         // "percent_accum_last_act" => (calculateDivide(floatval($list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_last_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']))) * 100,
//         // "percent_accum_act" => (calculateDivide(floatval($list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
//         // "percent_accum_tar" => (calculateDivide(floatval($list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
//         // "percent_accum_next_tar" => (calculateDivide(floatval($list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']))) * 100
//     );
// }

// $listHead[11]['data'][] = array(
//     "breakdown_id" => $list_breakdown_data[11]['data'][count($list_month) - 1]['breakdown_id'],
//     "last_actual_amount" => $list_breakdown_data[11]['data'][count($list_month) - 1]['last_actual_amount'],
//     "actual_amount" => $list_breakdown_data[11]['data'][count($list_month) - 1]['actual_amount'],
//     "target_amount" => $list_breakdown_data[11]['data'][count($list_month) - 1]['target_amount'],
//     "next_target_amount" => $list_breakdown_data[11]['data'][count($list_month) - 1]['next_target_amount'],
//     // "percent_accum_last_act" => $list_breakdown_data[11]['data'][count($list_month) - 1]['accum_last_act'],
//     // "percent_accum_act" => $list_breakdown_data[11]['data'][count($list_month) - 1]['accum_act'],
//     // "percent_accum_tar" => $list_breakdown_data[11]['data'][count($list_month) - 1]['accum_tar'],
//     // "percent_accum_next_tar" => $list_breakdown_data[11]['data'][count($list_month) - 1]['accum_next_tar'],
//     // "percent_accum_last_act" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']))) * 100,
//     // "percent_accum_act" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
//     // "percent_accum_tar" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
//     // "percent_accum_next_tar" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']))) * 100
// );

?>

<div class="d-flex scroll-none" style="width:1800px">
    <?php foreach ($list_month as $key => $list_month) { ?>
        <table class="table-item item-data me-1 table-data-pl ">
            <thead>
                <tr class="row-title-1">
                    <th class="px-1 fs-15">
                        <span class="pointer ex-collapse">

                            <?php echo $list_month['monthName']; ?>

                            <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="12" height="14" rx="2" fill="#2580D3" />
                                <path d="M9.29561 8.03108L5.34571 12.2798C5.0727 12.5734 4.63124 12.5734 4.36114 12.2798L3.70476 11.5737C3.43175 11.2801 3.43175 10.8052 3.70476 10.5147L6.50454 7.50312L3.70476 4.49156C3.43175 4.19791 3.43175 3.72306 3.70476 3.43252L4.35823 2.72024C4.63124 2.42659 5.0727 2.42659 5.3428 2.72024L9.2927 6.96892C9.56861 7.26257 9.56861 7.73743 9.29561 8.03108Z" fill="white" />
                            </svg>

                        </span>
                    </th>
                    <th class="text-end btn-collapse" colspan="3" style="cursor: pointer;">
                        <a class="row-collapse"><i class="bi bi-arrow-bar-left"></i> Collapse</a>
                    </th>
                </tr>
                <tr class="row-title-1">
                    <th class="px-1 data-pl content-pl show" style="min-width:68px">
                        <div class="label-title label-red">PL</div>
                        <?php echo $list_month['year'] - 1; ?>
                    </th>
                    <th class="px-1 data-pl content-cp" style="min-width:68px">
                        <div class="label-title label-green">CP</div>
                        <?php echo $list_month['year']; ?>
                    </th>
                    <th class="px-1 data-pl content-ct" style="min-width:68px">
                        <div class="label-title label-yellow">CT</div>
                        <?php echo $list_month['year']; ?>
                    </th>
                    <th class="px-1 data-pl content-nt" style="min-width:68px">
                        <div class="label-title label-blue">NT</div>
                        <?php echo $list_month['year'] + 1; ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < 12; $i++) : ?>
                    <tr class="upper m-<?php echo $i; ?> <?php echo $list_breakdown_data[$i]['breakdown_class']; ?>">
                        <td class="data-pl content-pl show"><?php echo formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['last_actual_amount'])); ?></td>
                        <td class="data-pl content-cp"><?php echo formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['actual_amount'])); ?></td>
                        <td class="data-pl content-ct"><?php echo formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['target_amount'])); ?></td>
                        <td class="data-pl content-nt"><?php echo formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['next_target_amount'])); ?></td>
                    </tr>
                    <tr class="lower a-<?php echo $i; ?> <?php echo $list_breakdown_data[$i]['breakdown_class']; ?>">
                        <td class="data-pl content-pl show"><?php echo formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['accum_last_act'])); ?></td>
                        <td class="data-pl content-cp"><?php echo formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['accum_act'])); ?></td>
                        <td class="data-pl content-ct"><?php echo formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['accum_tar'])); ?></td>
                        <td class="data-pl content-nt"><?php echo formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['accum_next_tar'])); ?></td>
                    </tr>
                    <!-- <tr class="upper m-<?php echo $i; ?> <?php echo $list_breakdown_data[$i]['breakdown_class']; ?>">
                        <td class="data-pl content-pl show"><?php echo $currencyDefaul; ?></td>
                        <td class="data-pl content-cp"><?php echo $currencyFocus; ?></td>
                        <td class="data-pl content-ct"><?php echo $list_breakdown_data[$i]['data'][$key]['target_amount']; ?></td>
                        <td class="data-pl content-nt"><?php echo ''; ?></td>
                    </tr>
                    <tr class="lower a-<?php echo $i; ?> <?php echo $list_breakdown_data[$i]['breakdown_class']; ?>">
                        <td class="data-pl content-pl show"><?php echo formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['accum_last_act'])); ?></td>
                        <td class="data-pl content-cp"><?php echo formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['accum_act'])); ?></td>
                        <td class="data-pl content-ct"><?php echo formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['accum_tar'])); ?></td>
                        <td class="data-pl content-nt"><?php echo formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['accum_next_tar'])); ?></td>
                    </tr> -->
                <?php endfor; ?>
            </tbody>
        </table>
    <?php } ?>
</div>