<?php

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
]);

$styleHeaderCenter = array_merge($borderStyle, [
    'font' => ['bold' => true, 'size' => 10, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
]);

$styleHeaderRight = array_merge($borderStyle, [
    'font' => ['bold' => true, 'size' => 10, 'name' => 'Arial'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
]);

// 📝 Text Styles (With Border)
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
// กำหนดความกว้างของคอลัมน์ A เป็น 20 หน่วย
// $sheet->getColumnDimension('A')->setWidth(20);

// กำหนดความกว้างหลายคอลัมน์พร้อมกัน
// foreach (range('B', 'D') as $col) {
//     $sheet->getColumnDimension($col)->setWidth(15);
// }

// กำหนดความสูงของแถวที่ 1 เป็น 30 หน่วย
// $sheet->getRowDimension('1')->setRowHeight(30);

// กำหนดความสูงหลายแถวพร้อมกัน
// for ($row = 2; $row <= 10; $row++) {
//     $sheet->getRowDimension($row)->setRowHeight(20);
// }

// $sheet->getStyle('A1')->applyFromArray($styleHeaderCenter);
// $sheet->getColumnDimension('A')->setWidth(25);
// $sheet->getRowDimension('1')->setRowHeight(35);
