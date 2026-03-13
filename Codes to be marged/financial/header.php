<?php
session_start();
include("../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

// Auto-set session if not already set (for local dev)
if (empty($_SESSION['userId']) && $connection) {
    $sql = "SELECT a.userId, b.employeeId, b.employeeFirstname, b.employeeSurename,
        b.picture, b.companyId, c.companyName, b.branchId, d.branchName, b.departmentId, f.departmentName,
        b.titleId, e.titleName, d.financial_start_month, d.currency_default,
        (SELECT branchId FROM branch WHERE companyId = b.companyId ORDER BY createDateTime ASC LIMIT 1) AS firstBranchId
        FROM user a
        LEFT JOIN employee b ON a.employeeId = b.employeeId
        LEFT JOIN company c ON b.companyId = c.companyId
        LEFT JOIN branch d ON b.branchId = d.branchId
        LEFT JOIN title e ON b.titleId = e.titleId
        LEFT JOIN department f ON b.departmentId = f.departmentId
        WHERE a.status = '1' LIMIT 1";
    $res = mysqli_query($connection, $sql);
    if ($res && $row = mysqli_fetch_assoc($res)) {
        $_SESSION["userId"] = $row['userId'];
        $_SESSION["employeeId"] = $row['employeeId'] ?? '';
        $_SESSION["employeeFirstname"] = $row['employeeFirstname'] ?? 'Admin';
        $_SESSION["employeeSurename"] = $row['employeeSurename'] ?? '';
        $_SESSION["employeePicture"] = $row['picture'] ?? '';
        $_SESSION["companyId"] = $row['companyId'] ?? '';
        $_SESSION["companyName"] = $row['companyName'] ?? '';
        $_SESSION["branchId"] = $row['branchId'] ?? '';
        $_SESSION["branchName"] = $row['branchName'] ?? '';
        $_SESSION["departmentId"] = $row['departmentId'] ?? '';
        $_SESSION["departmentName"] = $row['departmentName'] ?? '';
        $_SESSION["titleId"] = $row['titleId'] ?? '';
        $_SESSION["titleName"] = $row['titleName'] ?? '';
        $_SESSION["financial_start_month"] = $row['financial_start_month'] ?? '1';
        $_SESSION["currency_default"] = $row['currency_default'] ?? '';
        $_SESSION["firstBranchId"] = $row['firstBranchId'] ?? '';
    }
}

$currentUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial System</title>
    <link rel="stylesheet" href="../plugins/select2-4.1.0-rc.0/dist/css/select2.css">
    <link rel="stylesheet" href="../plugins/dropzone/dropzone.css">
    <link rel="stylesheet" href="../plugins/bootstrap-icons-1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../plugins/bootstrap-5.3.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered .option-country span {
        margin-top: 5px;
        display: none;
    }

    .option-country span {
        display: inline-block;
        background-color: #D9D9D9;
        color: #666666;
        padding: 6px;
        line-height: 1;
        border-radius: 2px;
    }

    .option-country.active span {
        background-color: #CCE7FF !important;
        color: #2580D3 !important;
    }
</style>

<body>
    <!-- Sidebar -->
    <?php include __DIR__ . "/importMenu.php"; ?>
    <!-- Main Content -->
    <div class="content">

        <div class="user-nav-bar">
            <div class="user-name">
                <h3><?php echo $_SESSION['employeeFirstname'] . ' ' . $_SESSION['employeeSurename']; ?></h3>
                <span><?php echo $_SESSION['titleName'] . ' ' . $_SESSION['departmentName']; ?></span>
            </div>
            <div class="user-dropdown">
                <img src="https://tcg-hrvc-system.com/<?php echo $_SESSION['employeePicture']; ?>" alt="">
                <i class="bi bi-caret-down-fill arrow-down"></i>
                <div class="dropdown-list ">
                    <div class="dropdown-list-menu shadow">
                        <a href="#">
                            <img src="https://tcg-hrvc-system.com/<?php echo $_SESSION['employeePicture']; ?>" alt="">
                            My Profile
                        </a>
                        <a href="#">
                            <img src="../asset/icon/gear.svg" alt="">
                            Settings
                        </a>
                        <a href="#" class="mb-1">
                            <img src="../asset/icon/help.svg" alt="">
                            Help & Support
                        </a>
                        <hr class="m-0">
                        <div class="pt-2">
                            <a href="#" class="btn btn-danger text-center fs-16">
                                <img src="../asset/icon/logout.svg" alt="" width="14">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="user-dropdown">
                <img src="../asset/flag/eng.png" alt="">
                <span>EN</span>
            </div>

            <!-- <div class="user-dropdown alert-noti"> -->
            <div class="user-dropdown">
                <span class="bell-icon">
                    <svg width="23" height="28" viewBox="0 0 23 28" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.15039 21.5015C1.15039 21.5015 3.65039 21.5015 3.65039 17.7515V10.2515C3.65039 10.2515 3.65039 2.75146 11.1504 2.75146C18.6504 2.75146 18.6504 10.2515 18.6504 10.2515V17.7515C18.6504 21.5015 21.1504 21.5015 21.1504 21.5015H1.15039Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13.3133 25.2515C13.0885 25.6259 12.7752 25.9392 12.4008 26.164C12.0207 26.3834 11.5896 26.4989 11.1508 26.4989C10.7119 26.4989 10.2808 26.3834 9.90078 26.164C9.52639 25.9392 9.21302 25.6259 8.98828 25.2515" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.1504 2.75146V1.50146" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <i class="bi bi-caret-down-fill arrow-down"></i>
            </div>
        </div>