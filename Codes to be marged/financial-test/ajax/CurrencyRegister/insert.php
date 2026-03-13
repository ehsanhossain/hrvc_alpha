<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

if ($connection) {
    $currencyId = getRandomID2(10, 'tbl_currency', 'currencyId');
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

    $sql = "INSERT INTO tbl_currency SET
        currencyId = '$currencyId',
        currencyName = '$currencyName',
        currencyCode = '$currencyCode',
        currencySymbol = '$currencySymbol',
        countryId = '$countryId',
        exchangeRate = '$exchangeRate',
        source = '$source'";
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
