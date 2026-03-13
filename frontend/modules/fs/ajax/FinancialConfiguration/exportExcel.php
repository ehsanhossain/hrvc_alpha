<?php
include('../../../config/main_function.php');
require '../../../vendor/autoload.php';
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = $_POST['branchId'];
$MajorId = $_POST['MajorId'];
$MediumId = $_POST['MediumId'];
$BreakdownId = $_POST['BreakdownId'];

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

$columnHeaderName = array(
    "Accounting Code",
    "Title (Accounting Name)",
    "Major items of PL",
    "Medium item of PL",
    "Breakdown Category",
);

foreach ($columnHeaderName as $index => $header) {
    $columnCell = Coordinate::stringFromColumnIndex($index + 1);
    $sheet->setCellValue($columnCell . $rowCell, $header);
    $sheet->getStyle($columnCell . $rowCell)->applyFromArray($styleHeaderCenter);
    $sheet->getColumnDimension($columnCell)->setAutoSize(true);
}

// เนื้อหาตาราง
$rowCell = 2;

$conditions = [];

if ($MajorId) {
    $conditions[] = "b.pl_major_id = '$MajorId'";
}
if ($MediumId) {
    $conditions[] = "a.pl_medium_id = '$MediumId'";
}
if ($BreakdownId) {
    $conditions[] = "a.breakdown_id = '$BreakdownId'";
}

$conditions[] = "branchId = '$branchId'";

$where = implode(' AND ', $conditions);

$sql = "SELECT a.*,b.medium_name,c.major_name,e.breakdown_name 
FROM tbl_branch_pl_account_code a 
LEFT JOIN tbl_pl_medium_df b ON a.pl_medium_id = b.pl_medium_id
LEFT JOIN tbl_pl_major_df c ON b.pl_major_id = c.pl_major_id
LEFT JOIN tbl_pl_breakdown_df e ON a.breakdown_id = e.breakdown_id 
WHERE $where ORDER BY a.acc_code ASC";
$rs = mysqli_query($connection, $sql) or die($connection->error);

while ($row = $rs->fetch_assoc()) {
    $sheet->setCellValue(Coordinate::stringFromColumnIndex(1) . $rowCell, $row['acc_code']);
    $sheet->getStyle(Coordinate::stringFromColumnIndex(1) . $rowCell)->applyFromArray($styleTextLeft);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex(1))->setAutoSize(true);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex(2) . $rowCell, $row['acc_name']);
    $sheet->getStyle(Coordinate::stringFromColumnIndex(2) . $rowCell)->applyFromArray($styleTextLeft);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex(2))->setAutoSize(true);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex(3) . $rowCell, $row['major_name']);
    $sheet->getStyle(Coordinate::stringFromColumnIndex(3) . $rowCell)->applyFromArray($styleTextLeft);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex(3))->setAutoSize(true);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex(4) . $rowCell, $row['medium_name']);
    $sheet->getStyle(Coordinate::stringFromColumnIndex(4) . $rowCell)->applyFromArray($styleTextLeft);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex(4))->setAutoSize(true);

    $sheet->setCellValue(Coordinate::stringFromColumnIndex(5) . $rowCell, $row['breakdown_name']);
    $sheet->getStyle(Coordinate::stringFromColumnIndex(5) . $rowCell)->applyFromArray($styleTextLeft);
    $sheet->getColumnDimension(Coordinate::stringFromColumnIndex(5))->setAutoSize(true);
    $rowCell++;
}

// Prepare file for download
$writer = new Xlsx($spreadsheet);
$file_name = "PL-ACC-CODE-" . date("d-m-Y") . ".xlsx"; // ใส่นามสกุล .xlsx ด้วย

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $file_name . '"');
$writer->save('php://output');
exit();
