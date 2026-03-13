<?php
include('../../../config/main_function.php');
require '../../../vendor/autoload.php';
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

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

$select_medium = "SELECT md.pl_medium_id, md.medium_name, mj.pl_major_id, mj.major_name FROM tbl_pl_medium_df md
LEFT JOIN tbl_pl_major_df mj ON md.pl_major_id = mj.pl_major_id ;";
$rs_medium = mysqli_query($connection, $select_medium) or die($connection->error);
while ($row_medium = mysqli_fetch_assoc($rs_medium)) {
    $medium_array[] = array(
        "pl_medium_id" => $row_medium['pl_medium_id'],
        "medium_name" => $row_medium['medium_name'],
        "pl_major_id" => $row_medium['pl_major_id'],
        "major_name" => $row_medium['major_name']
    );
}

$select_breakdown = "SELECT bd.breakdown_id, bd.breakdown_name FROM tbl_pl_breakdown_df bd ;";
$rs_breakdown = mysqli_query($connection, $select_breakdown) or die($connection->error);
while ($row_breakdown = mysqli_fetch_assoc($rs_breakdown)) {
    $breakdown_array[] = array(
        "breakdown_id" => $row_breakdown['breakdown_id'],
        "breakdown_name" => $row_breakdown['breakdown_name']
    );
}

$branchId = $_POST['branchId'];

$AccountingCode = 0;
$AccountingName = 1;
$Major = 2;
$Medium = 3;
$Breakdown = 4;

$errorList = array();
$listOfInserted = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileImport"])) {
    $file = $_FILES["fileImport"]["tmp_name"];

    // โหลดไฟล์ Excel
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    if (count($data) > 1) {
        // ลบแถวแรกออก (Header)
        array_shift($data);
    }

    foreach ($data as $key => $row) {
        if ($row[$AccountingCode] == "" && $row[$AccountingName] == "") {
            continue;
        } else {

            if ($row[$Major] == "" || $row[$Medium] == "" || $row[$Breakdown] == "" || $row[$AccountingCode] == "" || $row[$AccountingName] == "") {
                $errorList[] = array(
                    "row" => $key,
                    "text" => "Have blank cell."
                );
            }

            $indexMedium = array_search($row[$Medium], array_column($medium_array, 'medium_name'));
            if ($indexMedium !== false) {
                if (!in_array($row[$Major], array_column($medium_array, 'major_name'), $indexMedium)) {
                    $errorList[] = array(
                        "row" => $key,
                        "text" => "Medium is incorrect Major."
                    );
                } else {
                    $pl_medium_id = $medium_array[$indexMedium]['pl_medium_id'];
                    $pl_major_id = $medium_array[$indexMedium]['pl_major_id'];
                }
            } else {
                $errorList[] = array(
                    "row" => $key,
                    "data" => $row[$Major],
                    "text" => "Incorrect Medium."
                );
            }

            $indexBreakdown = array_search($row[$Breakdown], array_column($breakdown_array, 'breakdown_name'));
            if ($indexBreakdown !== false) {
                if (!in_array($row[$Breakdown], array_column($breakdown_array, 'breakdown_name'), $indexBreakdown)) {
                    $errorList[] = array(
                        "row" => $key,
                        "data" => $row[$Breakdown],
                        "text" => "incorrect Breakdown."
                    );
                } else {
                    $breakdown_id = $breakdown_array[$indexBreakdown]['breakdown_id'];
                }
            } else {
                $errorList[] = array(
                    "row" => $key,
                    "text" => "incorrect Breakdown."
                );
            }

            $listOfInserted[] = array(
                "acc_code" => $row[$AccountingCode],
                "acc_name" => $row[$AccountingName],
                "pl_medium_id" => $pl_medium_id,
                "medium_name" => $row[$Major],
                "pl_major_id" => $pl_major_id,
                "major_name" => $row[$Medium],
                "breakdown_id" => $breakdown_id,
                "breakdown_name" => $row[$Breakdown]
            );
        }
    }

    if (count($errorList) > 0) {
        saveFileToServer($errorList);
        $arr['result'] = 0;
        mysqli_close($connection);
        echo json_encode($arr);
        die();
    } else {
        if (count($listOfInserted) > 0) {
            foreach ($listOfInserted as $request) {
                $acc_code_post = mysqli_real_escape_string($connection, $request['acc_code']);
                $acc_name_post = mysqli_real_escape_string($connection, $request['acc_name']);
                $pl_medium_id_post = mysqli_real_escape_string($connection, $request['pl_medium_id']);
                $medium_name_post = mysqli_real_escape_string($connection, $request['medium_name']);
                $pl_major_id_post = mysqli_real_escape_string($connection, $request['pl_major_id']);
                $major_name_post = mysqli_real_escape_string($connection, $request['major_name']);
                $breakdown_id_post = mysqli_real_escape_string($connection, $request['breakdown_id']);
                $breakdown_name_post = mysqli_real_escape_string($connection, $request['breakdown_name']);

                $sql_check = "SELECT COUNT(*) AS count FROM tbl_branch_pl_account_code a WHERE a.acc_code = '$acc_code_post' AND a.branchId = '$branchId' ;";
                $rs_check = mysqli_query($connection, $sql_check) or die($connection->error);
                $row_check = mysqli_fetch_assoc($rs_check);

                if ($row_check['count'] >= 1) {
                    $sql_update = "UPDATE tbl_branch_pl_account_code SET
                    acc_name = '$acc_name_post',
                    pl_medium_id = '$pl_medium_id_post',
                    breakdown_id = '$breakdown_id_post'
                    WHERE branchId = '$branchId' AND acc_code = '$acc_code_post' ";
                    $res_update = mysqli_query($connection, $sql_update)  or die($connection->error);
                } else {
                    $account_id_post = getRandomID(10, 'tbl_branch_pl_account_code', 'account_id');

                    $sql_select = "SELECT IF(MAX(list_order) IS NULL, 0, MAX(list_order)) AS list_order FROM tbl_branch_pl_account_code WHERE branchId = '$branchId';";
                    $res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
                    $row_select = mysqli_fetch_assoc($res_select);
                    $list_order = $row_select['list_order'];
                    $list_order_post += 1;

                    $sql_insert = "INSERT INTO tbl_branch_pl_account_code SET
                    account_id = '$account_id_post',
                    branchId = '$branchId',
                    acc_code = '$acc_code_post',
                    acc_name = '$acc_name_post',
                    pl_medium_id = '$pl_medium_id_post',
                    breakdown_id = '$breakdown_id_post',
                    list_order = '$list_order_post' ";
                    $res_insert = mysqli_query($connection, $sql_insert)  or die($connection->error);
                }
            }
            $arr['page'] = 1;
            $arr['result'] = 1;
        } else {
            $arr['result'] = 2;
        }
    }

    mysqli_close($connection);
    echo json_encode($arr);
}
