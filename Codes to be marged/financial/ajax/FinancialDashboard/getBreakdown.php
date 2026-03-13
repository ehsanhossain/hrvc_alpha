<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$sql = "SELECT * FROM tbl_pl_breakdown_df a WHERE a.breakdown_id != 0 ORDER BY a.list_order ASC;";
$res = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_assoc($res)) {

?>
    <option value="<?php echo $row['breakdown_id']; ?>"><?php echo $row['breakdown_name']; ?></option>
<?php } ?>