<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

if ($connection) {

    $date = date('Y-m-d');
    $apiUrl = "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@{$date}/v1/currencies/usd.json";

    // เริ่มการเชื่อมต่อ API ด้วย cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    // แปลงข้อมูล JSON ที่ได้รับจาก API
    $data = json_decode($response, true);

    $sql = "SELECT * FROM tbl_currency WHERE status = '1' AND source = '1' ;";
    $res = mysqli_query($connection, $sql) or die($connection->error);
    $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

    foreach ($rows as $row) {
        $currencyId = $row['currencyId'];
        $currencyCode = $row['currencyCode'];
        $lowerCode = strtolower($currencyCode);

        // ตรวจสอบว่า API ส่งข้อมูลสำเร็จหรือไม่
        if (isset($data['usd'][$lowerCode])) {

            $exchangeRate = $data['usd'][$lowerCode];

            $sqlUpdate = "UPDATE tbl_currency SET exchangeRate = '$exchangeRate',update_datetime = NOW() WHERE currencyId = '$currencyId';";
            $resUpdate = mysqli_query($connection, $sqlUpdate);
        }
    }
    $arr['result'] = 1;
    
} else {
    $arr['result'] = 9;
}

echo json_encode($arr);
