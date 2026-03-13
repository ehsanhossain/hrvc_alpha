<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$current_page = mysqli_real_escape_string($connection, $_POST['page']);
$companyId = mysqli_real_escape_string($connection, $_POST['companyId']);
$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);

echo $sql_branch = "SELECT a.*,b.*,c.countryName,c.flag,MIN(e.year) AS min_year
FROM branch a 
LEFT JOIN company b ON a.companyId = b.companyId
LEFT JOIN country c ON b.countryId = c.countryId
LEFT JOIN tbl_branch_pl_account_code d ON d.branchId = a.branchId
LEFT JOIN tbl_branch_pl_data e ON d.account_id = e.account_id
WHERE a.branchId = '$branchId' AND a.status = 1 ;";
$res_branch = mysqli_query($connection, $sql_branch)  or die($connection->error);
$row_branch = mysqli_fetch_assoc($res_branch);

$current_year = intval(date('Y'));
$min_year = intval($row_branch['min_year']) - 1;
$start_month = $row_branch['financial_start_month'];

for ($start_year = $current_year; $start_year >= $min_year; $start_year--) {
    if ($start_month == '1') {
        $end_month = '12';
        $end_year = $start_year;
    } else if ($start_month == '12') {
        $end_month = '1';
        $end_year = $start_year - 1;
    } else {
        $end_month = intval($start_month) - 1;
        $end_year = $start_year + 1;
    }

    $sql_status = "SELECT 
        COUNT(DISTINCT b.account_id) AS count_account,
        COUNT(b.actual_amount) AS count_actual_amount,
        COUNT(b.target_amount) AS count_target_amount,
        COUNT(b.next_target_amount) AS count_next_target_amount,
        COUNT(b.last_year_target) AS count_last_year_target_amount
    FROM tbl_branch_pl_account_code a
    JOIN (
        SELECT 
            c.account_id,
            c.actual_amount,
            c.target_amount,
            c.next_target_amount,
            (
                SELECT f.actual_amount 
                FROM tbl_branch_pl_data f
                WHERE f.account_id = c.account_id 
                AND f.year = c.year - 1
                AND f.month = c.month
                LIMIT 1
            ) AS last_year_target
        FROM tbl_branch_pl_data c
        WHERE (c.year = '$start_year' AND c.month >= '$start_month')
        OR (c.year = '$end_year' AND c.month <= '$end_month')
    ) b 
        ON b.account_id = a.account_id
    WHERE a.branchId = '$branchId';
    ";
    echo "<pre>";
    var_dump($sql_status);
    echo "</pre>";
    $res_status = mysqli_query($connection, $sql_status);
    $row_status = mysqli_fetch_assoc($res_status);
}

$num_row = mysqli_num_rows($res_branch);

$total_page = ceil($num_row / 6);
?>
<!-- 
<?php if ($current_page > 1) { ?>
    <button type="button" class="btn btn-outline-primary ms-1 me-1 fs-12" style="width: 100px;" onclick="getButtonFooter(<?php echo $current_page - 1; ?>)"><i class="bi bi-chevron-left"></i> Previous</button>
<?php } ?>

<?php if ($total_page <= 7) { ?>
    <?php for ($item = 1; $item <= $total_page; $item++) { ?>
        <button type="button" class="<?php echo $current_page == $item ? 'btn btn-outline-primary ms-1 me-1 active' : 'btn btn-outline-secondary ms-1 me-1'; ?>" onclick="getButtonFooter(<?php echo $item; ?>)"><?php echo $item; ?></button>
    <?php } ?>
<?php } else if ($total_page == 8) { ?>
    <?php if ($current_page <= 4) { ?>
        <?php for ($item = 1; $item <= 4; $item++) { ?>
            <button type="button" class="<?php echo $current_page == $item ? 'btn btn-outline-primary ms-1 me-1 active' : 'btn btn-outline-secondary ms-1 me-1'; ?>" onclick="getButtonFooter(<?php echo $item; ?>)"><?php echo $item; ?></button>
        <?php } ?>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1">...</button>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1" onclick="getButtonFooter(<?php echo $total_page; ?>)"><?php echo $total_page; ?></button>
    <?php } else { ?>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1" onclick="getButtonFooter(1)">1</button>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1">...</button>
        <?php for ($item = 5; $item <= $total_page; $item++) { ?>
            <button type="button" class="<?php echo $current_page == $item ? 'btn btn-outline-primary ms-1 me-1 active' : 'btn btn-outline-secondary ms-1 me-1'; ?>" onclick="getButtonFooter(<?php echo $item; ?>)"><?php echo $item; ?></button>
        <?php } ?>
    <?php } ?>
<?php } else { ?>
    <?php if ($current_page <= 4) { ?>
        <?php for ($item = 1; $item <= 4; $item++) { ?>
            <button type="button" class="<?php echo $current_page == $item ? 'btn btn-outline-primary ms-1 me-1 active' : 'btn btn-outline-secondary ms-1 me-1'; ?>" onclick="getButtonFooter(<?php echo $item; ?>)"><?php echo $item; ?></button>
        <?php } ?>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1">...</button>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1" onclick="getButtonFooter(<?php echo $total_page; ?>)"><?php echo $total_page; ?></button>
    <?php } else if ($current_page == 5) { ?>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1" onclick="getButtonFooter(1)">1</button>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1">...</button>
        <?php for ($item = 4; $item <= 6; $item++) { ?>
            <button type="button" class="<?php echo $current_page == $item ? 'btn btn-outline-primary ms-1 me-1 active' : 'btn btn-outline-secondary ms-1 me-1'; ?>" onclick="getButtonFooter(<?php echo $item; ?>)"><?php echo $item; ?></button>
        <?php } ?>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1">...</button>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1" onclick="getButtonFooter(<?php echo $total_page; ?>)"><?php echo $total_page; ?></button>
    <?php } else if ($current_page > 5 && $current_page < ($total_page - 3)) { ?>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1" onclick="getButtonFooter(1)">1</button>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1">...</button>

        <button type="button" class="btn btn-outline-secondary ms-1 me-1" onclick="getButtonFooter(<?php echo ($current_page - 1); ?>)"><?php echo ($current_page - 1); ?></button>
        <button type="button" class="btn btn-outline-primary ms-1 me-1 active" onclick="getButtonFooter(<?php echo $current_page; ?>)"><?php echo $current_page; ?></button>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1" onclick="getButtonFooter(<?php echo ($current_page + 1); ?>)"><?php echo ($current_page + 1); ?></button>

        <button type="button" class="btn btn-outline-secondary ms-1 me-1">...</button>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1" onclick="getButtonFooter(<?php echo $total_page; ?>)"><?php echo $total_page; ?></button>
    <?php } else { ?>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1" onclick="getButtonFooter(1)">1</button>
        <button type="button" class="btn btn-outline-secondary ms-1 me-1">...</button>
        <?php for ($item = ($total_page - 3); $item <= $total_page; $item++) { ?>
            <button type="button" class="<?php echo $current_page == $item ? 'btn btn-outline-primary ms-1 me-1 active' : 'btn btn-outline-secondary ms-1 me-1'; ?>" onclick="getButtonFooter(<?php echo $item; ?>)"><?php echo $item; ?></button>
        <?php } ?>
    <?php } ?>
<?php } ?>

<?php if ($current_page < $total_page) { ?>
    <button type="button" class="btn btn-outline-primary ms-1 me-1 fs-12" style="width: 100px;" onclick="getButtonFooter(<?php echo $current_page + 1; ?>)">Next <i class="bi bi-chevron-right"></i></button>
<?php } ?> -->