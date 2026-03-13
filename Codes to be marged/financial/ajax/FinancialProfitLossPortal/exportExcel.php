<?php
include('../../../config/main_function.php');
require '../../../vendor/autoload.php';
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = $_POST['branchId'];
$startYear = $_POST['year'];

$sql_select = "SELECT financial_start_month FROM branch WHERE branchId = '$branchId' ";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
$row_select = mysqli_fetch_assoc($res_select);
$financial_start_month = $row_select['financial_start_month'];

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

/*------------------------------------------------------------------------------------------------------------------------------*/

// หัวตาราง
$rowCell = 1;

$sheet->setCellValue('A1', 'ACCOUNT CODE');
$sheet->mergeCells('A1:A2');
$sheet->getStyle('A1:A2')->applyFromArray($styleHeaderCenter);
$sheet->getColumnDimension('A')->setWidth(20);

$sheet->setCellValue('B1', 'ACCOUNT NAME');
$sheet->mergeCells('B1:B2');
$sheet->getStyle('B1:B2')->applyFromArray($styleHeaderCenter);
$sheet->getColumnDimension('B')->setWidth(30);

$startMonth = $financial_start_month;
$columnMonthF = 3;
$columnMonthS = 4;
$columnMonthT = 5;

for ($i = 0; $i < 12; $i++) {
    $currentMonth = ($startMonth + $i - 1) % 12 + 1;
    $currentYear = $startYear + floor(($startMonth + $i - 1) / 12);
    $monthName = date('F', mktime(0, 0, 0, $currentMonth, 1));

    $listData[] = array(
        "month" => $currentMonth,
        "year" => $currentYear,
        "actual_amount" => '',
        "target_amount" => '',
        "next_target_amount" => ''
    );

    $rowCell = 1;
    $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthF) . $rowCell, 'MONTH/YEAR :');
    $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthF) . $rowCell)->applyFromArray($styleHeaderCenter);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthF))->setWidth(20);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthS) . $rowCell, $currentMonth . '/' . $currentYear);
    $sheet->mergeCells(Coordinate::stringFromColumnIndex($columnMonthS) . $rowCell . ':' . Coordinate::stringFromColumnIndex($columnMonthT) . $rowCell);
    $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthS) . $rowCell)->applyFromArray($styleHeaderCenter);

    $rowCell = 2;
    $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthF) . $rowCell, 'Actual');
    $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthF) . $rowCell)->applyFromArray($styleHeaderCenter);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthF))->setWidth(20);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthS) . $rowCell, 'Target');
    $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthS) . $rowCell)->applyFromArray($styleHeaderCenter);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthS))->setWidth(20);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthT) . $rowCell, 'Next Year Target');
    $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthT) . $rowCell)->applyFromArray($styleHeaderCenter);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthT))->setWidth(20);

    $columnMonthF += 3;
    $columnMonthS += 3;
    $columnMonthT += 3;
}

$endMonth = $currentMonth;
$endYear = $currentYear;

// เนื้อหาตาราง
$rowCell = 3;

$sql = "SELECT a.* FROM tbl_branch_pl_account_code a 
        WHERE a.branchId = '$branchId' ORDER BY a.acc_code ASC ";
$rs = mysqli_query($connection, $sql) or die($connection->error);

while ($row = mysqli_fetch_assoc($rs)) {

    $sheet->setCellValue(Coordinate::stringFromColumnIndex(1) . $rowCell, $row['acc_code']);
    $sheet->getStyle(Coordinate::stringFromColumnIndex(1) . $rowCell)->applyFromArray($styleTextLeft);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex(1))->setWidth(20);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex(2) . $rowCell, $row['acc_name']);
    $sheet->getStyle(Coordinate::stringFromColumnIndex(2) . $rowCell)->applyFromArray($styleTextLeft);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex(2))->setWidth(30);

    $account_id = $row['account_id'];
    $columnMonthF = 3;
    $columnMonthS = 4;
    $columnMonthT = 5;

    $sql_detail = "SELECT *
    FROM tbl_branch_pl_data a 
    WHERE a.account_id = '$account_id' AND ((a.month >= '$startMonth' AND a.year = '$startYear') OR (a.month <= '$endMonth' AND a.year = $endYear))
    ORDER BY a.year ASC, a.month ASC";
    $rs_detail = mysqli_query($connection, $sql_detail) or die($connection->error);

    while ($row_detail = mysqli_fetch_assoc($rs_detail)) {
        foreach ($listData as $key => $value) {
            if ($value['month'] == $row_detail['month'] && $value['year'] == $row_detail['year']) {
                $listData[$key]["actual_amount"] = $row_detail['actual_amount'];
                $listData[$key]["target_amount"] = $row_detail['target_amount'];
                $listData[$key]["next_target_amount"] = $row_detail['next_target_amount'];
            }
        }
    }

    foreach ($listData as $row_data) {

        // Actual Amount
        $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthF) . $rowCell, $row_data['actual_amount']);
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthF) . $rowCell)->applyFromArray($styleTextRight);
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthF) . $rowCell)->getNumberFormat()->setFormatCode('#,##0.00');
        $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthF))->setWidth(20);

        // Target Amount
        $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthS) . $rowCell, $row_data['target_amount']);
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthS) . $rowCell)->applyFromArray($styleTextRight);
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthS) . $rowCell)->getNumberFormat()->setFormatCode('#,##0.00');
        $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthS))->setWidth(20);

        // Next Target Amount
        $sheet->setCellValue(Coordinate::stringFromColumnIndex($columnMonthT) . $rowCell, $row_data['next_target_amount']);
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthT) . $rowCell)->applyFromArray($styleTextRight);
        $sheet->getStyle(Coordinate::stringFromColumnIndex($columnMonthT) . $rowCell)->getNumberFormat()->setFormatCode('#,##0.00');
        $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($columnMonthT))->setWidth(20);

        $columnMonthF += 3;
        $columnMonthS += 3;
        $columnMonthT += 3;
    }

    $rowCell++;
}

// Prepare file for download
$writer = new Xlsx($spreadsheet);
$file_name = "PL-DATA-" . date("d-m-Y") . ".xlsx"; // ใส่นามสกุล .xlsx ด้วย

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $file_name . '"');
$writer->save('php://output');
exit();
