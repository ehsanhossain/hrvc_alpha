<?php
session_start();
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$currencyFocus = $_POST['currencyFocus'];
if ($currencyFocus) {
    $selected = $currencyFocus;
} else {
    $selected =  $_SESSION['currency_default'];
}

$sql = "SELECT * FROM tbl_currency a ;";
$res = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_assoc($res)) {

?>
    <option value="<?php echo $row['currencyId']; ?>" <?php echo $row['currencyId'] == $selected ? 'selected' : ''; ?>><?php echo $row['currencySymbol']; ?> <?php echo $row['currencyName']; ?></option>
<?php } ?>