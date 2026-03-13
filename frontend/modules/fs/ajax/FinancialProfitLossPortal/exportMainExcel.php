<?php
include('../../../config/main_function.php');
require '../../../vendor/autoload.php';
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

function calculateDivide($numerator, $denominator)
{
    return $denominator == 0 ? 0 : $numerator / $denominator;
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

// Common Border Style (เฉพาะแบบมีกรอบ)
$borderStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'],
        ],
    ],
];

// สไตล์แบบไม่มีกรอบ (No Border)
$noBorderStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_NONE,
        ],
    ],
];

// Header Styles (With Border) ---------------------------------------------------------------------------
$styleHeaderLeft = array_merge($borderStyle, [
    'font' => ['bold' => true, 'size' => 10, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'ADD8E6']],
]);

$styleHeaderCenter = array_merge($borderStyle, [
    'font' => ['bold' => true, 'size' => 10, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'ADD8E6']],
]);

$styleHeaderRight = array_merge($borderStyle, [
    'font' => ['bold' => true, 'size' => 10, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'ADD8E6']],
]);

// Text Styles (With Border)
$styleTextLeft = array_merge($borderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleTextCenter = array_merge($borderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleTextRight = array_merge($borderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleTextGrayRight = array_merge($borderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
    'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9D9D9']],
]);

// Color Text Styles (With Border)
$styleTextGreen = array_merge($borderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial', 'color' => ['rgb' => '21BA21']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleTextRed = array_merge($borderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial', 'color' => ['rgb' => 'FF0000']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleTextBlue = array_merge($borderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial', 'color' => ['rgb' => '0000FF']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

// Header Styles (With No Border) -----------------------------------------------------------------------

$styleNoHeaderLeft = array_merge($noBorderStyle, [
    'font' => ['bold' => true, 'size' => 10, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleNoHeaderCenter = array_merge($noBorderStyle, [
    'font' => ['bold' => true, 'size' => 10, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleNoHeaderRight = array_merge($noBorderStyle, [
    'font' => ['bold' => true, 'size' => 10, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleNoBorderTextLeft = array_merge($noBorderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleNoBorderTextCenter = array_merge($noBorderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleNoBorderTextRight = array_merge($noBorderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleNoBorderTextGreen = array_merge($noBorderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial', 'color' => ['rgb' => '21BA21']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleNoBorderTextRed = array_merge($noBorderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial', 'color' => ['rgb' => 'FF0000']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleNoBorderTextBlue = array_merge($noBorderStyle, [
    'font' => ['size' => 9, 'name' => 'Arial', 'color' => ['rgb' => '0000FF']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

// Create a new spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$quarter = mysqli_real_escape_string($connection, $_POST['quarter']);
$startYear = intval(mysqli_real_escape_string($connection, $_POST['year']));
$rate = mysqli_real_escape_string($connection, $_POST['rate']);
$currencyFocus = mysqli_real_escape_string($connection, $_POST['currencyId']);

$sql_currency = "SELECT * FROM tbl_currency WHERE currencyId = '$currencyFocus';";
$res_currency = mysqli_query($connection, $sql_currency) or die($connection->error);
$row_currency = mysqli_fetch_assoc($res_currency);

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

$sql_select = "SELECT branchName, financial_start_month, currency_default FROM branch WHERE branchId = '$branchId' ";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
$row_select = mysqli_fetch_assoc($res_select);
$startMonth = $row_select['financial_start_month'];
$currencyDefaul = $row_select['currency_default'];
$branchName = $row_select['branchName'];

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

/*------------------------------------------------------------------------------------------------------------------------------*/
// หัวตาราง
$rowCell = 1;

$sheet->setCellValue(Coordinate::stringFromColumnIndex(1) . $rowCell, 'Profit & Loss Report – ' . $branchName . ' Branch');
$sheet->mergeCells(Coordinate::stringFromColumnIndex(1) . $rowCell . ':' . Coordinate::stringFromColumnIndex(9) . $rowCell);
$sheet->getStyle(Coordinate::stringFromColumnIndex(1) . $rowCell . ':' . Coordinate::stringFromColumnIndex(9) . $rowCell)->applyFromArray($styleNoBorderTextCenter);

$rowCell = 2;
$rateName = '';
switch ($rate) {
    case '1':
        $rateName = 'Normal';
        break;
    case '2':
        $rateName = 'Thousands';
        break;
    case '3':
        $rateName = 'Millions';
        break;
    case '4':
        $rateName = 'Billions';
        break;
}

$quarterName = '';
switch ($quarter) {
    case '':
        $quarterName = 'All Quarter';
        break;
    case '1':
        $quarterName = 'First Quarter';
        break;
    case '2':
        $quarterName = 'Second Quarter';
        break;
    case '3':
        $quarterName = 'Third Quarter';
        break;
    case '4':
        $quarterName = 'Fourth Quarter';
        break;
}

$sheet->setCellValue(Coordinate::stringFromColumnIndex(1) . $rowCell, 'Financial Year: ' . $startYear . '     Currency: ' . $row_currency['currencySymbol'] . ' ' . $row_currency['currencyCode'] . '     Round Up: ' . $rateName . '     Quarter: ' . $quarterName);
$sheet->mergeCells(Coordinate::stringFromColumnIndex(1) . $rowCell . ':' . Coordinate::stringFromColumnIndex(9) . $rowCell);
$sheet->getStyle(Coordinate::stringFromColumnIndex(1) . $rowCell . ':' . Coordinate::stringFromColumnIndex(9) . $rowCell)->applyFromArray($styleNoBorderTextCenter);

/*------------------------------------------------------------------------------------------------------------------------------*/
// หัวตารางซ้าย
$rowCell = 4;

$sheet->setCellValue(Coordinate::stringFromColumnIndex(1) . $rowCell, 'PL CONTENTS');
$sheet->mergeCells(Coordinate::stringFromColumnIndex(1) . $rowCell . ':' . Coordinate::stringFromColumnIndex(1) . $rowCell + 1);
$sheet->getStyle(Coordinate::stringFromColumnIndex(1) . $rowCell . ':' . Coordinate::stringFromColumnIndex(1) . $rowCell + 1)->applyFromArray($styleHeaderCenter);
$sheet->getColumnDimension(Coordinate::stringFromColumnIndex(1))->setWidth(35);

$sheet->setCellValue(Coordinate::stringFromColumnIndex(2) . $rowCell, 'LP ' . $startYear - 1);
$sheet->mergeCells(Coordinate::stringFromColumnIndex(2) . $rowCell . ':' . Coordinate::stringFromColumnIndex(2) . $rowCell + 1);
$sheet->getStyle(Coordinate::stringFromColumnIndex(2) . $rowCell . ':' . Coordinate::stringFromColumnIndex(2) . $rowCell + 1)->applyFromArray($styleHeaderCenter);
$sheet->getColumnDimension(Coordinate::stringFromColumnIndex(2))->setWidth(20);

$sheet->setCellValue(Coordinate::stringFromColumnIndex(3) . $rowCell, 'CP ' . $startYear);
$sheet->mergeCells(Coordinate::stringFromColumnIndex(3) . $rowCell . ':' . Coordinate::stringFromColumnIndex(3) . $rowCell + 1);
$sheet->getStyle(Coordinate::stringFromColumnIndex(3) . $rowCell . ':' . Coordinate::stringFromColumnIndex(3) . $rowCell + 1)->applyFromArray($styleHeaderCenter);
$sheet->getColumnDimension(Coordinate::stringFromColumnIndex(3))->setWidth(20);

$sheet->setCellValue(Coordinate::stringFromColumnIndex(4) . $rowCell, 'CT ' . $startYear);
$sheet->mergeCells(Coordinate::stringFromColumnIndex(4) . $rowCell . ':' . Coordinate::stringFromColumnIndex(4) . $rowCell + 1);
$sheet->getStyle(Coordinate::stringFromColumnIndex(4) . $rowCell . ':' . Coordinate::stringFromColumnIndex(4) . $rowCell + 1)->applyFromArray($styleHeaderCenter);
$sheet->getColumnDimension(Coordinate::stringFromColumnIndex(4))->setWidth(20);

$sheet->setCellValue(Coordinate::stringFromColumnIndex(5) . $rowCell, 'NT ' . $startYear + 1);
$sheet->mergeCells(Coordinate::stringFromColumnIndex(5) . $rowCell . ':' . Coordinate::stringFromColumnIndex(5) . $rowCell + 1);
$sheet->getStyle(Coordinate::stringFromColumnIndex(5) . $rowCell . ':' . Coordinate::stringFromColumnIndex(5) . $rowCell + 1)->applyFromArray($styleHeaderCenter);
$sheet->getColumnDimension(Coordinate::stringFromColumnIndex(5))->setWidth(20);

/*------------------------------------------------------------------------------------------------------------------------------*/

// เนื้อหาซ้าย
$rowCell = 6;

foreach ($listHead as $key => $listHead) {
    $sheet->setCellValue(Coordinate::stringFromColumnIndex(1) . $rowCell, $listHead['breakdown']);
    $sheet->mergeCells(Coordinate::stringFromColumnIndex(1) . $rowCell . ':' . Coordinate::stringFromColumnIndex(1) . $rowCell + 1);
    $sheet->getStyle(Coordinate::stringFromColumnIndex(1) . $rowCell . ':' . Coordinate::stringFromColumnIndex(1) . $rowCell + 1)->applyFromArray($styleTextLeft);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex(1))->setWidth(35);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex(2) . $rowCell, number_format($listHead['data'][0]['percent_accum_last_act'], 2) . ' %');
    $sheet->mergeCells(Coordinate::stringFromColumnIndex(2) . $rowCell . ':' . Coordinate::stringFromColumnIndex(2) . $rowCell + 1);
    $sheet->getStyle(Coordinate::stringFromColumnIndex(2) . $rowCell . ':' . Coordinate::stringFromColumnIndex(2) . $rowCell + 1)->applyFromArray($styleTextCenter);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex(2))->setWidth(20);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex(3) . $rowCell, number_format($listHead['data'][0]['percent_accum_act'], 2) . ' %');
    $sheet->mergeCells(Coordinate::stringFromColumnIndex(3) . $rowCell . ':' . Coordinate::stringFromColumnIndex(3) . $rowCell + 1);
    $sheet->getStyle(Coordinate::stringFromColumnIndex(3) . $rowCell . ':' . Coordinate::stringFromColumnIndex(3) . $rowCell + 1)->applyFromArray($styleTextCenter);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex(3))->setWidth(20);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex(4) . $rowCell, number_format($listHead['data'][0]['percent_accum_tar'], 2) . ' %');
    $sheet->mergeCells(Coordinate::stringFromColumnIndex(4) . $rowCell . ':' . Coordinate::stringFromColumnIndex(4) . $rowCell + 1);
    $sheet->getStyle(Coordinate::stringFromColumnIndex(4) . $rowCell . ':' . Coordinate::stringFromColumnIndex(4) . $rowCell + 1)->applyFromArray($styleTextCenter);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex(4))->setWidth(20);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex(5) . $rowCell, number_format($listHead['data'][0]['percent_accum_next_tar'], 2) . ' %');
    $sheet->mergeCells(Coordinate::stringFromColumnIndex(5) . $rowCell . ':' . Coordinate::stringFromColumnIndex(5) . $rowCell + 1);
    $sheet->getStyle(Coordinate::stringFromColumnIndex(5) . $rowCell . ':' . Coordinate::stringFromColumnIndex(5) . $rowCell + 1)->applyFromArray($styleTextCenter);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex(5))->setWidth(20);

    $rowCell += 2;
}


$rowCell = 4;
$columnMonthLP = 6;
$columnMonthCP = 7;
$columnMonthCT = 8;
$columnMonthNT = 9;

foreach ($list_month as $key => $list_month) {

    /*------------------------------------------------------------------------------------------------------------------------------*/

    // หัวตารางขวา

    $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthLP) . $rowCell, $list_month['monthName']);
    $sheet->mergeCells(Coordinate::stringFromColumnIndex($columnMonthLP) . $rowCell . ':' . Coordinate::stringFromColumnIndex($columnMonthNT) . $rowCell);
    $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthLP) . $rowCell . ':' . Coordinate::stringFromColumnIndex($columnMonthNT) . $rowCell)->applyFromArray($styleHeaderCenter);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthLP) . $rowCell + 1, 'LP ' . $list_month['year'] - 1);
    $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthLP) . $rowCell + 1 . ':' . Coordinate::stringFromColumnIndex($columnMonthLP) . $rowCell + 1)->applyFromArray($styleHeaderCenter);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthLP))->setWidth(20);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthCP) . $rowCell + 1, 'CP ' . $list_month['year']);
    $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthCP) . $rowCell + 1 . ':' . Coordinate::stringFromColumnIndex($columnMonthCP) . $rowCell + 1)->applyFromArray($styleHeaderCenter);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthCP))->setWidth(20);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthCT) . $rowCell + 1, 'CT ' . $list_month['year']);
    $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthCT) . $rowCell + 1 . ':' . Coordinate::stringFromColumnIndex($columnMonthCT) . $rowCell + 1)->applyFromArray($styleHeaderCenter);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthCT))->setWidth(20);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthNT) . $rowCell + 1, 'NT ' . $list_month['year'] + 1);
    $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthNT) . $rowCell + 1 . ':' . Coordinate::stringFromColumnIndex($columnMonthNT) . $rowCell + 1)->applyFromArray($styleHeaderCenter);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthNT))->setWidth(20);

    /*------------------------------------------------------------------------------------------------------------------------------*/

    // เนื้อหาขวา

    $rowCell = 6;

    for ($i = 0; $i < 12; $i++) {
        /*------------------------------------------------------------------------------------------------------------------------------*/
        // รายเดือน

        $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthLP) . $rowCell, formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['last_actual_amount'])));
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthLP) . $rowCell . ':' . Coordinate::stringFromColumnIndex($columnMonthLP) . $rowCell)->applyFromArray($styleTextRight);
        $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthLP))->setWidth(20);

        $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthCP) . $rowCell, formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['actual_amount'])));
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthCP) . $rowCell . ':' . Coordinate::stringFromColumnIndex($columnMonthCP) . $rowCell)->applyFromArray($styleTextRight);
        $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthCP))->setWidth(20);

        $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthCT) . $rowCell, formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['target_amount'])));
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthCT) . $rowCell . ':' . Coordinate::stringFromColumnIndex($columnMonthCT) . $rowCell)->applyFromArray($styleTextRight);
        $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthCT))->setWidth(20);

        $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthNT) . $rowCell, formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['next_target_amount'])));
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthNT) . $rowCell . ':' . Coordinate::stringFromColumnIndex($columnMonthNT) . $rowCell)->applyFromArray($styleTextRight);
        $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthNT))->setWidth(20);

        /*------------------------------------------------------------------------------------------------------------------------------*/
        // ยอดรวม

        $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthLP) . $rowCell + 1, formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['accum_last_act'])));
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthLP) . $rowCell + 1 . ':' . Coordinate::stringFromColumnIndex($columnMonthLP) . $rowCell + 1)->applyFromArray($styleTextGrayRight);
        $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthLP))->setWidth(20);

        $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthCP) . $rowCell + 1, formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['accum_act'])));
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthCP) . $rowCell + 1 . ':' . Coordinate::stringFromColumnIndex($columnMonthCP) . $rowCell + 1)->applyFromArray($styleTextGrayRight);
        $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthCP))->setWidth(20);

        $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthCT) . $rowCell + 1, formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['accum_tar'])));
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthCT) . $rowCell + 1 . ':' . Coordinate::stringFromColumnIndex($columnMonthCT) . $rowCell + 1)->applyFromArray($styleTextGrayRight);
        $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthCT))->setWidth(20);

        $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthNT) . $rowCell + 1, formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $list_breakdown_data[$i]['data'][$key]['accum_next_tar'])));
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthNT) . $rowCell + 1 . ':' . Coordinate::stringFromColumnIndex($columnMonthNT) . $rowCell + 1)->applyFromArray($styleTextGrayRight);
        $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthNT))->setWidth(20);

        $rowCell += 2;
    }

    $rowCell = 4;

    $columnMonthLP += 4;
    $columnMonthCP += 4;
    $columnMonthCT += 4;
    $columnMonthNT += 4;
}

$periodCriteriaRaw = $_POST['period_criteria'][0] ?? '';
$periodCriteria = explode(',', $periodCriteriaRaw);

$columnMonthLP = 6;
$columnMonthCP = 7;
$columnMonthCT = 8;
$columnMonthNT = 9;

for ($i = 0; $i < 12; $i++) {
    if (!in_array("1", $periodCriteria)) {
        $sheet->getColumnDimensionByColumn($columnMonthLP)->setVisible(false);
    }
    if (!in_array("2", $periodCriteria)) {
        $sheet->getColumnDimensionByColumn($columnMonthCP)->setVisible(false);
    }
    if (!in_array("3", $periodCriteria)) {
        $sheet->getColumnDimensionByColumn($columnMonthCT)->setVisible(false);
    }
    if (!in_array("4", $periodCriteria)) {
        $sheet->getColumnDimensionByColumn($columnMonthNT)->setVisible(false);
    }

    $columnMonthLP += 4;
    $columnMonthCP += 4;
    $columnMonthCT += 4;
    $columnMonthNT += 4;
}

$rowCell = 6;

$plCategoryRaw = $_POST['pl_category'][0] ?? '';
$plCategory = explode(',', $plCategoryRaw);
$plCategory = array_map('intval', $plCategory);

for ($index = 1; $index <= 13; $index++) {
    if (!in_array($index, $plCategory)) {
        $sheet->getRowDimension($rowCell)->setVisible(false);
        $sheet->getRowDimension($rowCell + 1)->setVisible(false);
    }
    $rowCell += 2;
}

// Prepare file for download
$writer = new Xlsx($spreadsheet);
$file_name = "PL-MAIN-DATA-" . date("d-m-Y") . ".xlsx"; // ใส่นามสกุล .xlsx ด้วย

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $file_name . '"');
$writer->save('php://output');
exit();
