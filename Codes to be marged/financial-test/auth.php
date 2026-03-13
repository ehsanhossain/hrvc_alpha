<?php
session_start();
include "../config/main_function.php";
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

if ($connection) {

    $id = mysqli_real_escape_string($connection, $_POST['__id']);

    $sql = "SELECT a.userId,a.status,b.employeeId,b.employeeFirstname,b.employeeSurename,
        b.picture,b.companyId,c.companyName,b.branchId,d.branchName,b.departmentId,f.departmentName,
        b.titleId,e.titleName,d.financial_start_month,d.currency_default,
        (SELECT branchId FROM branch WHERE companyId = b.companyId ORDER BY createDateTime ASC LIMIT 1) AS firstBranchId
        FROM user a
        LEFT JOIN employee b ON a.employeeId = b.employeeId
        LEFT JOIN company c ON b.companyId = c.companyId
        LEFT JOIN branch d ON b.branchId = d.branchId
        LEFT JOIN title e ON b.titleId = e.titleId
        LEFT JOIN department f ON b.departmentId = e.departmentId
        WHERE a.userId = '$id' AND a.status = '1'";
    $res = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($res);

    if ($row['userId'] == $id) {
        $_SESSION["userId"] = $id;
        $_SESSION["employeeId"] = $row['employeeId'];
        $_SESSION["employeeFirstname"] = $row['employeeFirstname'];
        $_SESSION["employeeSurename"] = $row['employeeSurename'];
        $_SESSION["employeePicture"] = $row['picture'];
        $_SESSION["companyId"] = $row['companyId'];
        $_SESSION["companyName"] = $row['companyName'];
        $_SESSION["branchId"] = $row['branchId'];
        $_SESSION["branchName"] = $row['branchName'];
        $_SESSION["departmentId"] = $row['departmentId'];
        $_SESSION["departmentName"] = $row['departmentName'];
        $_SESSION["titleId"] = $row['titleId'];
        $_SESSION["titleName"] = $row['titleName'];
        $_SESSION["financial_start_month"] = $row['financial_start_month'];
        $_SESSION["currency_default"] = $row['currency_default'];
        $_SESSION["firstBranchId"] = $row['firstBranchId'];

        $arr["userId"] = $id;
        $arr["employeeId"] = $row['employeeId'];
        $arr["employeeFirstname"] = $row['employeeFirstname'];
        $arr["employeeSurename"] = $row['employeeSurename'];
        $arr["employeePicture"] = $row['picture'];
        $arr["companyId"] = $row['companyId'];
        $arr["companyName"] = $row['companyName'];
        $arr["branchId"] = $row['branchId'];
        $arr["branchName"] = $row['branchName'];
        $arr["departmentId"] = $row['departmentId'];
        $arr["departmentName"] = $row['departmentName'];
        $arr["titleId"] = $row['titleId'];
        $arr["titleName"] = $row['titleName'];
        $arr["financial_start_month"] = $row['financial_start_month'];
        $arr["currency_default"] = $row['currency_default'];
        $arr["firstBranchId"] = $row['firstBranchId'];

        $arr['result'] = 1;
    } else {
        $arr['result'] = 0;
    }
} else {
    $arr['result'] = 9;
}

echo json_encode($arr);
