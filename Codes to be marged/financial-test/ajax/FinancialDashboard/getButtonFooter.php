<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$condition = "";

$current_page = mysqli_real_escape_string($connection, $_POST['page']);
$companyId = mysqli_real_escape_string($connection, $_POST['companyId']);
$searchText = mysqli_real_escape_string($connection, $_POST['searchText']);

if ($searchText != '') {
    $condition = " AND a.branchName LIKE '%$searchText%' ";
}

$sql_branch = "SELECT a.*,b.*,c.countryName,c.flag FROM branch a 
LEFT JOIN company b ON a.companyId = b.companyId
LEFT JOIN country c ON b.countryId = c.countryId
WHERE a.companyId = '$companyId' AND a.status = 1 $condition ;";
$res_branch = mysqli_query($connection, $sql_branch)  or die($connection->error);
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

<div class="pagination">
    <a onclick="getButtonFooter(<?php echo $current_page - 1; ?>)" class="previous <?php echo $current_page > 1 ? '' : 'disabled'; ?>"><i class="bi bi-chevron-left"></i> Previous</a>

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
    <a onclick="getButtonFooter(<?php echo $current_page + 1; ?>)" class="next <?php echo $current_page < $total_page ? '' : 'disabled'; ?>">Next <i class="bi bi-chevron-right"></i></a>
</div>