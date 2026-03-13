<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// สร้างเอกสาร Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// ตั้งค่าหัวตาราง
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'ชื่อ');
$sheet->setCellValue('C1', 'อีเมล');

// เพิ่มข้อมูลตัวอย่าง
$data = [
    [1, 'ป๊าก', 'pak@example.com'],
    [2, 'อลิศรา', 'alice@example.com'],
    [3, 'สมชาย', 'somchai@example.com'],
];

$row = 2;
foreach ($data as $item) {
    $sheet->setCellValue("A$row", $item[0]);
    $sheet->setCellValue("B$row", $item[1]);
    $sheet->setCellValue("C$row", $item[2]);
    $row++;
}

// กำหนดให้ดาวน์โหลดไฟล์
$writer = new Xlsx($spreadsheet);
$filename = 'users.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
$writer->save('php://output');
exit();
?>
