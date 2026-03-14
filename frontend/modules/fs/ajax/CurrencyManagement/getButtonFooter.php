<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$condition = "";

$current_page = mysqli_real_escape_string($connection, $_POST['page'] ?? '1');
$filter = mysqli_real_escape_string($connection, $_POST['filter'] ?? '1');
$searchText = mysqli_real_escape_string($connection, $_POST['searchText'] ?? '');

if ($searchText != '') {
    $condition = " AND a.currencyName LIKE '%$searchText%' ";
}

if ($filter == '1') {
    $condition .= " ORDER BY currencyName ASC ";
} else {
    $condition .= " ORDER BY currencyName DESC ";
}

$sql_branch = "SELECT a.*,b.countryName,b.flag FROM tbl_currency a
LEFT JOIN country b ON a.countryId = b.countryId $condition ;";
$res_branch = mysqli_query($connection, $sql_branch)  or die($connection->error);
$num_row = mysqli_num_rows($res_branch);

$total_page = ceil($num_row / 10);

if ($total_page == $current_page) {
    $show_count = $num_row - (($total_page - 1) * 10);
} else {
    $show_count = 10;
}
?>

<div class="col-lg-3 text-lg-start text-center fw-300">
    Showing <strong class="fw-700"><?php echo $show_count; ?></strong> of <strong class="fw-700"><?php echo $num_row; ?></strong> Currency Registry
</div>
<div class="col-lg-6 col-12 text-center">
    <div class="pagination">
        <a onclick="getButtonFooter(<?php echo $current_page - 1; ?>)" class="previous <?php echo $current_page > 1 ? '' : 'disabled'; ?>">
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.63528 10.5444C6.95295 10.8621 6.95295 11.3772 6.63528 11.6948C6.3176 12.0125 5.80254 12.0125 5.48486 11.6948L0.36499 6.57498C0.047606 6.25759 0.0476059 5.74301 0.36499 5.42563L5.48486 0.305753C5.80254 -0.0119256 6.3176 -0.0119256 6.63528 0.305753C6.95295 0.62343 6.95295 1.13849 6.63528 1.45617L2.09114 6.0003L6.63528 10.5444Z" fill="#2580D3" />
            </svg>
            Previous
        </a>

        <?php if ($total_page <= 7) { ?>
            <?php for ($item = 1; $item <= $total_page; $item++) { ?>
                <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getButtonFooter(<?php echo $item; ?>)"><?php echo $item; ?></a>
            <?php } ?>
        <?php } else if ($total_page == 8) { ?>
            <?php if ($current_page <= 4) { ?>
                <?php for ($item = 1; $item <= 4; $item++) { ?>
                    <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getButtonFooter(<?php echo $item; ?>)"><?php echo $item; ?></a>
                <?php } ?>
                <span class="mx-2">...</span>
                <a class="" onclick="getButtonFooter(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a>
            <?php } else { ?>
                <a class="" onclick="getButtonFooter(1)">1</a>
                <span class="mx-2">...</span>
                <?php for ($item = 5; $item <= $total_page; $item++) { ?>
                    <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getButtonFooter(<?php echo $item; ?>)"><?php echo $item; ?></a>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <?php if ($current_page <= 4) { ?>
                <?php for ($item = 1; $item <= 4; $item++) { ?>
                    <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getButtonFooter(<?php echo $item; ?>)"><?php echo $item; ?></a>
                <?php } ?>
                <span class="mx-2">...</span>
                <a class="" onclick="getButtonFooter(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a>
            <?php } else if ($current_page == 5) { ?>
                <a class="" onclick="getButtonFooter(1)">1</a>
                <span class="mx-2">...</span>
                <?php for ($item = 4; $item <= 6; $item++) { ?>
                    <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getButtonFooter(<?php echo $item; ?>)"><?php echo $item; ?></a>
                <?php } ?>
                <span class="mx-2">...</span>
                <a class="" onclick="getButtonFooter(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a>
            <?php } else if ($current_page > 5 && $current_page < ($total_page - 3)) { ?>
                <a class="" onclick="getButtonFooter(1)">1</a>
                <span class="mx-2">...</span>

                <a class="" onclick="getButtonFooter(<?php echo ($current_page - 1); ?>)"><?php echo ($current_page - 1); ?></a>
                <a class="active" onclick="getButtonFooter(<?php echo $current_page; ?>)"><?php echo $current_page; ?></a>
                <a class="" onclick="getButtonFooter(<?php echo ($current_page + 1); ?>)"><?php echo ($current_page + 1); ?></a>

                <span class="mx-2">...</span>
                <a class="" onclick="getButtonFooter(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a>
            <?php } else { ?>
                <a class="" onclick="getButtonFooter(1)">1</a>
                <span class="mx-2">...</span>
                <?php for ($item = ($total_page - 3); $item <= $total_page; $item++) { ?>
                    <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getButtonFooter(<?php echo $item; ?>)"><?php echo $item; ?></a>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        <a onclick="getButtonFooter(<?php echo $current_page + 1; ?>)" class="next <?php echo $current_page < $total_page ? '' : 'disabled'; ?>">
            Next
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.365212 1.45605C0.0475336 1.13838 0.0475336 0.623319 0.365212 0.305641C0.68289 -0.0120367 1.19795 -0.0120367 1.51563 0.305641L6.6355 5.42551C6.95288 5.7429 6.95288 6.25748 6.6355 6.57486L1.51563 11.6947C1.19795 12.0124 0.68289 12.0124 0.365212 11.6947C0.0475336 11.3771 0.0475336 10.862 0.365212 10.5443L4.90935 6.00019L0.365212 1.45605Z" fill="#2580D3" />
            </svg>
        </a>
    </div>
</div>