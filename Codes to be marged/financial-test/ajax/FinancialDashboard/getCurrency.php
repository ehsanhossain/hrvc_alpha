<?php
session_start();
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$currency_default = $_SESSION['currency_default'];

$sql = "SELECT * FROM tbl_currency a ;";
$res = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_assoc($res)) {

?>
    <option value="<?php echo $row['currencyId']; ?>" <?php echo $row['currencyId'] == $currency_default ? 'selected' : ''; ?>><?php echo $row['currencySymbol']; ?> <?php echo $row['currencyName']; ?></option>
<?php } ?>