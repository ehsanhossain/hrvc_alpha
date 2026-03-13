<?php
include('../../../config/main_function.php');
require '../../../vendor/autoload.php';
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;


function saveFileToServer($errorList)
{
    $inputFile = $_FILES['fileImport']['tmp_name'];
    $spreadsheet = IOFactory::load($inputFile);
    $sheet = $spreadsheet->getActiveSheet();

    foreach ($errorList as $error) {
        $row = $error['row'] + 2; // +2 เพราะแถวแรกคือ header และ error row เริ่มจาก 0

        $sheet->getStyle('A' . $row . ':G' . $row)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB(Color::COLOR_RED);

        $sheet->setCellValue('H' . $row, $error['text']);
    }

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('ErrorFiles.xlsx');
}

$branchId = $_POST['branchId'];

$listOfMonth = array();

$AccountingCode = 1;
$AccountingName = 2;
$Major = 3;
$Medium = 4;
$Breakdown = 5;

$errorList = array();
$listOfInserted = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileImport"])) {
    $file = $_FILES["fileImport"]["tmp_name"];

    // โหลดไฟล์ Excel
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();

    $loop = 1;
    for ($i = $Medium; $i <= 37; $i += 3) {
        $cellCoordinate = Coordinate::stringFromColumnIndex($i) . '1';
        $cellValue = $sheet->getCell($cellCoordinate)->getValue();

        if (empty($cellValue)) {
            $errorList[] = [
                "row" => 1,
                "text" => "Cell {$cellCoordinate} is empty."
            ];
        } else {
            $cellValueExplode = explode("/", $cellValue);
            if (count($cellValueExplode) === 2) {
                $month = intval($cellValueExplode[0]);
                $year = intval($cellValueExplode[1]);

                if (($month >= 1 && $month <= 12) && ($year > 1970)) {
                    $listOfMonth[] = [
                        "key" => $i,
                        "Cell" => $cellCoordinate,
                        "month" => $month,
                        "year" => $year
                    ];
                } else {
                    $errorList[] = [
                        "row" => 1,
                        "text" => "Cell {$cellCoordinate} has invalid Month/Year format (e.g., 1/2025)."
                    ];
                }
            } else {
                $errorList[] = [
                    "row" => 1,
                    "text" => "Cell {$cellCoordinate} has invalid format. Expected Month/Year (e.g., 1/2025)."
                ];
            }
        }
        $loop++;
    }

    if (count($errorList) > 0) {
        saveFileToServer($errorList);
        $arr['result'] = 0;
        mysqli_close($connection);
        echo json_encode($arr);
        die();
    }

    $data = $sheet->toArray();

    if (count($data) >= 3) {
        array_shift($data); // นำแถวที่ 1 ออก
        array_shift($data); // นำแถวที่ 2 ออก
    }

    $acc_code_col = 0;
    $acc_name_col = 1;
    $au = 2;
    $tar = 3;
    $n_tar = 4;

    $listOfData = array();

    foreach ($data as $key => $row) {
        $rowData = array(
            "key" => $key,
            "acc_code" => $row[$acc_code_col],
            "acc_name" => $row[$acc_name_col],
            "data" => array()
        );

        foreach ($listOfMonth as $monthData) {
            $rowData['data'][] = array(
                "month" => $monthData['month'],
                "year" => $monthData['year'],
                "au" => floatval(str_replace(',', '', trim($row[$au]))),
                "tar" => floatval(str_replace(',', '', trim($row[$tar]))),
                "n_tar" => floatval(str_replace(',', '', trim($row[$n_tar])))
            );
            $au += 3;
            $tar += 3;
            $n_tar += 3;
        }

        $au = 2;
        $tar = 3;
        $n_tar = 4;

        $listOfData[] = $rowData;
    }

    foreach ($listOfData as $key => $row) {
        $acc_code = $row['acc_code'];
        $sql_acc_id = "SELECT a.account_id FROM tbl_branch_pl_account_code a WHERE a.branchId = '$branchId' AND a.acc_code = '$acc_code'";
        $res_acc_id = mysqli_query($connection, $sql_acc_id) or die($connection->error);
        $row_acc_id = mysqli_fetch_assoc($res_acc_id);
        $account_id = $row_acc_id['account_id'];

        foreach ($row["data"] as $row_detail) {
            $month = $row_detail['month'];
            $year = $row_detail['year'];
            $actual_amount = $row_detail['au'] == '' ? 0 : $row_detail['au'];
            $target_amount = $row_detail['tar'] == '' ? 0 : $row_detail['tar'];
            $next_target_amount = $row_detail['n_tar'] == '' ? 0 : $row_detail['n_tar'];

            $sql_check = "SELECT COUNT(*) AS count FROM tbl_branch_pl_data a WHERE a.account_id = '$account_id' AND a.month = '$month' AND a.year = '$year'";
            $rs_check = mysqli_query($connection, $sql_check) or die($connection->error);
            $row_check = mysqli_fetch_assoc($rs_check);
            if ($row_check['count'] > 0) {
                if ($actual_amount == "" && $target_amount == "" && $next_target_amount == "") {
                    $sql_delete = "DELETE FROM tbl_branch_pl_data WHERE account_id = '$account_id' AND month = '$month' AND year = '$year'";
                    $res_delete = mysqli_query($connection, $sql_delete)  or die($connection->error);
                } else {
                    $sql_update = "UPDATE tbl_branch_pl_data SET
                    actual_amount = '$actual_amount',
                    target_amount = '$target_amount',
                    next_target_amount = '$next_target_amount'
                    WHERE account_id = '$account_id' AND month = '$month' AND year = '$year'";
                    $res_update = mysqli_query($connection, $sql_update)  or die($connection->error);
                }
            } else {
                if ($actual_amount != "" || $target_amount != "" || $next_target_amount != "") {
                    $sql_insert = "INSERT INTO tbl_branch_pl_data SET
                    account_id = '$account_id',
                    month = '$month',
                    year = '$year',
                    actual_amount = '$actual_amount',
                    target_amount = '$target_amount',
                    next_target_amount = '$next_target_amount' ";
                    $res_insert = mysqli_query($connection, $sql_insert)  or die($connection->error);
                }
            }
        }
        $arr['result'] = 1;
    }

    mysqli_close($connection);
    echo json_encode($arr);
}
