<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$breakdown = mysqli_real_escape_string($connection, $_POST['breakdown']);

$sql_select = "SELECT * FROM tbl_pl_breakdown_df";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);

?>

<option value="all">All PL Breakdown</option>
<?php
while ($row = mysqli_fetch_assoc($res_select)) {
?>
    <option value="<?php echo $row['breakdown_id']; ?>" <?php echo $row['breakdown_id'] == $breakdown ? 'selected' : ''; ?>><?php echo $row['breakdown_name']; ?></option>
<?php
}
?>