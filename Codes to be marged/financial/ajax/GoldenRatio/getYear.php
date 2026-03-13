 <?php
  include("../../../config/main_function.php");
  $secure = "-%ekla!(m09)%1A7";
  $connection = connectDB($secure);

  $branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
  $startYear = mysqli_real_escape_string($connection, $_POST['startYear']);

  $sql_select = "SELECT MIN(a.year) AS year FROM tbl_branch_pl_data a
   LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id
   LEFT JOIN branch c ON b.branchId = c.branchId
   WHERE b.branchId = '$branchId'";
  $res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
  $row_select = mysqli_fetch_assoc($res_select);
  $min_year = intval($row_select['year']) <= 0 ? intval(date('Y')) : intval($row_select['year']);


  if ($startYear != '') {
    $selected = intval($startYear);
  } else {
    $selected = intval(date('Y'));
  }
  $current_year = intval(date('Y'));

  for ($year = $min_year; $year <= $current_year; $year++) {
  ?>
   <option value="<?php echo $year; ?>" <?php echo $year == $selected ? 'selected' : ''; ?>><?php echo $year; ?></option>
 <?php
  }
  ?>