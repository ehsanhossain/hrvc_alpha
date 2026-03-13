<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$sqlMajor = "SELECT * FROM tbl_pl_major_df";
$resMajor = mysqli_query($connection, $sqlMajor) or die($connection->error);
$rowsMajor = mysqli_fetch_all($resMajor, MYSQLI_ASSOC);

?>
<option value="">All Catagory</option>
<?php
foreach ($rowsMajor as $rowMajor) {
?>
    <option value="<?php echo $rowMajor['pl_major_id']; ?>"><?php echo $rowMajor['major_name']; ?></option>
<?php
}
?>