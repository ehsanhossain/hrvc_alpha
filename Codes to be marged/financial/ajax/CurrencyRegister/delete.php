<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);
$datetime = date("Y-m-d H:i:s");

if ($connection) {
    $currencyId = mysqli_real_escape_string($connection, $_POST['currencyId']);

    $sql = "SELECT * FROM branch WHERE currency_default = '$currencyId' ";
    $res = mysqli_query($connection, $sql) or die($connection->error);
    $num = mysqli_num_rows($res);

    if ($num > 0) {
        $arr['result'] = 2;
    } else {
        $sql = "DELETE FROM tbl_currency WHERE currencyId = '$currencyId' ";
        $res = mysqli_query($connection, $sql) or die($connection->error);

        if ($res) {
            $arr['result'] = 1;
        } else {
            $arr['result'] = 0;
        }
    }
} else {
    $arr['result'] = 9;
}

echo json_encode($arr);
