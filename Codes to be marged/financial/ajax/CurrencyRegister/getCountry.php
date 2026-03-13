<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$sql = "SELECT c.*,d.currencyId 
FROM country c 
LEFT JOIN tbl_currency d ON c.countryId = d.countryId
ORDER BY countryName ASC;";
$res = mysqli_query($connection, $sql)  or die($connection->error);
?>
<option value="" selected>Country or region where the currency is used</option>
<?php while ($row = mysqli_fetch_assoc($res)) {
    if ($row['currencyId'] != '') {
        $data_status = "<i class='bi bi-check-circle'></i> Already in Use";
    } else {
        $data_status = " Not Set Yet";
    }
?>
    <option value="<?php echo $row['countryId']; ?>" data-status="<?php echo $data_status; ?>" data-icon="https://tcg-hrvc-system.com/<?php echo $row['flag'] == '' ? 'images/no-img.png' : $row['flag']; ?>"><?php echo $row['countryName']; ?></option>
<?php } ?>