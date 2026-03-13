<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$element = mysqli_real_escape_string($connection, $_POST['element']);
$MajorId = mysqli_real_escape_string($connection, $_POST['MajorId']);

$sqlMedium = "SELECT * FROM tbl_pl_medium_df WHERE pl_major_id = '$MajorId' ";
$resMedium = mysqli_query($connection, $sqlMedium) or die($connection->error);
$rowsMedium = mysqli_fetch_all($resMedium, MYSQLI_ASSOC);

if ($element == 'MediumId') {
?>
    <option value="">All Sub-Catagory</option>
<?php
} else {
?>
    <option value="" disabled>e.g., Manufacturing Expense (CS)</option>
<?php
}
foreach ($rowsMedium as $rowMedium) {
?>
    <option value="<?php echo $rowMedium['pl_medium_id']; ?>"><?php echo $rowMedium['medium_name']; ?></option>
<?php
}
?>