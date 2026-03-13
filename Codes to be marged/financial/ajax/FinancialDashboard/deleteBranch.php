<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

if ($connection) {
    $branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
    $date = date('Y-m-d H:i:s');

    $sql = "UPDATE branch SET financial_start_month = NULL ,updateDateTime = '$date' WHERE branchId = '$branchId' ";
    $res = mysqli_query($connection, $sql);

    if ($res) {
        $arr['result'] = 1;
    } else {
        $arr['result'] = 0;
    }
} else {
    $arr['result'] = 9;
}

echo json_encode($arr);
