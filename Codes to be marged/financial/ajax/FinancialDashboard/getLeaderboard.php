<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$currentYear = date('Y');
$currencyMonth = date('m');
$previousMonth = date('m', strtotime('-1 month'));

$companyId = mysqli_real_escape_string($connection, $_POST['companyId']);
$breakdownId = mysqli_real_escape_string($connection, $_POST['breakdownId']);
$currencyFocus = mysqli_real_escape_string($connection, $_POST['currencyId']);

$sql_current_month = "SELECT 
        a.branchId,
        a.branchName,
        a.currency_default,
        (
            SELECT SUM(f.actual_amount)
            FROM tbl_branch_pl_account_code e
            LEFT JOIN tbl_branch_pl_data f ON e.account_id = f.account_id
            WHERE e.breakdown_id = '$breakdownId' 
            AND f.month = '$currencyMonth' 
            AND f.year = '$currentYear' 
            AND e.branchId = a.branchId
        ) AS sumCurrentMonth,
        (
            SELECT SUM(f.actual_amount)
            FROM tbl_branch_pl_account_code e
            LEFT JOIN tbl_branch_pl_data f ON e.account_id = f.account_id
            WHERE e.breakdown_id = '$breakdownId' 
            AND f.month = '$previousMonth' 
            AND f.year = '$currentYear' 
            AND e.branchId = a.branchId
        ) AS sumPreviousMonth
    FROM branch a
    WHERE a.companyId = '$companyId' AND a.status = 1 AND a.financial_start_month IS NOT NULL
    GROUP BY a.branchId
    ORDER BY sumCurrentMonth DESC LIMIT 8 ;";
$res_current_month = mysqli_query($connection, $sql_current_month);
$row_current_month = mysqli_fetch_all($res_current_month, MYSQLI_ASSOC);

?>
<div class="row">
    <?php

    $listOrder = 0;
    foreach ($row_current_month as $keyCurrencyMonth => $currencyMonth) {
        if ($listOrder == 4) {
            $listOrder = 0;
        }
        $listOrder++;

        if ($listOrder == 1) {
            echo '<div class="col-lg-6 col-12 mb-3">
                <table class="table dd-table-Leaderboard fs-12 mb-0">';
        }

        $branchId = $currencyMonth['branchId'];
        $branchName = $currencyMonth['branchName'];
        $currencyDefault = $currencyMonth['currency_default'];
        $sumCurrentMonth = $currencyMonth['sumCurrentMonth'];
        $sumPreviousMonth = $currencyMonth['sumPreviousMonth'];

    ?>
        <tr>
            <td>
                <?php if (round((float)$sumCurrentMonth, 1) == round((float)$sumPreviousMonth, 1)) { ?>
                    <span class='dd-badge blue'>
                        <svg viewBox='0 0 13 13' width='13' height='13' stroke='currentColor' stroke-width='2.7' stroke-linecap='round' fill='none' xmlns='http://www.w3.org/2000/svg'>
                            <path d='M3.5 6.5H9.5' />
                        </svg>
                        <?php echo $listOrder; ?>
                    </span>
                <?php  } else if (($sumCurrentMonth - $sumPreviousMonth) > 0) { ?>
                    <span class='dd-badge green'>
                        <svg viewBox='0 0 13 13' width='13' height='13' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                            <path d='M10.1 5.6a.982.982 0 0 0 0-1.59L7.28 1.21a.982.982 0 0 0-1.59 0L2.89 4.03a.982.982 0 0 0 1.59 1.59l.9-.9.02 6.28a.982.982 0 1 0 1.96 0L7.62 4.72l.89.89a.982.982 0 0 0 1.59 0Z' />
                        </svg>
                        <?php echo $listOrder; ?>
                    </span>
                <?php } else if (($sumCurrentMonth - $sumPreviousMonth) < 0) { ?>
                    <span class='dd-badge red'>
                        <svg viewBox='0 0 13 13' width='13' height='13' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                            <path d='M3.5 7.24a.75.75 0 0 0 0 1.06l2.34 2.34a.75.75 0 0 0 1.06 0l2.34-2.34a.75.75 0 1 0-1.06-1.06L7.44 7.99V2.75a.75.75 0 1 0-1.5 0v5.23L4.82 7.24a.75.75 0 0 0-1.06 0Z' />
                        </svg>
                        <?php echo $listOrder; ?>
                    </span>
                <?php } else { ?>
                    <span class='dd-badge blue'>
                        <svg viewBox='0 0 13 13' width='13' height='13' stroke='currentColor' stroke-width='2.7' stroke-linecap='round' fill='none' xmlns='http://www.w3.org/2000/svg'>
                            <path d='M3.5 6.5H9.5' />
                        </svg>
                        <?php echo $listOrder; ?>
                    </span>
                <?php  } ?>
            </td>
            <td class="fs-14 fw-200"><?php echo truncateText($branchName, 25); ?></td>
            <td class="text-end"><?php echo formatNumber(changeCurrencyValue($currencyDefault, $currencyFocus, $sumCurrentMonth)); ?></td>
        </tr>
    <?php
        if ($listOrder == 4) {
            echo '</table>
                </div>';
            $listOrder = 0;
        }
    }
    ?>
</div>