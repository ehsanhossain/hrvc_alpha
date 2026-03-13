<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$sqlBreakdown = "SELECT * FROM tbl_pl_breakdown_df";
$resBreakdown = mysqli_query($connection, $sqlBreakdown) or die($connection->error);
$rowsBreakdown = mysqli_fetch_all($resBreakdown, MYSQLI_ASSOC);

?>
<option value="">All Breakdown</option>

<?php
foreach ($rowsBreakdown as $rowBreakdown) {
?>
    <option value="<?php echo $rowBreakdown['breakdown_id']; ?>"><?php echo $rowBreakdown['breakdown_name']; ?></option>
<?php
}
?>