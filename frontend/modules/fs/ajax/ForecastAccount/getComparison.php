<?php
session_start();
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$filterYear = mysqli_real_escape_string($connection, $_POST['year']);
$filterMonth = mysqli_real_escape_string($connection, $_POST['month']);
$rate = mysqli_real_escape_string($connection, $_POST['rate']);
$currencyFocus = mysqli_real_escape_string($connection, $_POST['currencyId']);

$sql_currencyFocus = "SELECT currencySymbol FROM tbl_currency WHERE currencyId = '$currencyFocus' ";
$res_currencyFocus = mysqli_query($connection, $sql_currencyFocus) or die($connection->error);
$row_currencyFocus = mysqli_fetch_assoc($res_currencyFocus);
$currencySymbol = $row_currencyFocus['currencySymbol'];

$sql_select = "SELECT currency_default FROM branch WHERE branchId = '$branchId' ";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
$row_select = mysqli_fetch_assoc($res_select);
$currencyDefaul = $row_select['currency_default'];

$startYear = $filterYear;
$startMonth = 1;
$endYear = $filterYear;
$endMonth = $filterMonth;

$sql = "SELECT 
            '1' AS breakdown_id,
            SUM(a.actual_amount) AS actual_amount
        FROM tbl_branch_pl_data a
        LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id
        WHERE b.branchId = '$branchId' 
        AND b.breakdown_id = '1'
        AND (
            (a.month >= '$startMonth' AND a.year = '$startYear') 
            OR 
            (a.month <= '$endMonth' AND a.year = '$endYear')
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
            (a.month >= '$startMonth' AND a.year = '$startYear') 
            OR 
            (a.month <= '$endMonth' AND a.year = '$endYear')
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
            (a.month >= '$startMonth' AND a.year = '$startYear') 
            OR 
            (a.month <= '$endMonth' AND a.year = '$endYear')
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
            (a.month >= '$startMonth' AND a.year = '$startYear') 
            OR 
            (a.month <= '$endMonth' AND a.year = '$endYear')
        )
            ";
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
            <div class="position-relative dash-forecast-accounts" style="height: 55vh;">
                <div class="position-middle content-no-config">
                    <p><img src="/fs/asset/images/no-config.png" alt="" width="82"></p>
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

        $SalesPercent = 100;
        $VariableExpensePercent = ($VariableExpenseValue / $SalesValue) * 100;
        $GrossProfitPercent = ($GrossProfitValue / $SalesValue) * 100;
        $LaborCostPercent = ($LaborCostValue / $SalesValue) * 100;
        $FixedExpensePercent = ($FixedExpenseValue / $SalesValue) * 100;
        $OperatingProfitPercent = ($OperatingProfitValue / $SalesValue) * 100;

        $BreakEventPointRatio = ($FixedExpenseValue / $GrossProfitValue) * 100;

        if ($BreakEventPointRatio < 60) {
            $hilight = 1;
        } elseif ($BreakEventPointRatio >= 60 && $BreakEventPointRatio <= 80) {
            $hilight = 2;
        } elseif ($BreakEventPointRatio >= 81 && $BreakEventPointRatio <= 90) {
            $hilight = 3;
        } elseif ($BreakEventPointRatio >= 91 && $BreakEventPointRatio <= 100) {
            $hilight = 4;
        } elseif ($BreakEventPointRatio >= 101 && $BreakEventPointRatio <= 200) {
            $hilight = 5;
        } else {
            $hilight = 6;
        }

    ?>
        <input type="hidden" id="financialClass" name="financialClass" value="<?php echo $hilight ?>">
        <div class="d-flex">
            <div class="p-1 w-25">
                <div class="golden-ratio bg-sales" style="height: 608px;">
                    <div class="text-top-right">
                        <button class="btn btn-sm btn-light px-4 border py-0" type="button">Sales</button>
                    </div>
                    <div class="text-middle">
                        <div class="d-flex align-content-center align-items-center justify-content-center">
                            <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                                <path d="M1.51205 -2.64375e-07L18.4879 -3.23254e-06C18.7882 0.00163642 19.0814 0.119201 19.3304 0.337826C19.5794 0.55645 19.7731 0.866317 19.8868 1.22824C20.0006 1.59017 20.0294 1.98789 19.9696 2.37114C19.9098 2.75438 19.7641 3.10592 19.5508 3.38131L11.0781 14.4151C10.9369 14.6004 10.769 14.7475 10.584 14.8479C10.3989 14.9483 10.2005 15 10 15C9.79955 15 9.60109 14.9483 9.41606 14.8479C9.23102 14.7475 9.06308 14.6004 8.92193 14.4151L0.44916 3.38132C0.235942 3.10593 0.0902174 2.75438 0.0304142 2.37114C-0.029389 1.9879 -0.000585892 1.59017 0.113182 1.22825C0.22695 0.86632 0.420574 0.556454 0.669569 0.337829C0.918565 0.119204 1.21175 0.00163949 1.51205 -2.64375e-07Z" fill="#CC0000" />
                            </svg>
                            <span class="fs-24">฿120.3m</span>
                        </div>
                        <div class="d-inline-flex align-content-center align-items-center">
                            <div class="me-1 icon-forecast-accounts blue">P</div>
                            <div class="me-2 icon-forecast-accounts dark-blue">Q</div>
                            <div class="fw-100">Sales</div>
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
                        <div class="text-middle">
                            <div class="d-flex align-content-center align-items-center justify-content-center">
                                <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                                    <path d="M1.51205 -2.64375e-07L18.4879 -3.23254e-06C18.7882 0.00163642 19.0814 0.119201 19.3304 0.337826C19.5794 0.55645 19.7731 0.866317 19.8868 1.22824C20.0006 1.59017 20.0294 1.98789 19.9696 2.37114C19.9098 2.75438 19.7641 3.10592 19.5508 3.38131L11.0781 14.4151C10.9369 14.6004 10.769 14.7475 10.584 14.8479C10.3989 14.9483 10.2005 15 10 15C9.79955 15 9.60109 14.9483 9.41606 14.8479C9.23102 14.7475 9.06308 14.6004 8.92193 14.4151L0.44916 3.38132C0.235942 3.10593 0.0902174 2.75438 0.0304142 2.37114C-0.029389 1.9879 -0.000585892 1.59017 0.113182 1.22825C0.22695 0.86632 0.420574 0.556454 0.669569 0.337829C0.918565 0.119204 1.21175 0.00163949 1.51205 -2.64375e-07Z" fill="#CC0000" />
                                </svg>
                                <span class="fs-24">฿120.3m</span>
                            </div>
                            <div class="d-inline-flex align-content-center align-items-center">
                                <div class="me-1 icon-forecast-accounts yellow">V</div>
                                <div class="me-2 icon-forecast-accounts dark-blue">Q</div>
                                <div class="fw-100">Variable Expense</div>
                            </div>
                        </div>

                        <div class="bar-golden-ratio yellow">
                            Gross Profit Ratio
                            <span class="golden-ratio">42.00%</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="p-1">
                        <div class="golden-ratio bg-gross-profit" style="width: 224px;height: 468px;">
                            <div class="text-top-right">
                                <button class="btn btn-sm btn-light px-4 border py-0" type="button">Gross Profit</button>
                            </div>
                            <div class="text-middle">
                                <div class="d-flex align-content-center align-items-center justify-content-center">
                                    <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.4879 15L1.51205 15C1.21175 14.9984 0.918564 14.8808 0.669569 14.6622C0.420574 14.4435 0.22695 14.1337 0.113182 13.7718C-0.000587372 13.4098 -0.0293902 13.0121 0.0304128 12.6289C0.0902158 12.2456 0.235939 11.8941 0.449158 11.6187L8.92192 0.584905C9.06308 0.399568 9.23102 0.252463 9.41605 0.152074C9.60109 0.0516859 9.79955 1.51001e-06 10 1.53656e-06C10.2004 1.5631e-06 10.3989 0.051686 10.5839 0.152075C10.769 0.252463 10.9369 0.399568 11.0781 0.584905L19.5508 11.6187C19.7641 11.8941 19.9098 12.2456 19.9696 12.6289C20.0294 13.0121 20.0006 13.4098 19.8868 13.7718C19.773 14.1337 19.5794 14.4435 19.3304 14.6622C19.0814 14.8808 18.7883 14.9984 18.4879 15Z" fill="#007C00" />
                                    </svg>
                                    <span class="fs-24">฿120.3m</span>
                                </div>
                                <div class="d-inline-flex align-content-center align-items-center">
                                    <div class="me-1 icon-forecast-accounts green">M</div>
                                    <div class="me-2 icon-forecast-accounts dark-blue">Q</div>
                                    <div class="fw-100">Gross Profit</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="w-100">
                        <div class="p-1">
                            <div class="golden-ratio bg-labor-cost" style="width: 100%;height: 270px;">
                                <div class="text-top-right">
                                    <button class="btn btn-sm btn-light px-4 border py-0" type="button">Labor Cost</button>
                                </div>
                                <div class="text-middle w-75">
                                    <div class="d-table w-100">
                                        <div class="d-table-cell align-content-center" style="justify-items: center;">
                                            <div class="d-flex align-content-center align-items-center justify-content-center">
                                                <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M18.4879 15L1.51205 15C1.21175 14.9984 0.918564 14.8808 0.669569 14.6622C0.420574 14.4435 0.22695 14.1337 0.113182 13.7718C-0.000587372 13.4098 -0.0293902 13.0121 0.0304128 12.6289C0.0902158 12.2456 0.235939 11.8941 0.449158 11.6187L8.92192 0.584905C9.06308 0.399568 9.23102 0.252463 9.41605 0.152074C9.60109 0.0516859 9.79955 1.51001e-06 10 1.53656e-06C10.2004 1.5631e-06 10.3989 0.051686 10.5839 0.152075C10.769 0.252463 10.9369 0.399568 11.0781 0.584905L19.5508 11.6187C19.7641 11.8941 19.9098 12.2456 19.9696 12.6289C20.0294 13.0121 20.0006 13.4098 19.8868 13.7718C19.773 14.1337 19.5794 14.4435 19.3304 14.6622C19.0814 14.8808 18.7883 14.9984 18.4879 15Z" fill="#007C00" />
                                                </svg>
                                                <span class="fs-24">฿120.3m</span>
                                            </div>
                                            <div class="d-inline-flex align-content-center align-items-center">
                                                <div class="me-1 icon-forecast-accounts red">F</div>
                                                <div class="fw-100">Fixed Expense (Others)</div>
                                            </div>
                                        </div>
                                        <div class="d-table-cell border-end border-warning" style="justify-items: center;">
                                            <div class="list-chart-forecast-accounts">
                                                <div class="section-forecast-accounts">
                                                    <span>
                                                        <svg width="17" height="13" viewBox="0 0 17 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5.22611 6.66503C5.24244 6.38268 5.05468 6.1317 4.77713 6.06111C4.06693 5.88072 3.57713 5.26896 3.57713 4.57876C3.57713 3.90425 4.03427 3.31601 4.71999 3.11209C5.04652 3.01798 5.22611 2.68856 5.12815 2.37484C5.03019 2.06111 4.68734 1.88856 4.3608 1.98268C3.1608 2.33562 2.35264 3.37876 2.35264 4.57876C2.35264 5.29249 2.64652 5.95915 3.14448 6.45327C1.5608 7.19837 0.491417 8.77484 0.491417 10.5474C0.491417 10.869 0.768968 11.1356 1.10366 11.1356C1.43836 11.1356 1.71591 10.869 1.71591 10.5474C1.71591 8.86896 2.99754 7.4415 4.6955 7.21405C4.98938 7.17484 5.20978 6.94739 5.22611 6.66503ZM13.8384 6.45327C14.3363 5.95915 14.6302 5.29249 14.6302 4.57876C14.6302 3.3866 13.822 2.34347 12.622 1.98268C12.2955 1.88856 11.9526 2.06111 11.8547 2.37484C11.7567 2.68856 11.9363 3.01798 12.2628 3.11209C12.9486 3.31601 13.4057 3.90425 13.4057 4.57876C13.4057 5.26896 12.9077 5.88072 12.2057 6.06111C11.9282 6.1317 11.7322 6.39052 11.7567 6.66503C11.7812 6.93954 11.9935 7.17484 12.2873 7.21405C13.9853 7.4415 15.2669 8.8768 15.2669 10.5474C15.2669 10.869 15.5445 11.1356 15.8792 11.1356C16.2139 11.1356 16.4914 10.869 16.4914 10.5474C16.4914 8.77484 15.422 7.19837 13.8384 6.45327Z" fill="#30313D" />
                                                            <path d="M10.615 6.6267C11.3578 6.03847 11.8313 5.15219 11.8313 4.15612C11.8313 2.38357 10.3129 0.94043 8.44355 0.94043C6.57416 0.94043 5.05579 2.38357 5.05579 4.15612C5.05579 5.14435 5.52926 6.03063 6.27212 6.6267C4.26396 7.45808 2.85171 9.39533 2.85171 11.6463C2.85171 11.9679 3.12926 12.2345 3.46396 12.2345C3.79865 12.2345 4.0762 11.9679 4.0762 11.6463C4.0762 9.28553 6.03538 7.3718 8.44355 7.3718C10.8517 7.3718 12.8109 9.28553 12.8109 11.6463C12.8109 11.9679 13.0884 12.2345 13.4231 12.2345C13.7578 12.2345 14.0354 11.9679 14.0354 11.6463C14.0354 9.38749 12.6231 7.45023 10.615 6.6267ZM6.28028 4.15612C6.28028 3.03455 7.25171 2.1169 8.44355 2.1169C9.63538 2.1169 10.6068 3.03455 10.6068 4.15612C10.6068 5.27768 9.63538 6.19533 8.44355 6.19533C7.25171 6.19533 6.28028 5.27768 6.28028 4.15612Z" fill="#30313D" />
                                                        </svg>
                                                        Human Resource
                                                    </span>
                                                    <span>2,343</span>
                                                </div>
                                                <div class="sub-section-forecast-accounts">
                                                    <span>Labor Share</span>
                                                    <span>36.2%</span>
                                                </div>
                                                <div class="sub-section-forecast-accounts">
                                                    <span>Labor Productivity</span>
                                                    <span>2.76</span>
                                                </div>
                                                <div class="section-forecast-accounts">
                                                    <span>
                                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.2648 7.08393L13.2625 4.98818C13.1353 4.72271 12.8297 4.5926 12.5514 4.68653L7.48943 6.3762L2.42047 4.68712C2.1422 4.59435 1.83651 4.72329 1.70934 4.98934L0.745598 7.01566C0.467328 7.47775 0.414824 8.03261 0.601504 8.53788C0.782351 9.02798 1.16388 9.4078 1.65216 9.58517L1.64866 10.9359C1.64866 12.1944 2.44964 13.3076 3.64323 13.7055L6.18967 14.555C6.6062 14.6933 7.04373 14.7627 7.48126 14.7627C7.91879 14.7627 8.35633 14.6933 8.77286 14.5544L11.3216 13.7049C12.514 13.307 13.3156 12.1961 13.3162 10.9405L13.3197 9.58575C13.8132 9.41305 14.1994 9.0344 14.3809 8.54255C14.5652 8.04195 14.5133 7.49234 14.2648 7.08393ZM1.77117 7.56819L2.54006 5.95612L6.66162 7.32956L5.71655 9.22927C5.57537 9.46615 5.29127 9.57 5.03166 9.48365L2.06753 8.4947C1.89368 8.43694 1.75834 8.30567 1.69475 8.13413C1.63175 7.96318 1.64983 7.77473 1.77117 7.56819ZM4.01251 12.5993C3.29612 12.3601 2.81483 11.692 2.81542 10.9376L2.81775 9.97491L4.66355 10.5905C5.44878 10.8507 6.29292 10.5379 6.73979 9.78996L6.90138 9.46615L6.89905 13.538C6.78413 13.5147 6.67095 13.4849 6.55953 13.4482L4.01309 12.5993H4.01251ZM10.9523 12.5981L8.40358 13.4476C8.29274 13.4844 8.17956 13.5147 8.06522 13.538L8.06755 9.45681L8.25365 9.83022C8.57859 10.3717 9.14738 10.6821 9.74826 10.6821C9.93377 10.6821 10.1234 10.6523 10.3083 10.5905L12.1518 9.97608L12.1494 10.9394C12.1494 11.6932 11.6682 12.3595 10.9523 12.5981ZM13.2859 8.13763C13.2246 8.30392 13.0928 8.43169 12.9247 8.48829L9.93902 9.48307C9.68351 9.56883 9.39357 9.46206 9.27631 9.27011L8.31141 7.33189L12.4324 5.9567L13.2386 7.63704C13.3296 7.78932 13.3477 7.97135 13.2859 8.13763ZM3.53297 4.20169C3.30487 3.97356 3.30487 3.60482 3.53297 3.37669L5.80639 1.10358C6.26084 0.649069 7.00173 0.649069 7.45618 1.10358L8.38724 2.03476C8.82653 1.81013 9.40115 1.87723 9.75993 2.23605L11.0754 3.55173C11.3035 3.77986 11.3035 4.14859 11.0754 4.37672C10.8473 4.60485 10.4786 4.60485 10.2505 4.37672L8.93503 3.06105L7.09682 4.89949C6.98306 5.01327 6.83371 5.07044 6.68437 5.07044C6.53502 5.07044 6.38568 5.01327 6.27192 4.89949C6.04382 4.67136 6.04382 4.30263 6.27192 4.0745L7.52443 2.82183L6.63187 1.92916L4.35845 4.20227C4.24469 4.31604 4.09534 4.37322 3.946 4.37322C3.79666 4.37322 3.64731 4.31604 3.53355 4.20227L3.53297 4.20169Z" fill="#30313D" />
                                                        </svg>
                                                        Goods
                                                    </span>
                                                    <span>15,903</span>
                                                </div>
                                                <div class="section-forecast-accounts">
                                                    <span>
                                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.2825 0.9375H8.07354C7.84143 0.9375 7.61883 1.0297 7.45471 1.19382C7.29058 1.35794 7.19838 1.58053 7.19838 1.81263C7.19838 2.04473 7.29058 2.26732 7.45471 2.43144C7.61883 2.59556 7.84143 2.68776 8.07354 2.68776H11.2825C11.3498 2.68979 11.4169 2.69661 11.4832 2.70818L0.747829 13.4431C0.583651 13.6073 0.491417 13.8299 0.491417 14.0621C0.491417 14.2943 0.583651 14.5169 0.747829 14.6811C0.912007 14.8453 1.13468 14.9375 1.36686 14.9375C1.59904 14.9375 1.82172 14.8453 1.9859 14.6811L12.7212 3.94619C12.7326 4.01234 12.7392 4.07921 12.7411 4.1463V7.35511C12.7411 7.58721 12.8333 7.8098 12.9974 7.97392C13.1615 8.13804 13.3841 8.23024 13.6163 8.23024C13.8484 8.23024 14.071 8.13804 14.2351 7.97392C14.3992 7.8098 14.4914 7.58721 14.4914 7.35511V4.1463C14.4903 3.29561 14.1519 2.48006 13.5503 1.87853C12.9488 1.277 12.1332 0.938581 11.2825 0.9375Z" fill="#30313D" />
                                                            <path d="M4.28097 7.35624C4.80025 7.35624 5.30786 7.20226 5.73962 6.91378C6.17138 6.6253 6.5079 6.21527 6.70661 5.73555C6.90533 5.25582 6.95733 4.72794 6.85602 4.21867C6.75471 3.70939 6.50466 3.24159 6.13748 2.87443C5.7703 2.50726 5.30248 2.25722 4.79318 2.15592C4.28389 2.05461 3.75599 2.10661 3.27624 2.30532C2.79649 2.50402 2.38645 2.84053 2.09796 3.27227C1.80946 3.70401 1.65548 4.2116 1.65548 4.73085C1.65625 5.42691 1.93311 6.09424 2.42532 6.58643C2.91753 7.07862 3.58489 7.35547 4.28097 7.35624ZM4.28097 3.85573C4.45406 3.85573 4.62327 3.90705 4.76719 4.00321C4.91111 4.09937 5.02328 4.23605 5.08952 4.39596C5.15576 4.55587 5.17309 4.73183 5.13932 4.90158C5.10555 5.07134 5.0222 5.22728 4.89981 5.34966C4.77741 5.47205 4.62148 5.5554 4.45171 5.58917C4.28194 5.62294 4.10598 5.6056 3.94606 5.53937C3.78615 5.47313 3.64947 5.36096 3.5533 5.21705C3.45714 5.07314 3.40581 4.90394 3.40581 4.73085C3.40581 4.49876 3.49801 4.27616 3.66214 4.11205C3.82626 3.94793 4.04887 3.85573 4.28097 3.85573Z" fill="#30313D" />
                                                            <path d="M10.695 8.51953C10.1758 8.51953 9.66815 8.67351 9.23639 8.96199C8.80463 9.25047 8.46811 9.6605 8.2694 10.1402C8.07068 10.62 8.01869 11.1478 8.11999 11.6571C8.2213 12.1664 8.47135 12.6342 8.83853 13.0013C9.20571 13.3685 9.67353 13.6186 10.1828 13.7199C10.6921 13.8212 11.22 13.7692 11.6998 13.5705C12.1795 13.3717 12.5896 13.0352 12.8781 12.6035C13.1665 12.1718 13.3205 11.6642 13.3205 11.1449C13.3198 10.4489 13.0429 9.78153 12.5507 9.28934C12.0585 8.79715 11.3911 8.5203 10.695 8.51953ZM10.695 12.02C10.5219 12.02 10.3527 11.9687 10.2088 11.8726C10.0649 11.7764 9.95273 11.6397 9.88649 11.4798C9.82025 11.3199 9.80292 11.1439 9.83669 10.9742C9.87046 10.8044 9.95381 10.6485 10.0762 10.5261C10.1986 10.4037 10.3545 10.3204 10.5243 10.2866C10.6941 10.2528 10.87 10.2702 11.0299 10.3364C11.1899 10.4026 11.3265 10.5148 11.4227 10.6587C11.5189 10.8026 11.5702 10.9718 11.5702 11.1449C11.5702 11.377 11.478 11.5996 11.3139 11.7637C11.1497 11.9278 10.9271 12.02 10.695 12.02Z" fill="#30313D" />
                                                        </svg>
                                                        Interest
                                                    </span>
                                                    <span>3,947</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bar-golden-ratio pink" style="top:25%">
                                    <div class="mx-1 icon-forecast-accounts red">F</div> / <div class="mx-1 icon-forecast-accounts green">M</div> * <div class="mx-1 icon-forecast-accounts dark-blue">Q</div>
                                    Break-Even Point Ratio
                                    <span class="golden-ratio">42.00%</span>
                                </div>


                            </div>
                        </div>

                        <div class="p-1">
                            <div class="golden-ratio bg-operating-profit" style="width: 100%;height: 190px;">
                                <div class="text-top-right">
                                    <button class="btn btn-sm btn-light px-4 border py-0" type="button">Operating Profit</button>
                                </div>

                                <div class="text-middle">
                                    <div class="d-flex align-content-center align-items-center justify-content-center">
                                        <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4879 15L1.51205 15C1.21175 14.9984 0.918564 14.8808 0.669569 14.6622C0.420574 14.4435 0.22695 14.1337 0.113182 13.7718C-0.000587372 13.4098 -0.0293902 13.0121 0.0304128 12.6289C0.0902158 12.2456 0.235939 11.8941 0.449158 11.6187L8.92192 0.584905C9.06308 0.399568 9.23102 0.252463 9.41605 0.152074C9.60109 0.0516859 9.79955 1.51001e-06 10 1.53656e-06C10.2004 1.5631e-06 10.3989 0.051686 10.5839 0.152075C10.769 0.252463 10.9369 0.399568 11.0781 0.584905L19.5508 11.6187C19.7641 11.8941 19.9098 12.2456 19.9696 12.6289C20.0294 13.0121 20.0006 13.4098 19.8868 13.7718C19.773 14.1337 19.5794 14.4435 19.3304 14.6622C19.0814 14.8808 18.7883 14.9984 18.4879 15Z" fill="#007C00" />
                                        </svg>
                                        <span class="fs-24">฿120.3m</span>
                                    </div>
                                    <div class="d-inline-flex align-content-center align-items-center">
                                        <div class="me-1 icon-forecast-accounts green">G</div>
                                        <div class="">Operating ProfitProfit</div>
                                    </div>
                                    <div class="text-center fw-100">Total Creativity by all Employees</div>
                                </div>


                                <div class="bar-golden-ratio green" style="width: 464px;    transform: translate(-94%, -50%);">
                                    Operating Profit Ratio
                                    <span class="golden-ratio bg-danger">42.00%</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="d-flex justify-content-center p-1">
            <button class="btn btn-md btn-light px-4 border py-0" type="button">Time period : <?php echo date("F Y", strtotime($startYear . '-' . $startMonth . '-01')) . " - " . date("F Y", strtotime($endYear . '-' . $endMonth . '-01')); ?></button>
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