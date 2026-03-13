<?php
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

// Create a new spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set default font
$spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);

// Set table headers
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Email');
$sheet->setCellValue('D1', 'Month & Year');

// Sample data (only month and year)
$data = [
    [1, 'Pak', 'pak@example.com', '2025-07'],
    [2, 'Alice', 'alice@example.com', '2025-08'],
    [3, 'Somchai', 'somchai@example.com', '2025-09'],
];

$row = 2;
foreach ($data as $item) {
    $sheet->setCellValue("A$row", $item[0]);
    $sheet->setCellValue("B$row", $item[1]);
    $sheet->setCellValue("C$row", $item[2]);

    // Parse year and month, set the date as the 1st of the month
    $dateString = $item[3] . '-01';
    $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(strtotime($dateString));

    $sheet->setCellValue("D$row", $dateValue);
    $sheet->getStyle("D$row")->getNumberFormat()->setFormatCode('MMMM YYYY');

    $row++;
}

// Auto size columns
foreach (range('A', 'D') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Prepare file for download
$writer = new Xlsx($spreadsheet);
$filename = 'users_with_month_year.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
$writer->save('php://output');
exit();
