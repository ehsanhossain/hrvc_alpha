<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$condition = "";

$current_page = mysqli_real_escape_string($connection, $_POST['page']);
$limit = (intval($current_page) - 1) * 6;
$companyId = mysqli_real_escape_string($connection, $_POST['companyId']);
$searchText = mysqli_real_escape_string($connection, $_POST['searchText']);
$filterStatus = mysqli_real_escape_string($connection, $_POST['filterStatus']);

$ly_done = mysqli_real_escape_string($connection, $_POST['ly_done']);
$ly_progress = mysqli_real_escape_string($connection, $_POST['ly_progress']);
$ly_yet = mysqli_real_escape_string($connection, $_POST['ly_yet']);

$cp_done = mysqli_real_escape_string($connection, $_POST['cp_done']);
$cp_progress = mysqli_real_escape_string($connection, $_POST['cp_progress']);
$cp_yet = mysqli_real_escape_string($connection, $_POST['cp_yet']);

$cpt_done = mysqli_real_escape_string($connection, $_POST['cpt_done']);
$cpt_progress = mysqli_real_escape_string($connection, $_POST['cpt_progress']);
$cpt_yet = mysqli_real_escape_string($connection, $_POST['cpt_yet']);

$nt_done = mysqli_real_escape_string($connection, $_POST['nt_done']);
$nt_progress = mysqli_real_escape_string($connection, $_POST['nt_progress']);
$nt_yet = mysqli_real_escape_string($connection, $_POST['nt_yet']);

if ($searchText != '') {
    $condition = " AND a.branchName LIKE '%$searchText%' ";
}

$arrayData = array();

$sql_branch = "SELECT a.*,b.*,c.countryName,c.flag,
    (
        SELECT 
            CASE
                    WHEN n.month < a.financial_start_month THEN n.year - 1
                    ELSE n.year
            END AS last_year
        FROM tbl_branch_pl_account_code m
        LEFT JOIN tbl_branch_pl_data n ON m.account_id = n.account_id
        WHERE m.branchId = a.branchId
        ORDER BY n.year DESC, n.month DESC
        LIMIT 1
    ) AS financial_year
    FROM branch a 
    LEFT JOIN company b ON a.companyId = b.companyId
    LEFT JOIN country c ON b.countryId = c.countryId
    WHERE a.companyId = '$companyId' AND a.status = 1 AND a.financial_start_month IS NOT NULL $condition";
$res_branch = mysqli_query($connection, $sql_branch) or die($connection->error);
$rows_branch = mysqli_fetch_all($res_branch, MYSQLI_ASSOC);



foreach ($rows_branch as $row) {
    $branchId = $row['branchId'];
    $start_month = $row['financial_start_month'];
    $start_year = $row['financial_year'];

    if ($start_year != '') {
        if ($start_month == '1') {
            $end_month = '12';
            $end_year = $start_year;
        } else if ($start_month == '12') {
            $end_month = '1';
            $end_year = $start_year + 1;
        } else {
            $end_month = intval($start_month) - 1;
            $end_year = $start_year + 1;
        }

        $sql_status = "SELECT
                COUNT(DISTINCT bpd.account_id) AS count_account,
                COUNT(bpd.actual_amount) AS count_actual_amount,
                COUNT(bpd.target_amount) AS count_target_amount,
                COUNT(bpd.next_target_amount) AS count_next_target_amount,
                COUNT(bpd.last_year_target) AS count_last_year_target_amount
                FROM
                    tbl_branch_pl_account_code bac
                    JOIN (
                        SELECT
                            bpd_inner.account_id,
                            bpd_inner.actual_amount,
                            bpd_inner.target_amount,
                            bpd_inner.next_target_amount,
                            (
                                SELECT
                                    bpd_prev.actual_amount
                                FROM
                                    tbl_branch_pl_data bpd_prev
                                WHERE
                                    bpd_prev.account_id = bpd_inner.account_id
                                    AND bpd_prev.year = bpd_inner.year - 1
                                    AND bpd_prev.month = bpd_inner.month
                                LIMIT
                                    1
                            ) AS last_year_target
                        FROM
                            tbl_branch_pl_data bpd_inner
                        WHERE
                            (
                                bpd_inner.year = '$start_year'
                                AND bpd_inner.month >= '$start_month'
                            )
                            OR (
                                bpd_inner.year = '$end_year'
                                AND bpd_inner.month <= '$end_month'
                            )
                    ) bpd ON bpd.account_id = bac.account_id
                WHERE
                    bac.branchId = '$branchId';
                ";
        $res_status = mysqli_query($connection, $sql_status);
        $row_status = mysqli_fetch_assoc($res_status);

        $count_account = intval($row_status['count_account']) * 12; // Convert to total months
        $count_last_year_target_amount = intval($row_status['count_last_year_target_amount']);
        $count_actual_amount = intval($row_status['count_actual_amount']);
        $count_target_amount = intval($row_status['count_target_amount']);
        $count_next_target_amount = intval($row_status['count_next_target_amount']);

        // Evaluate last year status
        if ($count_account == $count_last_year_target_amount) {
            $last_year_status = 1; // Done
        } elseif ($count_last_year_target_amount == 0) {
            $last_year_status = 0; // Not yet
        } else {
            $last_year_status = 2; // In progress
        }

        // Evaluate actual amount status
        if ($count_account == $count_actual_amount) {
            $actual_status = 1; // Done
        } elseif ($count_actual_amount == 0) {
            $actual_status = 0; // Not yet
        } else {
            $actual_status = 2; // In progress
        }

        // Evaluate target amount status
        if ($count_account == $count_target_amount) {
            $target_status = 1; // Done
        } elseif ($count_target_amount == 0) {
            $target_status = 0; // Not yet
        } else {
            $target_status = 2; // In progress
        }

        // Evaluate next target amount status
        if ($count_account == $count_next_target_amount) {
            $next_target_status = 1; // Done
        } elseif ($count_next_target_amount == 0) {
            $next_target_status = 0; // Not yet
        } else {
            $next_target_status = 2; // In progress
        }

        if ($filterStatus == 0) {
            $arrayData[] = array(
                "branchId" => $branchId,
                "branchImage" => $row['branchImage'],
                "branchName" => $row['branchName'],
                "flag" => $row['flag'],
                "countryName" => $row['countryName'],
                "city" => $row['city'],
                "start_month" => $row['financial_start_month'],
                "start_year" => $row['financial_year'],
                "count_account" => $count_account,
                "last_year_status" => $last_year_status,
                "actual_status" => $actual_status,
                "target_status" => $target_status,
                "next_target_status" => $next_target_status,
            );
        } else {
            if (
                (
                    $last_year_status == $ly_done ||
                    $last_year_status == $ly_progress ||
                    $last_year_status == $ly_yet
                ) &&
                (
                    $actual_status == $cp_done ||
                    $actual_status == $cp_progress ||
                    $actual_status == $cp_yet
                ) &&
                (
                    $target_status == $cpt_done ||
                    $target_status == $cpt_progress ||
                    $target_status == $cpt_yet
                ) &&
                (
                    $next_target_status == $nt_done ||
                    $next_target_status == $nt_progress ||
                    $next_target_status == $nt_yet
                )
            ) {
                $arrayData[] = array(
                    "branchId" => $branchId,
                    "branchImage" => $row['branchImage'],
                    "branchName" => $row['branchName'],
                    "flag" => $row['flag'],
                    "countryName" => $row['countryName'],
                    "city" => $row['city'],
                    "start_month" => $row['financial_start_month'],
                    "start_year" => $row['financial_year'],
                    "count_account" => $count_account,
                    "last_year_status" => $last_year_status,
                    "actual_status" => $actual_status,
                    "target_status" => $target_status,
                    "next_target_status" => $next_target_status,
                );
            }

            // echo "<pre>";
            // echo 'last_year_status ' . $last_year_status . ' = ' . $ly_done . ', ' . $ly_progress . ', ' . $ly_yet;
            // echo '<br>actual_status ' . $actual_status . ' = ' . $cp_done . ', ' . $cp_progress . ', ' . $cp_yet;
            // echo '<br>target_status ' . $target_status . ' = ' . $cpt_done . ', ' . $cpt_progress . ', ' . $cpt_yet;
            // echo '<br>next_target_status ' . $next_target_status . ' = ' . $nt_done . ', ' . $nt_progress . ', ' . $nt_yet;
            // echo "</pre>";
        }
    } else {
        if ($filterStatus == 0) {
            $arrayData[] = array(
                "branchId" => $branchId,
                "branchImage" => $row['branchImage'],
                "branchName" => $row['branchName'],
                "flag" => $row['flag'],
                "countryName" => $row['countryName'],
                "city" => $row['city'],
                "start_month" => $row['financial_start_month'],
                "start_year" => $row['financial_year'],
            );
        }
    }
}

$num_row = count($arrayData);

$total_page = ceil($num_row / 6);

$limit = (intval($current_page) - 1) * 6;

foreach ($arrayData as $key => $rowData) {
    if (($key >= $limit) && ($key <= ($limit + 5))) {
?>
        <div class="col-lg-4 col-12 mb-3">
            <div class="card bg-light">
                <div class="card-body ">
                    <div class="d-flex align-items-center mb-3 justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="me-2"><img src="https://tcg-hrvc-system.com/<?php echo $rowData['branchImage']; ?>" alt="" class="dd-circle"></div>
                            <div>
                                <div class="fs-16 fw-500"><?php echo truncateText($rowData['branchName'], 30); ?></div>
                                <div class="d-flex align-items-center">
                                    <img src="https://tcg-hrvc-system.com/<?php echo $rowData['flag']; ?>" alt="" class="dd-flag me-1">
                                    <div class="fw-400 fs-12"><?php echo $rowData['countryName']; ?>,<?php echo $rowData['city']; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="fw-600 fs-16"><?php echo $rowData['start_year'] == '' ? '' : 'FY ' . $rowData['start_year']; ?></div>
                    </div>
                    <div class="row d-lg-table d-flex w-100">
                        <div class="col-lg-9 col-12 mb-3 mb-lg-0 d-lg-table-cell d-block">
                            <div class="rounded bg-white p-3">
                                <strong class="fs-16 fw-600">Data Status</strong>
                                <table class="table fs-14 fw-500 mt-2">
                                    <tr>
                                        <td>Last Year's Performance</td>
                                        <td class="text-end">
                                            <?php echo $rowData['start_year'] == '' ? '' : getStatusBadge($rowData['last_year_status']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Current Progress</td>
                                        <td class="text-end">
                                            <?php echo $rowData['start_year'] == '' ? '' : getStatusBadge($rowData['actual_status']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Current Year Target</td>
                                        <td class="text-end">
                                            <?php echo $rowData['start_year'] == '' ? '' : getStatusBadge($rowData['target_status']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Next Year’s Target</td>
                                        <td class="text-end">
                                            <?php echo $rowData['start_year'] == '' ? '' : getStatusBadge($rowData['next_target_status']); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12 mb-3 mb-lg-0 d-lg-table-cell d-block align-bottom px-0">
                            <!-- <div class="mb-2 fs-14"><a href="FinancialHistory?id=<?php echo $rowData['branchId']; ?>" class="text-primary link-underline-primary"><i class="bi bi-clock-history"></i> History</a></div> -->
                            <!-- <div class="mb-2 fs-14"><a href="FinancialConfiguration?id=<?php echo $rowData['branchId']; ?>" class="text-primary link-underline-primary"><i class="bi bi-gear"></i> Configuration</a></div> -->
                            <!-- <div class="mb-2 fs-14"><a href="FinancialProfitLossPortal?id=<?php echo $rowData['branchId']; ?>" class="text-primary link-underline-primary"><i class="bi bi-coin"></i> P&L Forecast</a></div> -->
                            <!-- <div class="mb-2 fs-14"><a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteFinanceConfig"><i class="bi bi-trash"></i> Delete</a></div> -->
                            <!-- <div class="mb-2 fs-14"><a class="text-danger link-underline-danger" style="cursor: pointer;" onclick="deleteBranch('<?php echo $rowData['branchId']; ?>')"><i class="bi bi-trash"></i> Delete</a></div> -->


                            <div class="mb-2 fs-14">
                                <span class="text-primary">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.50195 16.6479C4.10195 16.6479 0.501953 13.0479 0.501953 8.64795H1.83529C1.83529 12.3146 4.83529 15.3146 8.50195 15.3146C12.1686 15.3146 15.1686 12.3146 15.1686 8.64795C15.1686 4.98128 12.1686 1.98128 8.50195 1.98128C6.10195 1.98128 3.90195 3.24795 2.70195 5.31462H5.83529V6.64795H0.501953V1.31462H1.83529V4.24795C3.30195 2.04795 5.83529 0.647949 8.50195 0.647949C12.902 0.647949 16.502 4.24795 16.502 8.64795C16.502 13.0479 12.902 16.6479 8.50195 16.6479ZM10.702 12.5146L7.83529 9.58128V4.64795H9.16862V9.04795L11.6353 11.5813L10.702 12.5146Z" fill="#2580D3" />
                                    </svg>
                                    <a href="FinancialHistory?id=<?php echo $rowData['branchId']; ?>">History</a>
                                </span>
                            </div>
                            <div class="mb-2 fs-14">
                                <span class="text-primary">
                                    <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.69987 5.98047C7.17245 5.98047 6.65688 6.13687 6.21835 6.42988C5.77982 6.7229 5.43803 7.13938 5.23619 7.62665C5.03436 8.11392 4.98155 8.65009 5.08444 9.16738C5.18734 9.68466 5.44131 10.1598 5.81425 10.5328C6.18719 10.9057 6.66235 11.1597 7.17963 11.2626C7.69691 11.3655 8.23309 11.3126 8.72036 11.1108C9.20763 10.909 9.62411 10.5672 9.91712 10.1287C10.2101 9.69012 10.3665 9.17455 10.3665 8.64714C10.3665 7.93989 10.0856 7.26161 9.58549 6.76152C9.08539 6.26142 8.40712 5.98047 7.69987 5.98047ZM7.69987 9.98047C7.43616 9.98047 7.17838 9.90227 6.95911 9.75576C6.73985 9.60925 6.56895 9.40101 6.46803 9.15738C6.36711 8.91374 6.34071 8.64566 6.39216 8.38701C6.4436 8.12837 6.57059 7.8908 6.75706 7.70433C6.94353 7.51786 7.18111 7.39087 7.43975 7.33942C7.69839 7.28797 7.96648 7.31438 8.21012 7.4153C8.45375 7.51621 8.66199 7.68711 8.8085 7.90638C8.95501 8.12564 9.0332 8.38343 9.0332 8.64714C9.0332 9.00076 8.89273 9.3399 8.64268 9.58994C8.39263 9.83999 8.05349 9.98047 7.69987 9.98047Z" fill="#2580D3" />
                                        <path d="M13.8957 9.91462L13.5997 9.74395C13.733 9.01891 13.733 8.27565 13.5997 7.55062L13.8957 7.37995C14.1234 7.24863 14.3229 7.07376 14.4829 6.86532C14.643 6.65689 14.7604 6.41897 14.8285 6.16516C14.8966 5.91135 14.914 5.64661 14.8798 5.38605C14.8456 5.1255 14.7604 4.87424 14.6291 4.64662C14.4977 4.41899 14.3229 4.21946 14.1144 4.05942C13.906 3.89938 13.6681 3.78195 13.4143 3.71386C13.1605 3.64576 12.8957 3.62832 12.6352 3.66254C12.3746 3.69676 12.1234 3.78196 11.8957 3.91328L11.5991 4.08462C11.0388 3.6059 10.3948 3.23478 9.69973 2.98995V2.64795C9.69973 2.11752 9.48902 1.60881 9.11395 1.23374C8.73888 0.858663 8.23017 0.647949 7.69973 0.647949C7.1693 0.647949 6.66059 0.858663 6.28552 1.23374C5.91045 1.60881 5.69973 2.11752 5.69973 2.64795V2.98995C5.00466 3.23566 4.36097 3.60768 3.80107 4.08728L3.50307 3.91462C3.04336 3.6494 2.49712 3.57766 1.98452 3.71519C1.47192 3.85272 1.03495 4.18824 0.769736 4.64795C0.504519 5.10766 0.432784 5.6539 0.57031 6.16649C0.707837 6.67909 1.04336 7.11607 1.50307 7.38128L1.79907 7.55195C1.66581 8.27699 1.66581 9.02024 1.79907 9.74528L1.50307 9.91595C1.04336 10.1812 0.707837 10.6181 0.57031 11.1307C0.432784 11.6433 0.504519 12.1896 0.769736 12.6493C1.03495 13.109 1.47192 13.4445 1.98452 13.582C2.49712 13.7196 3.04336 13.6478 3.50307 13.3826L3.79974 13.2113C4.36024 13.6901 5.00439 14.0612 5.69973 14.306V14.6479C5.69973 15.1784 5.91045 15.6871 6.28552 16.0622C6.66059 16.4372 7.1693 16.6479 7.69973 16.6479C8.23017 16.6479 8.73888 16.4372 9.11395 16.0622C9.48902 15.6871 9.69973 15.1784 9.69973 14.6479V14.306C10.3948 14.0602 11.0385 13.6882 11.5984 13.2086L11.8964 13.3806C12.3561 13.6458 12.9023 13.7176 13.4149 13.58C13.9275 13.4425 14.3645 13.107 14.6297 12.6473C14.8949 12.1876 14.9667 11.6413 14.8292 11.1287C14.6916 10.6161 14.3561 10.1792 13.8964 9.91395L13.8957 9.91462ZM12.1971 7.39728C12.4228 8.21533 12.4228 9.07924 12.1971 9.89728C12.1576 10.0397 12.1666 10.1911 12.2226 10.3278C12.2786 10.4645 12.3784 10.5788 12.5064 10.6526L13.2291 11.07C13.3823 11.1584 13.4941 11.304 13.5399 11.4748C13.5857 11.6457 13.5618 11.8277 13.4734 11.9809C13.385 12.1342 13.2393 12.246 13.0685 12.2918C12.8977 12.3376 12.7156 12.3137 12.5624 12.2253L11.8384 11.8066C11.7103 11.7324 11.5612 11.703 11.4146 11.7229C11.2679 11.7428 11.1321 11.811 11.0284 11.9166C10.435 12.5224 9.68745 12.9546 8.8664 13.1666C8.72309 13.2035 8.59611 13.2869 8.50546 13.4039C8.41482 13.5209 8.36566 13.6646 8.36573 13.8126V14.6479C8.36573 14.8248 8.2955 14.9943 8.17047 15.1194C8.04545 15.2444 7.87588 15.3146 7.69907 15.3146C7.52226 15.3146 7.35269 15.2444 7.22766 15.1194C7.10264 14.9943 7.0324 14.8248 7.0324 14.6479V13.8133C7.03247 13.6653 6.98332 13.5215 6.89267 13.4046C6.80203 13.2876 6.67505 13.2041 6.53173 13.1673C5.71063 12.9544 4.96329 12.5213 4.3704 11.9146C4.26675 11.809 4.13089 11.7408 3.98424 11.7209C3.83758 11.701 3.68847 11.7304 3.5604 11.8046L2.83773 12.2226C2.76189 12.2671 2.67799 12.2961 2.59089 12.308C2.50378 12.3199 2.41517 12.3145 2.33017 12.292C2.24517 12.2695 2.16546 12.2305 2.09562 12.1771C2.02577 12.1237 1.96719 12.057 1.92323 11.9808C1.87927 11.9047 1.8508 11.8206 1.83947 11.7334C1.82813 11.6462 1.83416 11.5577 1.8572 11.4728C1.88023 11.388 1.91982 11.3085 1.97369 11.239C2.02756 11.1695 2.09464 11.1114 2.17107 11.068L2.89374 10.6506C3.0217 10.5768 3.12152 10.4625 3.17751 10.3258C3.2335 10.1891 3.24249 10.0377 3.20307 9.89528C2.97731 9.07724 2.97731 8.21333 3.20307 7.39528C3.24178 7.2532 3.23236 7.10231 3.17628 6.96614C3.1202 6.82998 3.02061 6.71622 2.89307 6.64262L2.1704 6.22528C2.0172 6.13688 1.90538 5.99123 1.85956 5.82039C1.81374 5.64954 1.83766 5.46749 1.92607 5.31428C2.01447 5.16108 2.16012 5.04926 2.33097 5.00344C2.50181 4.95762 2.68386 4.98154 2.83707 5.06995L3.56107 5.48862C3.68879 5.56296 3.83759 5.59276 3.98409 5.57333C4.13058 5.5539 4.26647 5.48635 4.3704 5.38128C4.96379 4.77551 5.71135 4.3433 6.5324 4.13128C6.67616 4.09433 6.80347 4.01045 6.89416 3.89295C6.98485 3.77545 7.03373 3.63104 7.03307 3.48262V2.64795C7.03307 2.47114 7.10331 2.30157 7.22833 2.17654C7.35335 2.05152 7.52292 1.98128 7.69973 1.98128C7.87655 1.98128 8.04611 2.05152 8.17114 2.17654C8.29616 2.30157 8.3664 2.47114 8.3664 2.64795V3.48262C8.36633 3.63059 8.41549 3.77438 8.50613 3.89134C8.59678 4.00829 8.72376 4.09177 8.86707 4.12862C9.68841 4.34138 10.436 4.77454 11.0291 5.38128C11.1327 5.48693 11.2686 5.55508 11.4152 5.57499C11.5619 5.59491 11.711 5.56546 11.8391 5.49128L12.5617 5.07328C12.6376 5.02882 12.7215 4.99979 12.8086 4.98788C12.8957 4.97597 12.9843 4.98141 13.0693 5.00388C13.1543 5.02636 13.234 5.06542 13.3039 5.11882C13.3737 5.17223 13.4323 5.23892 13.4762 5.31506C13.5202 5.3912 13.5487 5.47529 13.56 5.56248C13.5713 5.64966 13.5653 5.73823 13.5423 5.82308C13.5192 5.90793 13.4796 5.98738 13.4258 6.05687C13.3719 6.12635 13.3048 6.18449 13.2284 6.22795L12.5057 6.64528C12.3784 6.71909 12.2791 6.83293 12.2233 6.96908C12.1675 7.10522 12.1582 7.25535 12.1971 7.39728Z" fill="#2580D3" />
                                    </svg>
                                    <a href="FinancialConfiguration?id=<?php echo $rowData['branchId']; ?>">Configuration</a>
                                </span>
                            </div>
                            <div class="mb-2 fs-14">
                                <span class="text-primary">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.39973 15.2711L2.87656 15.2688L5.24556 12.894C5.37474 12.7645 5.44663 12.59 5.44663 12.4064C5.44663 12.224 5.37474 12.0483 5.24556 11.9188C5.11638 11.7894 4.94228 11.7173 4.75918 11.7173C4.57721 11.7173 4.40198 11.7894 4.2728 11.9188L1.88583 14.3117L1.87572 12.7893C1.87348 12.6069 1.80046 12.4323 1.67016 12.304C1.53986 12.1756 1.36575 12.1046 1.18266 12.1069C1.00069 12.108 0.826581 12.1823 0.698527 12.3118C0.57272 12.4402 0.501953 12.6159 0.501953 12.7983L0.523295 15.9591C0.524419 16.1404 0.597432 16.3149 0.725486 16.4422C0.853539 16.5705 1.02765 16.6426 1.20962 16.6426L4.39748 16.6482C4.48735 16.6482 4.57721 16.6302 4.66033 16.5964C4.74345 16.5615 4.81984 16.5109 4.88386 16.4478C4.94789 16.3836 4.99844 16.3082 5.03326 16.2248C5.06808 16.1415 5.08605 16.0514 5.08605 15.9614C5.08605 15.8713 5.06808 15.7812 5.03438 15.6979C4.99956 15.6145 4.94901 15.538 4.88611 15.4738C4.82321 15.4096 4.74682 15.3589 4.6637 15.324C4.58058 15.2891 4.49072 15.2711 4.40085 15.2711H4.39973Z" fill="#2580D3" />
                                        <path d="M16.5 4.5542L16.4955 1.35848C16.4955 1.17719 16.4237 1.00265 16.2956 0.873158C16.1675 0.744789 15.9946 0.671596 15.8126 0.67047L12.6595 0.647949C12.5697 0.647949 12.4798 0.663714 12.3956 0.698621C12.3113 0.732403 12.2349 0.783075 12.1709 0.846133C12.1069 0.909192 12.0552 0.985763 12.0204 1.06909C11.9856 1.15242 11.9665 1.2425 11.9665 1.33258C11.9665 1.42379 11.9833 1.51275 12.017 1.59721C12.0507 1.68166 12.1013 1.7571 12.1642 1.82241C12.2282 1.8866 12.3035 1.9384 12.3866 1.9733C12.4697 2.00821 12.5596 2.02736 12.6494 2.02736L14.1681 2.03749L11.7811 4.43034C11.652 4.55983 11.5801 4.73437 11.5801 4.91791C11.5801 5.10033 11.652 5.276 11.7811 5.40549C11.9103 5.53499 12.0844 5.60705 12.2675 5.60705C12.4495 5.60705 12.6247 5.53499 12.7539 5.40549L15.1229 3.03066L15.1251 4.55758C15.1251 4.64766 15.1431 4.73775 15.1779 4.82107C15.2128 4.9044 15.2633 4.98097 15.3273 5.04403C15.3914 5.10822 15.4677 5.15889 15.5509 5.19267C15.634 5.22758 15.7239 5.24447 15.8137 5.24447C15.9036 5.24447 15.9934 5.22645 16.0766 5.19154C16.1597 5.15664 16.2361 5.10596 16.299 5.04178C16.363 4.97759 16.4135 4.90102 16.4472 4.8177C16.4821 4.73437 16.4989 4.64428 16.4989 4.5542H16.5Z" fill="#2580D3" />
                                        <path d="M8.97776 8.02521C8.35659 7.81464 7.81068 7.66825 7.80955 7.34621V7.32481C7.80843 7.0996 8.01062 6.92732 8.40601 6.92506C8.84072 6.95434 9.26308 7.07595 9.64724 7.28202C9.73935 7.33269 9.84269 7.35747 9.94715 7.35521C10.0325 7.35634 10.1168 7.34058 10.1954 7.30905C10.274 7.27752 10.3459 7.2291 10.4066 7.16942C10.4672 7.10974 10.5144 7.03767 10.547 6.95885C10.5796 6.88002 10.5953 6.79557 10.5953 6.70999C10.5953 6.58162 10.5605 6.45663 10.4908 6.34853C10.4223 6.24043 10.3234 6.15485 10.2066 6.10193C9.89211 5.94766 9.56074 5.83393 9.21814 5.76186C9.21814 5.74835 9.22601 5.73709 9.22601 5.72245L9.22376 5.14816C9.22376 4.96574 9.15075 4.79121 9.02157 4.66284C8.89239 4.53447 8.71829 4.4624 8.53631 4.4624H8.53294C8.35097 4.4624 8.17574 4.53672 8.04769 4.66622C7.91963 4.79571 7.84774 4.97137 7.84887 5.15379L7.85111 5.72808C7.85111 5.72808 7.85336 5.73709 7.85336 5.74159C6.9817 5.93189 6.3403 6.54108 6.34592 7.50498V7.52637C6.35266 8.64116 7.26252 9.0105 8.06566 9.24134C8.69694 9.43052 9.25297 9.54537 9.25521 9.89895V9.92035C9.25634 10.1782 9.04404 10.3505 8.57338 10.3527C8.0196 10.3302 7.48268 10.1557 7.02101 9.84715C6.92329 9.79085 6.8132 9.76157 6.69975 9.7627C6.61551 9.7627 6.53126 9.77734 6.45263 9.80999C6.374 9.84265 6.30323 9.88994 6.2437 9.94962C6.18417 10.0104 6.13699 10.0814 6.10554 10.1602C6.07409 10.239 6.05948 10.3235 6.06061 10.4079C6.06061 10.5194 6.08981 10.6298 6.14485 10.7266C6.19989 10.8234 6.27852 10.9056 6.37512 10.9631C6.82781 11.2525 7.33441 11.4484 7.86459 11.5396V12.0125C7.86459 12.195 7.93648 12.3706 8.06566 12.5001C8.19484 12.6296 8.36895 12.7017 8.55204 12.7017C8.73513 12.7017 8.90924 12.6296 9.03842 12.5001C9.1676 12.3706 9.23949 12.1961 9.23949 12.0125V11.5216C10.1145 11.3268 10.7233 10.757 10.7166 9.73793V9.71653C10.711 8.66706 9.77866 8.28645 8.97552 8.02296L8.97776 8.02521Z" fill="#2580D3" />
                                        <path d="M3.1948 10.8836C2.74998 9.80597 2.63316 8.62025 2.86006 7.47618C3.08696 6.33212 3.64748 5.28152 4.47084 4.45613C5.29421 3.63074 6.34223 3.06997 7.48348 2.84138C8.62473 2.61392 9.80754 2.73103 10.8825 3.17694C11.2128 3.31432 11.5284 3.48098 11.825 3.67353L12.5551 2.9416C12.718 2.77832 12.691 2.50244 12.4944 2.3797C12.1574 2.17026 11.8047 1.98671 11.4374 1.83357C10.5478 1.46423 9.59412 1.27393 8.63147 1.27393C7.18132 1.27393 5.76374 1.7052 4.55734 2.51258C3.35093 3.31995 2.41187 4.46852 1.85697 5.81189C1.30207 7.15526 1.15717 8.63376 1.43911 10.0593C1.60199 10.8825 1.90415 11.6651 2.32763 12.379C2.48152 12.638 2.83984 12.6808 3.05214 12.4679L3.69017 11.8284C3.49808 11.53 3.33184 11.2147 3.1948 10.8836Z" fill="#2580D3" />
                                        <path d="M14.8887 4.7862C14.7146 4.50018 14.3158 4.45852 14.0788 4.69499L13.4857 5.28954C13.4992 5.30981 13.5138 5.32895 13.5273 5.34922C14.1743 6.31875 14.5191 7.45943 14.5191 8.62602C14.5169 10.1901 13.8968 11.6889 12.7938 12.7946C11.6907 13.9004 10.1956 14.522 8.6354 14.5242C7.47168 14.5242 6.3338 14.1785 5.36666 13.5299C5.34644 13.5164 5.32734 13.5018 5.30712 13.4883L4.71403 14.0828C4.47702 14.3204 4.5197 14.7202 4.80614 14.8947C5.54076 15.3451 6.35177 15.6649 7.20546 15.835C8.62753 16.1187 10.1024 15.9735 11.4425 15.4172C12.7825 14.8609 13.9283 13.9184 14.7337 12.7091C15.5391 11.4997 15.9693 10.0786 15.9693 8.62489C15.9693 7.65987 15.7795 6.70386 15.411 5.81203C15.2639 5.4562 15.0898 5.11275 14.8898 4.78507L14.8887 4.7862Z" fill="#2580D3" />
                                    </svg>
                                    <a href="FinancialProfitLossPortal?id=<?php echo $rowData['branchId']; ?>">P&L Forecast</a>
                                </span>
                            </div>
                            <div class="mb-2 fs-14">
                                <span class="text-danger" style="cursor: pointer;" onclick="deleteBranch('<?php echo $rowData['branchId']; ?>')">
                                    <svg width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.1686 3.3151H11.102C10.9472 2.56271 10.5378 1.88667 9.94279 1.40092C9.34774 0.915164 8.60342 0.649407 7.83529 0.648438L6.50195 0.648438C5.73382 0.649407 4.9895 0.915164 4.39445 1.40092C3.79941 1.88667 3.39002 2.56271 3.23529 3.3151H1.16862C0.991809 3.3151 0.822239 3.38534 0.697215 3.51037C0.572191 3.63539 0.501953 3.80496 0.501953 3.98177C0.501953 4.15858 0.572191 4.32815 0.697215 4.45318C0.822239 4.5782 0.991809 4.64844 1.16862 4.64844H1.83529V13.3151C1.83634 14.1988 2.18787 15.0461 2.81277 15.671C3.43766 16.2959 4.28489 16.6474 5.16862 16.6484H9.16862C10.0523 16.6474 10.8996 16.2959 11.5245 15.671C12.1494 15.0461 12.5009 14.1988 12.502 13.3151V4.64844H13.1686C13.3454 4.64844 13.515 4.5782 13.64 4.45318C13.765 4.32815 13.8353 4.15858 13.8353 3.98177C13.8353 3.80496 13.765 3.63539 13.64 3.51037C13.515 3.38534 13.3454 3.3151 13.1686 3.3151ZM6.50195 1.98177H7.83529C8.2488 1.98228 8.65204 2.11069 8.98969 2.3494C9.32735 2.58811 9.5829 2.92543 9.72129 3.3151H4.61595C4.75434 2.92543 5.00989 2.58811 5.34754 2.3494C5.6852 2.11069 6.08844 1.98228 6.50195 1.98177ZM11.1686 13.3151C11.1686 13.8455 10.9579 14.3542 10.5828 14.7293C10.2078 15.1044 9.69905 15.3151 9.16862 15.3151H5.16862C4.63819 15.3151 4.12948 15.1044 3.75441 14.7293C3.37933 14.3542 3.16862 13.8455 3.16862 13.3151V4.64844H11.1686V13.3151Z" fill="#DC3545" />
                                        <path d="M5.83366 12.6483C6.01047 12.6483 6.18004 12.578 6.30506 12.453C6.43009 12.328 6.50033 12.1584 6.50033 11.9816V7.98161C6.50033 7.8048 6.43009 7.63523 6.30506 7.5102C6.18004 7.38518 6.01047 7.31494 5.83366 7.31494C5.65685 7.31494 5.48728 7.38518 5.36225 7.5102C5.23723 7.63523 5.16699 7.8048 5.16699 7.98161V11.9816C5.16699 12.1584 5.23723 12.328 5.36225 12.453C5.48728 12.578 5.65685 12.6483 5.83366 12.6483Z" fill="#DC3545" />
                                        <path d="M8.49967 12.6483C8.67649 12.6483 8.84605 12.578 8.97108 12.453C9.0961 12.328 9.16634 12.1584 9.16634 11.9816V7.98161C9.16634 7.8048 9.0961 7.63523 8.97108 7.5102C8.84605 7.38518 8.67649 7.31494 8.49967 7.31494C8.32286 7.31494 8.15329 7.38518 8.02827 7.5102C7.90325 7.63523 7.83301 7.8048 7.83301 7.98161V11.9816C7.83301 12.1584 7.90325 12.328 8.02827 12.453C8.15329 12.578 8.32286 12.6483 8.49967 12.6483Z" fill="#DC3545" />
                                    </svg>
                                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#deleteFinanceConfig">Delete</a> -->
                                    <a style="text-decoration: underline; text-decoration-color: red;">Delete</a>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>

<div class="btn-toolbar justify-content-center" role="toolbar" aria-label="Toolbar with button groups" id="showButtonFooter">
    <div class="pagination">
        <a onclick="getData(<?php echo $current_page - 1; ?>)" class="previous <?php echo $current_page > 1 ? '' : 'disabled'; ?>"><i class="bi bi-chevron-left"></i> Previous</a>

        <?php if ($total_page <= 7) { ?>
            <?php for ($item = 1; $item <= $total_page; $item++) { ?>
                <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getData(<?php echo $item; ?>)"><?php echo $item; ?></a>
            <?php } ?>
        <?php } else if ($total_page == 8) { ?>
            <?php if ($current_page <= 4) { ?>
                <?php for ($item = 1; $item <= 4; $item++) { ?>
                    <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getData(<?php echo $item; ?>)"><?php echo $item; ?></a>
                <?php } ?>
                <span class="mx-2">...</span>
                <a class="" onclick="getData(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a>
            <?php } else { ?>
                <a class="" onclick="getData(1)">1</a>
                <span class="mx-2">...</span>
                <?php for ($item = 5; $item <= $total_page; $item++) { ?>
                    <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getData(<?php echo $item; ?>)"><?php echo $item; ?></a>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <?php if ($current_page <= 4) { ?>
                <?php for ($item = 1; $item <= 4; $item++) { ?>
                    <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getData(<?php echo $item; ?>)"><?php echo $item; ?></a>
                <?php } ?>
                <span class="mx-2">...</span>
                <a class="" onclick="getData(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a>
            <?php } else if ($current_page == 5) { ?>
                <a class="" onclick="getData(1)">1</a>
                <span class="mx-2">...</span>
                <?php for ($item = 4; $item <= 6; $item++) { ?>
                    <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getData(<?php echo $item; ?>)"><?php echo $item; ?></a>
                <?php } ?>
                <span class="mx-2">...</span>
                <a class="" onclick="getData(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a>
            <?php } else if ($current_page > 5 && $current_page < ($total_page - 3)) { ?>
                <a class="" onclick="getData(1)">1</a>
                <span class="mx-2">...</span>

                <a class="" onclick="getData(<?php echo ($current_page - 1); ?>)"><?php echo ($current_page - 1); ?></a>
                <a class="active" onclick="getData(<?php echo $current_page; ?>)"><?php echo $current_page; ?></a>
                <a class="" onclick="getData(<?php echo ($current_page + 1); ?>)"><?php echo ($current_page + 1); ?></a>

                <span class="mx-2">...</span>
                <a class="" onclick="getData(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a>
            <?php } else { ?>
                <a class="" onclick="getData(1)">1</a>
                <span class="mx-2">...</span>
                <?php for ($item = ($total_page - 3); $item <= $total_page; $item++) { ?>
                    <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getData(<?php echo $item; ?>)"><?php echo $item; ?></a>
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <a onclick="getData(<?php echo $current_page + 1; ?>)" class="next <?php echo $current_page < $total_page ? '' : 'disabled'; ?>">Next <i class="bi bi-chevron-right"></i></a>
    </div>
</div>