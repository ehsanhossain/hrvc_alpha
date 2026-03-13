<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$sql_count = "SELECT COUNT(a.currencyId) AS count FROM tbl_currency a ;";
$res_count = mysqli_query($connection, $sql_count);
$row_count = mysqli_fetch_assoc($res_count);
$count = $row_count['count'];

$sql = "SELECT a.*,b.countryName,b.flag FROM tbl_currency a
    LEFT JOIN country b ON a.countryId = b.countryId 
    ORDER BY RAND() LIMIT 8 ;";
$res = mysqli_query($connection, $sql);

$list = 0;
?>
<div class="row d-lg-table d-flex w-100 m-0">
    <div class="col-lg-auto col-12 mb-3 d-lg-table-cell d-block pe-0">
        <div class="currency-table">
            <?php while ($row = mysqli_fetch_assoc($res)) {
                $list++;
                if ($list == 1) { ?>
                    <div class="currency-row">
                    <?php  } ?>

                    <div class="currency-item">
                        <img style="box-shadow: none;" src="https://tcg-hrvc-system.com/<?php echo $row['flag']; ?>" alt="<?php echo $row['countryName']; ?>" class="flag"> <?php echo $row['currencySymbol'] . " " . $row['currencyCode']; ?>
                    </div>

                    <?php if ($list == 2) {
                        $list = 0;
                    ?>
                    </div>
                <?php } ?>

            <?php } ?>
        </div>
    </div>
    <div class="col-lg-auto col-12 mb-3 d-lg-table-cell d-block align-middle p-0">
        <div class="" style="width:130px">
            <div class="text-center fs-32">
                <?php echo number_format($count); ?>
            </div>
            <div class="text-center">Registered<br>Currency</div>
        </div>
    </div>
</div>