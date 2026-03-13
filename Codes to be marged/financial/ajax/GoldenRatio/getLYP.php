<?php
session_start();
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$rate = mysqli_real_escape_string($connection, $_POST['rate']);
$currencyFocus = mysqli_real_escape_string($connection, $_POST['currencyId']);
$start_year = intval(mysqli_real_escape_string($connection, $_POST['year'])) - 1;

$sql_currencyFocus = "SELECT currencySymbol FROM tbl_currency WHERE currencyId = 'currencyFocus' ";
$res_currencyFocus = mysqli_query($connection, $sql_currencyFocus) or die($connection->error);
$row_currencyFocus = mysqli_fetch_assoc($res_currencyFocus);
$currencySymbol = $row_currencyFocus['currencySymbol'];

$sql_select = "SELECT financial_start_month,currency_default FROM branch WHERE branchId = '$branchId' ";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
$row_select = mysqli_fetch_assoc($res_select);
$start_month = $row_select['financial_start_month'];
$currencyDefaul = $row_select['currency_default'];

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

$sql = "SELECT 
            '1' AS breakdown_id,
            SUM(a.actual_amount) AS actual_amount
        FROM tbl_branch_pl_data a
        LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id
        WHERE b.branchId = '$branchId' 
        AND b.breakdown_id = '1'
        AND (
            (a.month >= '$start_month' AND a.year = '$start_year') 
            OR 
            (a.month <= '$end_month' AND a.year = '$end_year')
        )

        UNION

        SELECT 
            '2' AS breakdown_id,
            SUM(a.actual_amount) AS actual_amount
        FROM tbl_branch_pl_data a
        LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id
        WHERE b.branchId = '$branchId' 
        AND b.breakdown_id = '2'
        AND (
            (a.month >= '$start_month' AND a.year = '$start_year') 
            OR 
            (a.month <= '$end_month' AND a.year = '$end_year')
        )

        UNION

        SELECT 
            '3' AS breakdown_id,
            SUM(a.actual_amount) AS actual_amount
        FROM tbl_branch_pl_data a
        LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id
        WHERE b.branchId = '$branchId' 
        AND b.breakdown_id = '3'
        AND (
            (a.month >= '$start_month' AND a.year = '$start_year') 
            OR 
            (a.month <= '$end_month' AND a.year = '$end_year')
        )

        UNION

        SELECT 
            '4' AS breakdown_id,
            SUM(a.actual_amount) AS actual_amount
        FROM tbl_branch_pl_data a
        LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id
        WHERE b.branchId = '$branchId' 
        AND b.breakdown_id = '4'
        AND (
            (a.month >= '$start_month' AND a.year = '$start_year') 
            OR 
            (a.month <= '$end_month' AND a.year = '$end_year')
        ) ";
$res = mysqli_query($connection, $sql) or die($connection->error);
$num = mysqli_num_rows($res);
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

if ($num == 0) {
?>
    <div class="d-flex">
        <div class="p-1">
            <div class="golden-ratio" style="width: 498px;height: 608px;">
                <div class="text-top-right">
                    <button class="btn btn-sm btn-light px-4 border py-0" type="button">Sales</button>
                </div>
                <div class="text-middle">
                    <div class="fs-24 fw-100">Sales</div>
                    <div class="fs-28">
                        <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.4166 13.0835V6.5835C12.4166 5.98766 12.9041 5.50016 13.4999 5.50016C14.0958 5.50016 14.5833 5.98766 14.5833 6.5835V13.0835C14.5833 13.6793 14.0958 14.1668 13.4999 14.1668C12.9041 14.1668 12.4166 13.6793 12.4166 13.0835ZM13.4999 15.2502C12.6008 15.2502 11.8749 15.976 11.8749 16.8752C11.8749 17.7743 12.6008 18.5002 13.4999 18.5002C14.3991 18.5002 15.1249 17.7743 15.1249 16.8752C15.1249 15.976 14.3991 15.2502 13.4999 15.2502ZM26.0449 20.5368C25.2866 21.9993 23.6941 22.8335 21.7008 22.8335H5.30994C3.30577 22.8335 1.7241 21.9993 0.96577 20.5368C0.196604 19.0635 0.41327 17.1785 1.50744 15.5968L10.2174 1.81683C10.9866 0.711829 12.1999 0.0834961 13.4999 0.0834961C14.7999 0.0834961 16.0133 0.711829 16.7499 1.78433L25.5033 15.6185C26.5974 17.2002 26.8033 19.0743 26.0341 20.5368H26.0449ZM23.7158 16.8318C23.7158 16.8318 23.6941 16.8102 23.6941 16.7885L14.9516 2.976C14.6374 2.53183 14.0958 2.25016 13.4999 2.25016C12.9041 2.25016 12.3624 2.53183 12.0266 3.01933L3.30577 16.7885C2.6341 17.7418 2.48244 18.7818 2.87244 19.5293C3.2516 20.266 4.11827 20.6668 5.2991 20.6668H21.6791C22.8599 20.6668 23.7266 20.266 24.1058 19.5293C24.4958 18.7818 24.3441 17.7418 23.7049 16.8318H23.7158Z" fill="#FF9D00" />
                        </svg>
                        Not Set
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block w-75">
            <div class=" p-1">
                <div class="golden-ratio" style="width: 100%;height: 132px;">
                    <div class="text-top-right">
                        <button class="btn btn-sm btn-light px-4 border py-0" type="button">Variable Expense</button>
                    </div>
                    <div class="text-middle d-flex">
                        <div class="fs-24 fw-100 pe-5">Variable Expense</div>
                        <div class="fs-28 ps-5">
                            <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.4166 13.0835V6.5835C12.4166 5.98766 12.9041 5.50016 13.4999 5.50016C14.0958 5.50016 14.5833 5.98766 14.5833 6.5835V13.0835C14.5833 13.6793 14.0958 14.1668 13.4999 14.1668C12.9041 14.1668 12.4166 13.6793 12.4166 13.0835ZM13.4999 15.2502C12.6008 15.2502 11.8749 15.976 11.8749 16.8752C11.8749 17.7743 12.6008 18.5002 13.4999 18.5002C14.3991 18.5002 15.1249 17.7743 15.1249 16.8752C15.1249 15.976 14.3991 15.2502 13.4999 15.2502ZM26.0449 20.5368C25.2866 21.9993 23.6941 22.8335 21.7008 22.8335H5.30994C3.30577 22.8335 1.7241 21.9993 0.96577 20.5368C0.196604 19.0635 0.41327 17.1785 1.50744 15.5968L10.2174 1.81683C10.9866 0.711829 12.1999 0.0834961 13.4999 0.0834961C14.7999 0.0834961 16.0133 0.711829 16.7499 1.78433L25.5033 15.6185C26.5974 17.2002 26.8033 19.0743 26.0341 20.5368H26.0449ZM23.7158 16.8318C23.7158 16.8318 23.6941 16.8102 23.6941 16.7885L14.9516 2.976C14.6374 2.53183 14.0958 2.25016 13.4999 2.25016C12.9041 2.25016 12.3624 2.53183 12.0266 3.01933L3.30577 16.7885C2.6341 17.7418 2.48244 18.7818 2.87244 19.5293C3.2516 20.266 4.11827 20.6668 5.2991 20.6668H21.6791C22.8599 20.6668 23.7266 20.266 24.1058 19.5293C24.4958 18.7818 24.3441 17.7418 23.7049 16.8318H23.7158Z" fill="#FF9D00" />
                            </svg>
                            Not Set
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="p-1">
                    <div class="golden-ratio" style="width: 384px;height: 468px;">
                        <div class="text-top-right">
                            <button class="btn btn-sm btn-light px-4 border py-0" type="button">Gross Profit</button>
                        </div>
                        <div class="text-middle">
                            <div class="fs-24 fw-100">Gross Profit</div>
                            <div class="fs-28">
                                <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.4166 13.0835V6.5835C12.4166 5.98766 12.9041 5.50016 13.4999 5.50016C14.0958 5.50016 14.5833 5.98766 14.5833 6.5835V13.0835C14.5833 13.6793 14.0958 14.1668 13.4999 14.1668C12.9041 14.1668 12.4166 13.6793 12.4166 13.0835ZM13.4999 15.2502C12.6008 15.2502 11.8749 15.976 11.8749 16.8752C11.8749 17.7743 12.6008 18.5002 13.4999 18.5002C14.3991 18.5002 15.1249 17.7743 15.1249 16.8752C15.1249 15.976 14.3991 15.2502 13.4999 15.2502ZM26.0449 20.5368C25.2866 21.9993 23.6941 22.8335 21.7008 22.8335H5.30994C3.30577 22.8335 1.7241 21.9993 0.96577 20.5368C0.196604 19.0635 0.41327 17.1785 1.50744 15.5968L10.2174 1.81683C10.9866 0.711829 12.1999 0.0834961 13.4999 0.0834961C14.7999 0.0834961 16.0133 0.711829 16.7499 1.78433L25.5033 15.6185C26.5974 17.2002 26.8033 19.0743 26.0341 20.5368H26.0449ZM23.7158 16.8318C23.7158 16.8318 23.6941 16.8102 23.6941 16.7885L14.9516 2.976C14.6374 2.53183 14.0958 2.25016 13.4999 2.25016C12.9041 2.25016 12.3624 2.53183 12.0266 3.01933L3.30577 16.7885C2.6341 17.7418 2.48244 18.7818 2.87244 19.5293C3.2516 20.266 4.11827 20.6668 5.2991 20.6668H21.6791C22.8599 20.6668 23.7266 20.266 24.1058 19.5293C24.4958 18.7818 24.3441 17.7418 23.7049 16.8318H23.7158Z" fill="#FF9D00" />
                                </svg>
                                Not Set
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100">
                    <div class="p-1">
                        <div class="golden-ratio" style="width: 100%;height: 170px;">
                            <div class="text-top-right">
                                <button class="btn btn-sm btn-light px-4 border py-0" type="button">Labor Cost</button>
                            </div>
                            <div class="text-middle d-flex">
                                <div class="fs-24 fw-100 pe-5">Labor Cost</div>
                                <div class="fs-28 ps-5">
                                    <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.4166 13.0835V6.5835C12.4166 5.98766 12.9041 5.50016 13.4999 5.50016C14.0958 5.50016 14.5833 5.98766 14.5833 6.5835V13.0835C14.5833 13.6793 14.0958 14.1668 13.4999 14.1668C12.9041 14.1668 12.4166 13.6793 12.4166 13.0835ZM13.4999 15.2502C12.6008 15.2502 11.8749 15.976 11.8749 16.8752C11.8749 17.7743 12.6008 18.5002 13.4999 18.5002C14.3991 18.5002 15.1249 17.7743 15.1249 16.8752C15.1249 15.976 14.3991 15.2502 13.4999 15.2502ZM26.0449 20.5368C25.2866 21.9993 23.6941 22.8335 21.7008 22.8335H5.30994C3.30577 22.8335 1.7241 21.9993 0.96577 20.5368C0.196604 19.0635 0.41327 17.1785 1.50744 15.5968L10.2174 1.81683C10.9866 0.711829 12.1999 0.0834961 13.4999 0.0834961C14.7999 0.0834961 16.0133 0.711829 16.7499 1.78433L25.5033 15.6185C26.5974 17.2002 26.8033 19.0743 26.0341 20.5368H26.0449ZM23.7158 16.8318C23.7158 16.8318 23.6941 16.8102 23.6941 16.7885L14.9516 2.976C14.6374 2.53183 14.0958 2.25016 13.4999 2.25016C12.9041 2.25016 12.3624 2.53183 12.0266 3.01933L3.30577 16.7885C2.6341 17.7418 2.48244 18.7818 2.87244 19.5293C3.2516 20.266 4.11827 20.6668 5.2991 20.6668H21.6791C22.8599 20.6668 23.7266 20.266 24.1058 19.5293C24.4958 18.7818 24.3441 17.7418 23.7049 16.8318H23.7158Z" fill="#FF9D00" />
                                    </svg>
                                    Not Set
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-1">
                        <div class="golden-ratio" style="width: 100%;height: 132px;">
                            <div class="text-top-right">
                                <button class="btn btn-sm btn-light px-4 border py-0" type="button">Fixed Expense</button>
                            </div>
                            <div class="text-middle d-flex">
                                <div class="fs-24 fw-100 pe-5">Fixed Expense (Others)</div>
                                <div class="fs-28 ps-5">
                                    <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.4166 13.0835V6.5835C12.4166 5.98766 12.9041 5.50016 13.4999 5.50016C14.0958 5.50016 14.5833 5.98766 14.5833 6.5835V13.0835C14.5833 13.6793 14.0958 14.1668 13.4999 14.1668C12.9041 14.1668 12.4166 13.6793 12.4166 13.0835ZM13.4999 15.2502C12.6008 15.2502 11.8749 15.976 11.8749 16.8752C11.8749 17.7743 12.6008 18.5002 13.4999 18.5002C14.3991 18.5002 15.1249 17.7743 15.1249 16.8752C15.1249 15.976 14.3991 15.2502 13.4999 15.2502ZM26.0449 20.5368C25.2866 21.9993 23.6941 22.8335 21.7008 22.8335H5.30994C3.30577 22.8335 1.7241 21.9993 0.96577 20.5368C0.196604 19.0635 0.41327 17.1785 1.50744 15.5968L10.2174 1.81683C10.9866 0.711829 12.1999 0.0834961 13.4999 0.0834961C14.7999 0.0834961 16.0133 0.711829 16.7499 1.78433L25.5033 15.6185C26.5974 17.2002 26.8033 19.0743 26.0341 20.5368H26.0449ZM23.7158 16.8318C23.7158 16.8318 23.6941 16.8102 23.6941 16.7885L14.9516 2.976C14.6374 2.53183 14.0958 2.25016 13.4999 2.25016C12.9041 2.25016 12.3624 2.53183 12.0266 3.01933L3.30577 16.7885C2.6341 17.7418 2.48244 18.7818 2.87244 19.5293C3.2516 20.266 4.11827 20.6668 5.2991 20.6668H21.6791C22.8599 20.6668 23.7266 20.266 24.1058 19.5293C24.4958 18.7818 24.3441 17.7418 23.7049 16.8318H23.7158Z" fill="#FF9D00" />
                                    </svg>
                                    Not Set
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-1">
                        <div class="golden-ratio" style="width: 100%;height: 150px;">
                            <div class="text-top-right">
                                <button class="btn btn-sm btn-light px-4 border py-0" type="button">Operating Profit</button>
                            </div>
                            <div class="text-middle d-flex">
                                <div class="fs-24 fw-100 pe-5">Operating Profit</div>
                                <div class="fs-28 ps-5">
                                    <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.4166 13.0835V6.5835C12.4166 5.98766 12.9041 5.50016 13.4999 5.50016C14.0958 5.50016 14.5833 5.98766 14.5833 6.5835V13.0835C14.5833 13.6793 14.0958 14.1668 13.4999 14.1668C12.9041 14.1668 12.4166 13.6793 12.4166 13.0835ZM13.4999 15.2502C12.6008 15.2502 11.8749 15.976 11.8749 16.8752C11.8749 17.7743 12.6008 18.5002 13.4999 18.5002C14.3991 18.5002 15.1249 17.7743 15.1249 16.8752C15.1249 15.976 14.3991 15.2502 13.4999 15.2502ZM26.0449 20.5368C25.2866 21.9993 23.6941 22.8335 21.7008 22.8335H5.30994C3.30577 22.8335 1.7241 21.9993 0.96577 20.5368C0.196604 19.0635 0.41327 17.1785 1.50744 15.5968L10.2174 1.81683C10.9866 0.711829 12.1999 0.0834961 13.4999 0.0834961C14.7999 0.0834961 16.0133 0.711829 16.7499 1.78433L25.5033 15.6185C26.5974 17.2002 26.8033 19.0743 26.0341 20.5368H26.0449ZM23.7158 16.8318C23.7158 16.8318 23.6941 16.8102 23.6941 16.7885L14.9516 2.976C14.6374 2.53183 14.0958 2.25016 13.4999 2.25016C12.9041 2.25016 12.3624 2.53183 12.0266 3.01933L3.30577 16.7885C2.6341 17.7418 2.48244 18.7818 2.87244 19.5293C3.2516 20.266 4.11827 20.6668 5.2991 20.6668H21.6791C22.8599 20.6668 23.7266 20.266 24.1058 19.5293C24.4958 18.7818 24.3441 17.7418 23.7049 16.8318H23.7158Z" fill="#FF9D00" />
                                    </svg>
                                    Not Set
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="p-1">
        <div class="bar-light text-end fw-600 fs-24 py-2 px-3">
            Total Contribution 0%
        </div>
    </div>
    <?php
} else {
    if ($rows[0]['actual_amount'] == 0) {
        // echo "Sales is Zero.";
    ?>
        <div class="p-4 form-currency">
            <div class="position-relative dash-forecast-accounts" style="height: 60vh;">
                <div class="position-middle content-no-config">
                    <p><img src="../asset/images/no-config.png" alt="" width="82"></p>
                    <div class="mb-2 fs-26 fw-700">No Profit & Loss Porta Data Yet!</div>
                    <p class="text-muted fs-15 fw-300">Create or import a Profit & Loss Porta Data to get started. Once added, you can edit it anytime.</p>
                    <a class="btn btn-primary" type="button" href="FinancialProfitLossPortal?id=<?php echo $branchId; ?>">

                        Back to Profit & Loss Porta Page

                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.5 0.170898C7.71997 0.170898 5.97991 0.698739 4.49987 1.68767C3.01983 2.6766 1.86628 4.08221 1.18509 5.72675C0.5039 7.37128 0.32567 9.18088 0.672936 10.9267C1.0202 12.6725 1.87737 14.2762 3.13604 15.5349C4.39471 16.7935 5.99836 17.6507 7.74419 17.998C9.49002 18.3452 11.2996 18.167 12.9442 17.4858C14.5887 16.8046 15.9943 15.6511 16.9832 14.171C17.9722 12.691 18.5 10.9509 18.5 9.1709C18.4974 6.78474 17.5484 4.49706 15.8611 2.80979C14.1738 1.12252 11.8862 0.173479 9.5 0.170898ZM9.5 16.6709C8.01664 16.6709 6.56659 16.231 5.33323 15.4069C4.09986 14.5828 3.13856 13.4115 2.57091 12.041C2.00325 10.6706 1.85473 9.16258 2.14411 7.70772C2.4335 6.25286 3.14781 4.91649 4.1967 3.8676C5.2456 2.8187 6.58197 2.1044 8.03683 1.81501C9.49168 1.52562 10.9997 1.67414 12.3701 2.2418C13.7406 2.80946 14.9119 3.77075 15.736 5.00412C16.5601 6.23749 17 7.68754 17 9.1709C16.9978 11.1594 16.2069 13.0657 14.8009 14.4718C13.3948 15.8778 11.4885 16.6687 9.5 16.6709ZM13.25 9.1709C13.25 9.36981 13.171 9.56057 13.0303 9.70123C12.8897 9.84188 12.6989 9.9209 12.5 9.9209H10.25V12.1709C10.25 12.3698 10.171 12.5606 10.0303 12.7012C9.88968 12.8419 9.69891 12.9209 9.5 12.9209C9.30109 12.9209 9.11032 12.8419 8.96967 12.7012C8.82902 12.5606 8.75 12.3698 8.75 12.1709V9.9209H6.5C6.30109 9.9209 6.11032 9.84188 5.96967 9.70123C5.82902 9.56057 5.75 9.36981 5.75 9.1709C5.75 8.97198 5.82902 8.78122 5.96967 8.64057C6.11032 8.49992 6.30109 8.4209 6.5 8.4209H8.75V6.1709C8.75 5.97199 8.82902 5.78122 8.96967 5.64057C9.11032 5.49992 9.30109 5.4209 9.5 5.4209C9.69891 5.4209 9.88968 5.49992 10.0303 5.64057C10.171 5.78122 10.25 5.97199 10.25 6.1709V8.4209H12.5C12.6989 8.4209 12.8897 8.49992 13.0303 8.64057C13.171 8.78122 13.25 8.97198 13.25 9.1709Z" fill="white" />
                        </svg>

                    </a>

                </div>
            </div>
        </div>
    <?php
    } else if ($rows[0]['actual_amount'] != '' && $rows[1]['actual_amount'] != '' && $rows[2]['actual_amount'] != '' && $rows[3]['actual_amount'] != '') {
        $SalesValue = $rows[0]['actual_amount'];
        $VariableExpenseValue = $rows[1]['actual_amount'];
        $GrossProfitValue = $rows[0]['actual_amount'] - $rows[1]['actual_amount'];
        $LaborCostValue = $rows[2]['actual_amount'];
        $FixedExpenseValue = $rows[3]['actual_amount'];
        $OperatingProfitValue = $GrossProfitValue - $rows[3]['actual_amount'];

        $VariableExpenseRatio = ($VariableExpenseValue / $SalesValue) * 100;
        $GrossProfitRatio = ($GrossProfitValue / $SalesValue) * 100;
        $LaborCostRatio = ($LaborCostValue / $SalesValue) * 100;
        $LaborRatio = ($LaborCostValue / $GrossProfitValue) * 100;
        $FixedExpenseRatio = ($FixedExpenseValue / $GrossProfitValue) * 100;
        $OperatingProfitRatio = ($OperatingProfitValue / $SalesValue) * 100;

    ?>
        <div class="d-flex">
            <div class="p-1">
                <div class="golden-ratio bg-sales" style="width: 498px;height: 608px;">
                    <div class="text-top-right">
                        <button class="btn btn-sm btn-light px-4 border py-0" type="button">Sales</button>
                    </div>
                    <div class="text-middle">
                        <div class="fs-24 fw-100">Sales</div>
                        <div class="fs-28">
                            <?php echo $currencySymbol . formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $SalesValue)); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-block w-75">
                <div class=" p-1">
                    <div class="golden-ratio bg-variable-expense" style="width: 100%;height: 132px;">
                        <div class="text-top-right">
                            <button class="btn btn-sm btn-light px-4 border py-0" type="button">Variable Expense</button>
                        </div>
                        <div class="text-middle d-flex">
                            <div class="fs-24 fw-100 pe-5">Variable Expense</div>
                            <div class="fs-28 ps-5">
                                <?php echo $currencySymbol . formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $VariableExpenseValue)); ?>
                            </div>
                        </div>

                        <div class="bar-golden-ratio yellow">
                            Gross Profit Ratio
                            <span class="golden-ratio"><?php echo number_format($GrossProfitRatio, 2); ?> %</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="p-1">
                        <div class="golden-ratio bg-gross-profit" style="width: 384px;height: 468px;">
                            <div class="text-top-right">
                                <button class="btn btn-sm btn-light px-4 border py-0" type="button">Gross Profit</button>
                            </div>
                            <div class="text-middle" style="left: 20%;top:68%">
                                <div class="fs-24 fw-100">Gross Profit</div>
                                <div class="fs-28">
                                    <?php echo $currencySymbol . formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $GrossProfitValue)); ?>
                                </div>
                            </div>
                            <div class="bar-golden-ratio green top">
                                Gross Profit Ratio
                                <span class="golden-ratio"><?php echo number_format($GrossProfitRatio, 2); ?>%</span>
                            </div>

                        </div>
                    </div>
                    <div class="w-100">
                        <div class="p-1">
                            <div class="golden-ratio bg-labor-cost" style="width: 100%;height: 170px;">
                                <div class="text-top-right">
                                    <button class="btn btn-sm btn-light px-4 border py-0" type="button">Labor Cost</button>
                                </div>
                                <div class="text-middle d-flex">
                                    <div class="fs-24 fw-100 pe-5">Labor Cost</div>
                                    <div class="fs-28 ps-5">
                                        <?php echo $currencySymbol . formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $LaborCostValue)); ?>
                                    </div>
                                </div>

                                <div class="bar-golden-ratio yellow" style="width: 464px;    transform: translate(-94%, -50%);">
                                    Labor Cost Ratio
                                    <span class="golden-ratio"><?php echo number_format($LaborCostRatio, 2); ?>%</span>
                                </div>

                                <div class="bar-golden-ratio yellow bottom">
                                    Labor Ratio
                                    <span class="golden-ratio"><?php echo number_format($LaborRatio, 2); ?>%</span>
                                </div>


                            </div>
                        </div>
                        <div class="p-1">
                            <div class="golden-ratio bg-fixed-expense" style="width: 100%;height: 132px;">
                                <div class="text-top-right">
                                    <button class="btn btn-sm btn-light px-4 border py-0" type="button">Fixed Expense</button>
                                </div>
                                <div class="text-middle d-flex">
                                    <div class="fs-24 fw-100 pe-5">Fixed Expense (Others)</div>
                                    <div class="fs-28 ps-5">
                                        <?php echo $currencySymbol . formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $FixedExpenseValue)); ?>
                                    </div>
                                </div>
                                <div class="bar-golden-ratio red" style="transform: translate(-78%, -50%);">
                                    Fixed Expense (Other) Ratio
                                    <span class="golden-ratio"><?php echo number_format($FixedExpenseRatio, 2); ?>%</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-1">
                            <div class="golden-ratio bg-operating-profit" style="width: 100%;height: 150px;">
                                <div class="text-top-right">
                                    <button class="btn btn-sm btn-light px-4 border py-0" type="button">Operating Profit</button>
                                </div>
                                <div class="text-middle d-flex">
                                    <div class="fs-24 fw-100 pe-5">Operating Profit</div>
                                    <div class="fs-28 ps-5">
                                        <?php echo $currencySymbol . formatRateNumber($rate, changeCurrencyValue($currencyDefaul, $currencyFocus, $OperatingProfitValue)); ?>
                                    </div>
                                </div>

                                <div class="bar-golden-ratio green" style="width: 464px;    transform: translate(-94%, -50%);">
                                    Operating Profit Ratio
                                    <span class="golden-ratio bg-danger"><?php echo number_format($OperatingProfitRatio, 2); ?>%</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="p-1">
            <div class="bar-light fw-600 fs-24 py-2 px-3 d-flex justify-content-end">
                <div class="text-end">
                    <p class="m-0 fs-15 fw-300">Net Achievement Ratio</p>
                    <p class="m-0 fs-22">฿34.6m</p>
                </div>
                <div class="ms-3">
                    <div class="circle red">-23%</div>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="d-flex">
            <div class="p-1">
                <div class="golden-ratio" style="width: 498px;height: 608px;">
                    <div class="text-top-right">
                        <button class="btn btn-sm btn-light px-4 border py-0" type="button">Sales</button>
                    </div>
                    <div class="text-middle">
                        <div class="fs-24 fw-100">Sales</div>
                        <div class="fs-28">
                            <?php if ($rows[0]['actual_amount'] == '') { ?>
                                <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.4166 13.0835V6.5835C12.4166 5.98766 12.9041 5.50016 13.4999 5.50016C14.0958 5.50016 14.5833 5.98766 14.5833 6.5835V13.0835C14.5833 13.6793 14.0958 14.1668 13.4999 14.1668C12.9041 14.1668 12.4166 13.6793 12.4166 13.0835ZM13.4999 15.2502C12.6008 15.2502 11.8749 15.976 11.8749 16.8752C11.8749 17.7743 12.6008 18.5002 13.4999 18.5002C14.3991 18.5002 15.1249 17.7743 15.1249 16.8752C15.1249 15.976 14.3991 15.2502 13.4999 15.2502ZM26.0449 20.5368C25.2866 21.9993 23.6941 22.8335 21.7008 22.8335H5.30994C3.30577 22.8335 1.7241 21.9993 0.96577 20.5368C0.196604 19.0635 0.41327 17.1785 1.50744 15.5968L10.2174 1.81683C10.9866 0.711829 12.1999 0.0834961 13.4999 0.0834961C14.7999 0.0834961 16.0133 0.711829 16.7499 1.78433L25.5033 15.6185C26.5974 17.2002 26.8033 19.0743 26.0341 20.5368H26.0449ZM23.7158 16.8318C23.7158 16.8318 23.6941 16.8102 23.6941 16.7885L14.9516 2.976C14.6374 2.53183 14.0958 2.25016 13.4999 2.25016C12.9041 2.25016 12.3624 2.53183 12.0266 3.01933L3.30577 16.7885C2.6341 17.7418 2.48244 18.7818 2.87244 19.5293C3.2516 20.266 4.11827 20.6668 5.2991 20.6668H21.6791C22.8599 20.6668 23.7266 20.266 24.1058 19.5293C24.4958 18.7818 24.3441 17.7418 23.7049 16.8318H23.7158Z" fill="#FF9D00" />
                                </svg>
                                Not Set
                            <?php } else { ?>
                                Done
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-block w-75">
                <div class=" p-1">
                    <div class="golden-ratio" style="width: 100%;height: 132px;">
                        <div class="text-top-right">
                            <button class="btn btn-sm btn-light px-4 border py-0" type="button">Variable Expense</button>
                        </div>
                        <div class="text-middle d-flex">
                            <div class="fs-24 fw-100 pe-5">Variable Expense</div>
                            <div class="fs-28 ps-5">
                                <?php if ($rows[1]['actual_amount'] == '') { ?>
                                    <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.4166 13.0835V6.5835C12.4166 5.98766 12.9041 5.50016 13.4999 5.50016C14.0958 5.50016 14.5833 5.98766 14.5833 6.5835V13.0835C14.5833 13.6793 14.0958 14.1668 13.4999 14.1668C12.9041 14.1668 12.4166 13.6793 12.4166 13.0835ZM13.4999 15.2502C12.6008 15.2502 11.8749 15.976 11.8749 16.8752C11.8749 17.7743 12.6008 18.5002 13.4999 18.5002C14.3991 18.5002 15.1249 17.7743 15.1249 16.8752C15.1249 15.976 14.3991 15.2502 13.4999 15.2502ZM26.0449 20.5368C25.2866 21.9993 23.6941 22.8335 21.7008 22.8335H5.30994C3.30577 22.8335 1.7241 21.9993 0.96577 20.5368C0.196604 19.0635 0.41327 17.1785 1.50744 15.5968L10.2174 1.81683C10.9866 0.711829 12.1999 0.0834961 13.4999 0.0834961C14.7999 0.0834961 16.0133 0.711829 16.7499 1.78433L25.5033 15.6185C26.5974 17.2002 26.8033 19.0743 26.0341 20.5368H26.0449ZM23.7158 16.8318C23.7158 16.8318 23.6941 16.8102 23.6941 16.7885L14.9516 2.976C14.6374 2.53183 14.0958 2.25016 13.4999 2.25016C12.9041 2.25016 12.3624 2.53183 12.0266 3.01933L3.30577 16.7885C2.6341 17.7418 2.48244 18.7818 2.87244 19.5293C3.2516 20.266 4.11827 20.6668 5.2991 20.6668H21.6791C22.8599 20.6668 23.7266 20.266 24.1058 19.5293C24.4958 18.7818 24.3441 17.7418 23.7049 16.8318H23.7158Z" fill="#FF9D00" />
                                    </svg>
                                    Not Set
                                <?php } else { ?>
                                    Done
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="p-1">
                        <div class="golden-ratio" style="width: 384px;height: 468px;">
                            <div class="text-top-right">
                                <button class="btn btn-sm btn-light px-4 border py-0" type="button">Gross Profit</button>
                            </div>
                            <div class="text-middle">
                                <div class="fs-24 fw-100">Gross Profit</div>
                                <div class="fs-28">
                                    <?php if ($rows[0]['actual_amount'] == '' || $rows[1]['actual_amount'] == '') { ?>
                                        <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.4166 13.0835V6.5835C12.4166 5.98766 12.9041 5.50016 13.4999 5.50016C14.0958 5.50016 14.5833 5.98766 14.5833 6.5835V13.0835C14.5833 13.6793 14.0958 14.1668 13.4999 14.1668C12.9041 14.1668 12.4166 13.6793 12.4166 13.0835ZM13.4999 15.2502C12.6008 15.2502 11.8749 15.976 11.8749 16.8752C11.8749 17.7743 12.6008 18.5002 13.4999 18.5002C14.3991 18.5002 15.1249 17.7743 15.1249 16.8752C15.1249 15.976 14.3991 15.2502 13.4999 15.2502ZM26.0449 20.5368C25.2866 21.9993 23.6941 22.8335 21.7008 22.8335H5.30994C3.30577 22.8335 1.7241 21.9993 0.96577 20.5368C0.196604 19.0635 0.41327 17.1785 1.50744 15.5968L10.2174 1.81683C10.9866 0.711829 12.1999 0.0834961 13.4999 0.0834961C14.7999 0.0834961 16.0133 0.711829 16.7499 1.78433L25.5033 15.6185C26.5974 17.2002 26.8033 19.0743 26.0341 20.5368H26.0449ZM23.7158 16.8318C23.7158 16.8318 23.6941 16.8102 23.6941 16.7885L14.9516 2.976C14.6374 2.53183 14.0958 2.25016 13.4999 2.25016C12.9041 2.25016 12.3624 2.53183 12.0266 3.01933L3.30577 16.7885C2.6341 17.7418 2.48244 18.7818 2.87244 19.5293C3.2516 20.266 4.11827 20.6668 5.2991 20.6668H21.6791C22.8599 20.6668 23.7266 20.266 24.1058 19.5293C24.4958 18.7818 24.3441 17.7418 23.7049 16.8318H23.7158Z" fill="#FF9D00" />
                                        </svg>
                                        Not Set
                                    <?php } else { ?>
                                        Done
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="p-1">
                            <div class="golden-ratio" style="width: 100%;height: 170px;">
                                <div class="text-top-right">
                                    <button class="btn btn-sm btn-light px-4 border py-0" type="button">Labor Cost</button>
                                </div>
                                <div class="text-middle d-flex">
                                    <div class="fs-24 fw-100 pe-5">Labor Cost</div>
                                    <div class="fs-28 ps-5">
                                        <?php if ($rows[2]['actual_amount'] == '') { ?>
                                            <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.4166 13.0835V6.5835C12.4166 5.98766 12.9041 5.50016 13.4999 5.50016C14.0958 5.50016 14.5833 5.98766 14.5833 6.5835V13.0835C14.5833 13.6793 14.0958 14.1668 13.4999 14.1668C12.9041 14.1668 12.4166 13.6793 12.4166 13.0835ZM13.4999 15.2502C12.6008 15.2502 11.8749 15.976 11.8749 16.8752C11.8749 17.7743 12.6008 18.5002 13.4999 18.5002C14.3991 18.5002 15.1249 17.7743 15.1249 16.8752C15.1249 15.976 14.3991 15.2502 13.4999 15.2502ZM26.0449 20.5368C25.2866 21.9993 23.6941 22.8335 21.7008 22.8335H5.30994C3.30577 22.8335 1.7241 21.9993 0.96577 20.5368C0.196604 19.0635 0.41327 17.1785 1.50744 15.5968L10.2174 1.81683C10.9866 0.711829 12.1999 0.0834961 13.4999 0.0834961C14.7999 0.0834961 16.0133 0.711829 16.7499 1.78433L25.5033 15.6185C26.5974 17.2002 26.8033 19.0743 26.0341 20.5368H26.0449ZM23.7158 16.8318C23.7158 16.8318 23.6941 16.8102 23.6941 16.7885L14.9516 2.976C14.6374 2.53183 14.0958 2.25016 13.4999 2.25016C12.9041 2.25016 12.3624 2.53183 12.0266 3.01933L3.30577 16.7885C2.6341 17.7418 2.48244 18.7818 2.87244 19.5293C3.2516 20.266 4.11827 20.6668 5.2991 20.6668H21.6791C22.8599 20.6668 23.7266 20.266 24.1058 19.5293C24.4958 18.7818 24.3441 17.7418 23.7049 16.8318H23.7158Z" fill="#FF9D00" />
                                            </svg>
                                            Not Set
                                        <?php } else { ?>
                                            Done
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-1">
                            <div class="golden-ratio" style="width: 100%;height: 132px;">
                                <div class="text-top-right">
                                    <button class="btn btn-sm btn-light px-4 border py-0" type="button">Fixed Expense</button>
                                </div>
                                <div class="text-middle d-flex">
                                    <div class="fs-24 fw-100 pe-5">Fixed Expense (Others)</div>
                                    <div class="fs-28 ps-5">
                                        <?php if ($rows[3]['actual_amount'] == '') { ?>
                                            <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.4166 13.0835V6.5835C12.4166 5.98766 12.9041 5.50016 13.4999 5.50016C14.0958 5.50016 14.5833 5.98766 14.5833 6.5835V13.0835C14.5833 13.6793 14.0958 14.1668 13.4999 14.1668C12.9041 14.1668 12.4166 13.6793 12.4166 13.0835ZM13.4999 15.2502C12.6008 15.2502 11.8749 15.976 11.8749 16.8752C11.8749 17.7743 12.6008 18.5002 13.4999 18.5002C14.3991 18.5002 15.1249 17.7743 15.1249 16.8752C15.1249 15.976 14.3991 15.2502 13.4999 15.2502ZM26.0449 20.5368C25.2866 21.9993 23.6941 22.8335 21.7008 22.8335H5.30994C3.30577 22.8335 1.7241 21.9993 0.96577 20.5368C0.196604 19.0635 0.41327 17.1785 1.50744 15.5968L10.2174 1.81683C10.9866 0.711829 12.1999 0.0834961 13.4999 0.0834961C14.7999 0.0834961 16.0133 0.711829 16.7499 1.78433L25.5033 15.6185C26.5974 17.2002 26.8033 19.0743 26.0341 20.5368H26.0449ZM23.7158 16.8318C23.7158 16.8318 23.6941 16.8102 23.6941 16.7885L14.9516 2.976C14.6374 2.53183 14.0958 2.25016 13.4999 2.25016C12.9041 2.25016 12.3624 2.53183 12.0266 3.01933L3.30577 16.7885C2.6341 17.7418 2.48244 18.7818 2.87244 19.5293C3.2516 20.266 4.11827 20.6668 5.2991 20.6668H21.6791C22.8599 20.6668 23.7266 20.266 24.1058 19.5293C24.4958 18.7818 24.3441 17.7418 23.7049 16.8318H23.7158Z" fill="#FF9D00" />
                                            </svg>
                                            Not Set
                                        <?php } else { ?>
                                            Done
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-1">
                            <div class="golden-ratio" style="width: 100%;height: 150px;">
                                <div class="text-top-right">
                                    <button class="btn btn-sm btn-light px-4 border py-0" type="button">Operating Profit</button>
                                </div>
                                <div class="text-middle d-flex">
                                    <div class="fs-24 fw-100 pe-5">Operating Profit</div>
                                    <div class="fs-28 ps-5">
                                        <?php if ($rows[0]['actual_amount'] == '' || $rows[1]['actual_amount'] == '' || $rows[3]['actual_amount'] == '') { ?>
                                            <svg width="27" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.4166 13.0835V6.5835C12.4166 5.98766 12.9041 5.50016 13.4999 5.50016C14.0958 5.50016 14.5833 5.98766 14.5833 6.5835V13.0835C14.5833 13.6793 14.0958 14.1668 13.4999 14.1668C12.9041 14.1668 12.4166 13.6793 12.4166 13.0835ZM13.4999 15.2502C12.6008 15.2502 11.8749 15.976 11.8749 16.8752C11.8749 17.7743 12.6008 18.5002 13.4999 18.5002C14.3991 18.5002 15.1249 17.7743 15.1249 16.8752C15.1249 15.976 14.3991 15.2502 13.4999 15.2502ZM26.0449 20.5368C25.2866 21.9993 23.6941 22.8335 21.7008 22.8335H5.30994C3.30577 22.8335 1.7241 21.9993 0.96577 20.5368C0.196604 19.0635 0.41327 17.1785 1.50744 15.5968L10.2174 1.81683C10.9866 0.711829 12.1999 0.0834961 13.4999 0.0834961C14.7999 0.0834961 16.0133 0.711829 16.7499 1.78433L25.5033 15.6185C26.5974 17.2002 26.8033 19.0743 26.0341 20.5368H26.0449ZM23.7158 16.8318C23.7158 16.8318 23.6941 16.8102 23.6941 16.7885L14.9516 2.976C14.6374 2.53183 14.0958 2.25016 13.4999 2.25016C12.9041 2.25016 12.3624 2.53183 12.0266 3.01933L3.30577 16.7885C2.6341 17.7418 2.48244 18.7818 2.87244 19.5293C3.2516 20.266 4.11827 20.6668 5.2991 20.6668H21.6791C22.8599 20.6668 23.7266 20.266 24.1058 19.5293C24.4958 18.7818 24.3441 17.7418 23.7049 16.8318H23.7158Z" fill="#FF9D00" />
                                            </svg>
                                            Not Set
                                        <?php } else { ?>
                                            Done
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="p-1">
            <div class="bar-light text-end fw-600 fs-24 py-2 px-3">
                Total Contribution 0%
            </div>
        </div>
<?php
    }
}


?>

<?php
mysqli_close($connection);
?>