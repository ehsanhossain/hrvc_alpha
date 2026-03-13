<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"]["tmp_name"];

    // โหลดไฟล์ Excel
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if (count($data) > 1) {
        // ลบแถวแรกออก (Header)
        array_shift($data);
    }

    echo "<h2>ข้อมูลจากไฟล์ Excel:</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>ชื่อ</th><th>อีเมล</th></tr>";

    foreach ($data as $row) {
        echo "<tr>";
        echo "<td>{$row[0]}</td>";
        echo "<td>{$row[1]}</td>";
        echo "<td>{$row[2]}</td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Import Excel</title>
</head>
<body>
    <h2>อัปโหลดไฟล์ Excel เพื่อ Import</h2>
    <form action="import.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">อัปโหลด</button>
    </form>
</body>
</html>
