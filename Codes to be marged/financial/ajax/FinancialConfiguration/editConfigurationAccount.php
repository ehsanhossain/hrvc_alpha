<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$account_id = mysqli_real_escape_string($connection, $_POST['account_id']);
$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$acc_code = mysqli_real_escape_string($connection, $_POST['accountCode']);
$acc_name = mysqli_real_escape_string($connection, $_POST['accountName']);
$pl_medium_id = mysqli_real_escape_string($connection, $_POST['pl_medium_id']);
$breakdown_id = mysqli_real_escape_string($connection, $_POST['pl_breakdown_id']);
$note = mysqli_real_escape_string($connection, $_POST['description']);

if ($connection) {

    $sql_insert = "UPDATE tbl_branch_pl_account_code SET
    acc_code = '$acc_code',
    acc_name = '$acc_name',
    pl_medium_id = '$pl_medium_id',
    breakdown_id = '$breakdown_id',
    note = '$note'
    WHERE account_id = '$account_id'";
    $res_insert = mysqli_query($connection, $sql_insert)  or die($connection->error);

    if ($res_insert) {
        $sql_branch_account_code = "SELECT a.*,b.medium_name,c.major_name,e.breakdown_name FROM tbl_branch_pl_account_code a 
        LEFT JOIN tbl_pl_medium_df b ON a.pl_medium_id = b.pl_medium_id
        LEFT JOIN tbl_pl_major_df c ON b.pl_major_id = c.pl_major_id
        LEFT JOIN tbl_pl_breakdown_df e ON a.breakdown_id = e.breakdown_id 
        WHERE branchId = '$branchId' ORDER BY a.acc_code ASC;";
        $res_branch_account_code = mysqli_query($connection, $sql_branch_account_code)  or die($connection->error);

        $index = 0;

        while ($row_branch_account_code = mysqli_fetch_array($res_branch_account_code, MYSQLI_ASSOC)) {
            if ($row_branch_account_code['acc_code'] === $acc_code) {
                $page = ceil($index / 9);
                $arr['page'] = $page;
                break;
            }
            $index++;
        }

        $arr['result'] = 1;
    } else {
        $arr['result'] = 0;
    }
} else {
    $arr['result'] = 9;
}

mysqli_close($connection);
echo json_encode($arr);
