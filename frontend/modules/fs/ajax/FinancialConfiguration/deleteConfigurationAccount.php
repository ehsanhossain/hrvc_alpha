 <?php
    include("../../../config/main_function.php");
    $secure = "-%ekla!(m09)%1A7";
    $connection = connectDB($secure);

    $account_id = mysqli_real_escape_string($connection, $_POST['account_id']);

    if ($connection) {

        $sql_delete = "DELETE FROM tbl_branch_pl_account_code WHERE account_id = '$account_id'";
        $res_delete = mysqli_query($connection, $sql_delete)  or die($connection->error);

        if ($res_delete) {
            $sql_delete_data = "DELETE FROM tbl_branch_pl_data WHERE account_id = '$account_id'";
            $res_delete_data = mysqli_query($connection, $sql_delete_data)  or die($connection->error);

            if ($res_delete_data) {
                $arr['result'] = 1;
            } else {
                $arr['result'] = 0;
            }
        } else {
            $arr['result'] = 0;
        }
    } else {
        $arr['result'] = 9;
    }

    mysqli_close($connection);
    echo json_encode($arr);
    ?>