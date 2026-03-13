<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);
$datetime = date("Y-m-d H:i:s");

if ($connection) {
    $currencyId = mysqli_real_escape_string($connection, $_POST['currencyId']);
    $currencyName = mysqli_real_escape_string($connection, $_POST['currencyName']);
    $currencyCode = mysqli_real_escape_string($connection, $_POST['currencyCode']);
    $currencySymbol = mysqli_real_escape_string($connection, $_POST['currencySymbol']);
    $countryId = mysqli_real_escape_string($connection, $_POST['countryId']);
    $source = mysqli_real_escape_string($connection, $_POST['source']);

    if ($source == '1') {
        $exchangeRate = mysqli_real_escape_string($connection, $_POST['equivalent']);
    } else {
        $exchangeRate = mysqli_real_escape_string($connection, $_POST['equivalentManual']);
    }

    $exchangeRate = str_replace(',', '', $exchangeRate);

    $sql = "UPDATE tbl_currency SET
        currencyName = '$currencyName',
        currencyCode = '$currencyCode',
        currencySymbol = '$currencySymbol',
        countryId = '$countryId',
        exchangeRate = '$exchangeRate',
        source = '$source',
        update_datetime = '$datetime'
        WHERE currencyId = '$currencyId' ";
    $res = mysqli_query($connection, $sql) or die($connection->error);

    if ($res) {
        $arr['result'] = 1;
    } else {
        $arr['result'] = 0;
    }
} else {
    $arr['result'] = 9;
}

echo json_encode($arr);
