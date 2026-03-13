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

?>

<div class="d-flex scroll-none" style="width:1800px">
    <?php foreach ($rowData as $key => $list_month) { ?>
        <table class="table-item item-data me-1 table-data-pl ">
            <thead>
                <tr class="row-title-1">
                    <th class="px-1 fs-15">
                        <span class="pointer ex-collapse">

                            <?php echo $list_month['monthName']; ?>

                            <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="12" height="14" rx="2" fill="#2580D3" />
                                <path d="M9.29561 8.03108L5.34571 12.2798C5.0727 12.5734 4.63124 12.5734 4.36114 12.2798L3.70476 11.5737C3.43175 11.2801 3.43175 10.8052 3.70476 10.5147L6.50454 7.50312L3.70476 4.49156C3.43175 4.19791 3.43175 3.72306 3.70476 3.43252L4.35823 2.72024C4.63124 2.42659 5.0727 2.42659 5.3428 2.72024L9.2927 6.96892C9.56861 7.26257 9.56861 7.73743 9.29561 8.03108Z" fill="white" />
                            </svg>

                        </span>
                    </th>
                    <th class="text-end btn-collapse" colspan="3" style="cursor: pointer;">
                        <a class="row-collapse"><i class="bi bi-arrow-bar-left"></i> Collapse</a>
                    </th>
                </tr>
                <tr class="row-title-1">
                    <th class="px-1 data-pl show" style="min-width:68px">
                        <div class="label-title label-green">CP</div>
                        <?php echo $list_month['year']; ?>
                    </th>
                    <th class="px-1 data-pl" style="min-width:68px">
                        <div class="label-title label-yellow">CT</div>
                        <?php echo $list_month['year']; ?>
                    </th>
                    <th class="px-1 data-pl" style="min-width:68px">
                        <div class="label-title label-blue">NT</div>
                        <?php echo $list_month['year'] + 1; ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($list_month['data'] as $row_detail) {
                ?>
                    <tr class="upper m-<?php echo $i; ?>">
                        <td class="data-pl show"><input type="text" value="<?php echo $row_detail['actual_amount']; ?>" onchange="updateData('<?php echo $row_detail['account_id']; ?>','1','<?php echo $row_detail['month']; ?>','<?php echo $row_detail['year']; ?>',this.value,$(this))" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" placeholder="0"></td>
                        <td class="data-pl"><input type="text" value="<?php echo $row_detail['target_amount']; ?>" onchange="updateData('<?php echo $row_detail['account_id']; ?>','2','<?php echo $row_detail['month']; ?>','<?php echo $row_detail['year']; ?>',this.value,$(this))" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" placeholder="0"></td>
                        <td class="data-pl"><input type="text" value="<?php echo $row_detail['next_target_amount']; ?>" onchange="updateData('<?php echo $row_detail['account_id']; ?>','3','<?php echo $row_detail['month']; ?>','<?php echo $row_detail['year']; ?>',this.value,$(this))" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" placeholder="0"></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<?php
mysqli_close($connection);
?>