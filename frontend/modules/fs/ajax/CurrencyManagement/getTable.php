<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$page = mysqli_real_escape_string($connection, $_POST['page'] ?? '1');
$limit = (intval($page) - 1) * 10;
$filter = mysqli_real_escape_string($connection, $_POST['filter'] ?? '1');
$searchText = mysqli_real_escape_string($connection, $_POST['searchText'] ?? '');

$condition = "";

if ($searchText != '') {
    $condition = " AND a.currencyName LIKE '%$searchText%' ";
}

if ($filter == '1') {
    $condition .= " ORDER BY a.currencyName ASC ";
} else {
    $condition .= " ORDER BY a.currencyName DESC ";
}

$sql = "SELECT a.*,b.countryName,b.flag FROM tbl_currency a
LEFT JOIN country b ON a.countryId = b.countryId $condition LIMIT 0,9 ;";
$res = mysqli_query($connection, $sql)  or die($connection->error);

?>

<li class="table-header">
    <div class="col col-name">Currency Name</div>
    <div class="col col-data">Currency Code</div>
    <div class="col col-data">Currency Sign</div>
    <div class="col col-data">Country</div>
    <div class="col col-data">Dollar Unit</div>
    <div class="col col-data">Exchange Rate</div>
    <div class="col col-data">Source</div>
    <div class="col col-data">Last Updated</div>
    <div class="col col-data"><button class="btn btn-light btn-sm border text-primary px-2" style="border-radius: 16px;" onclick="updateAllCurrency();"><i class="bi bi-funnel"></i> Refresh</button></div>
</li>

<?php
while ($row = mysqli_fetch_assoc($res)) {
?>

    <li class="table-row">
        <div class="col col-name"><?php echo $row['currencyName']; ?></div>
        <div class="col col-data"><?php echo $row['currencyCode']; ?></div>
        <div class="col col-data"><?php echo $row['currencySymbol']; ?></div>
        <div class="col col-data text-start ps-3">
            <img style="box-shadow: none;" src="<?php echo $row['flag'] == '' ? '/fs/images/no-img.png' : 'https://tcg-hrvc-system.com/' . $row['flag']; ?>" alt="" class="flag">
            <?php echo $row['countryName']; ?>
        </div>
        <div class="col col-data">$1.0</div>
        <div class="col col-data"><?php echo $row['currencySymbol'] . ' ' . number_format($row['exchangeRate'], 4); ?></div>
        <div class="col col-data"><?php echo $row['source'] == 1 ? 'API' : 'Manaul'; ?></div>
        <div class="col col-data" id="updateTime_<?php echo $row['currencyId']; ?>"><?php echo date("M d, Y", strtotime($row['update_datetime'])); ?></div>
        <div class="col col-data d-flex justify-content-center align-items-center">
            <button class="btn btn-light btn-sm border d-flex justify-content-center align-items-center" onclick="getModalCurrency('<?php echo $row['currencyId']; ?>');" style="width:82px;height:24px;">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-1">
                    <path d="M14.4128 4.12715L7.77558 10.7763C7.11464 11.4384 5.15268 11.7451 4.71437 11.306C4.27607 10.8669 4.57523 8.90143 5.23617 8.2393L11.8803 1.58316C12.0442 1.40407 12.2425 1.26012 12.4635 1.15996C12.6844 1.05981 12.9233 1.00551 13.1658 1.0004C13.4082 0.995289 13.6491 1.03944 13.8741 1.13019C14.099 1.22094 14.3033 1.35644 14.4745 1.52845C14.6457 1.70047 14.7804 1.90545 14.8704 2.13103C14.9603 2.35662 15.0038 2.59813 14.998 2.84099C14.9922 3.08385 14.9374 3.32305 14.8368 3.54409C14.7362 3.76514 14.592 3.9635 14.4128 4.12715Z" stroke="#393939" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M7.26151 2.45459H3.78289C3.04482 2.45459 2.33703 2.74831 1.81513 3.27115C1.29324 3.79399 1 4.5031 1 5.24251V12.2123C1 12.9517 1.29324 13.6608 1.81513 14.1836C2.33703 14.7065 3.04482 15.0002 3.78289 15.0002H11.4358C12.9734 15.0002 13.523 13.7457 13.523 12.2123V8.72741" stroke="#393939" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                Modify
            </button>
        </div>
    </li>

<?php } ?>