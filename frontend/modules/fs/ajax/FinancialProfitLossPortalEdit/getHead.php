<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$quarter = mysqli_real_escape_string($connection, $_POST['quarter']);
$breakdown_id = mysqli_real_escape_string($connection, $_POST['breakdownId']);
$startYear = mysqli_real_escape_string($connection, $_POST['year']);

if ($breakdown_id != 'all') {
    $condition = " AND breakdown_id = '$breakdown_id' ";
} else {
    $condition = '';
}

$sql_acc = "SELECT * FROM tbl_branch_pl_account_code WHERE branchId = '$branchId' $condition ORDER BY acc_code ASC";
$res_acc = mysqli_query($connection, $sql_acc) or die($connection->error);
$listAcc = array();
while ($row_acc = mysqli_fetch_assoc($res_acc)) {
    $acc_id = $row_acc['account_id'];
    $listAcc[] = array(
        "account_id" => $row_acc['account_id'],
        "acc_code" => $row_acc['acc_code'],
        "acc_name" => $row_acc['acc_name']
    );
}

$sql_select = "SELECT financial_start_month FROM branch WHERE branchId = '$branchId' ";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
$row_select = mysqli_fetch_assoc($res_select);
$startMonth = $row_select['financial_start_month'];

$list_time = array();
$list_month = array();

for ($i = 0; $i < 12; $i++) {
    $currentMonth = ($startMonth + $i - 1) % 12 + 1;
    $currentYear = $startYear + floor(($startMonth + $i - 1) / 12);
    $monthName = date('F', mktime(0, 0, 0, $currentMonth, 1));
    $Q = ceil(($i + 1) / 3);

    $list_time[] = array(
        "list" => $i,
        "monthName" => $monthName,
        "month" => $currentMonth,
        "year" => $currentYear,
        "quarter" => $Q
    );
}

if ($quarter != '') {
    $i = 0;
    foreach ($list_time as $key => $time) {
        if ($time['quarter'] == $quarter) {
            $list_month[] = array(
                "list" => $i,
                "monthName" => $time['monthName'],
                "month" => $time['month'],
                "year" => $time['year'],
                "quarter" => $time['quarter']
            );
            $i++;
        }
    }
} else {
    $list_month = $list_time;
}

$rowData = array();
foreach ($list_month as $rowMonth) {
    $monthName = $rowMonth['monthName'];
    $month = $rowMonth['month'];
    $year = $rowMonth['year'];

    $rowData[] = array(
        "monthName" => $monthName,
        "month" => $month,
        "year" => $year,
        "data" => array()
    );

    foreach ($listAcc as $row_select) {
        $account_id = $row_select['account_id'];
        $sql_data = "SELECT * FROM tbl_branch_pl_data a 
        WHERE a.account_id = '$account_id' AND a.month = '$month' AND a.year = '$year'
        ORDER BY a.month ASC,a.year ASC ";
        $res_data = mysqli_query($connection, $sql_data) or die($connection->error);
        $row_data = mysqli_fetch_assoc($res_data);
        $rowData[count($rowData) - 1]['data'][] = array(
            "account_id" => $account_id,
            "monthName" => $monthName,
            "month" => $month,
            "year" => $year,
            "actual_amount" => $row_data['actual_amount'],
            "target_amount" => $row_data['target_amount'],
            "next_target_amount" => $row_data['next_target_amount']
        );
    }
}

$arr['listAcc'] = $listAcc;
mysqli_close($connection);
echo json_encode($arr);
