<?php
$CurrencyCode = $_POST['currencyCode'];
$lowerCode = strtolower($CurrencyCode);

$date = date('Y-m-d');
// $date = date('Y-m-d', strtotime('-1 day'));
$apiUrl = "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@{$date}/v1/currencies/usd.json";
// เริ่มการเชื่อมต่อ API ด้วย cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

// แปลงข้อมูล JSON ที่ได้รับจาก API
$data = json_decode($response, true);

// ตรวจสอบว่า API ส่งข้อมูลสำเร็จหรือไม่
if (isset($data['usd'][$lowerCode])) {

    $exchangeRate = $data['usd'][$lowerCode]; // Fetch THB exchange rate

    $arr['result'] = 1;
    $arr['exchangeRate'] = $exchangeRate;

} else {
    $arr['result'] = 0;
}

echo json_encode($arr);
