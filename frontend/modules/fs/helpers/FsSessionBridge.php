<?php

namespace frontend\modules\fs\helpers;

use Yii;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Title;
use frontend\models\hrvc\Department;

/**
 * Bridges Yii2's authenticated user to the $_SESSION variables
 * that the FS module's standalone pages expect.
 */
class FsSessionBridge
{
    /**
     * Sync Yii2 user data into $_SESSION for FS pages.
     */
    public static function sync()
    {
        if (Yii::$app->user->isGuest) {
            return;
        }

        // Only sync if not already done this request
        if (!empty($_SESSION['fs_synced'])) {
            return;
        }

        $userId = Yii::$app->user->id;
        $_SESSION['userId'] = $userId;

        // Get employee ID from user record
        $user = \common\models\User::findOne($userId);
        if (!$user || empty($user->employeeId)) {
            // No employee linked, set defaults
            $_SESSION['employeeId'] = '';
            $_SESSION['employeeFirstname'] = 'Admin';
            $_SESSION['employeeSurename'] = '';
            $_SESSION['employeePicture'] = '';
            $_SESSION['companyId'] = '';
            $_SESSION['companyName'] = '';
            $_SESSION['branchId'] = '';
            $_SESSION['branchName'] = '';
            $_SESSION['departmentId'] = '';
            $_SESSION['departmentName'] = '';
            $_SESSION['titleId'] = '';
            $_SESSION['titleName'] = '';
            $_SESSION['financial_start_month'] = '1';
            $_SESSION['currency_default'] = '';
            $_SESSION['firstBranchId'] = '';
            $_SESSION['fs_synced'] = true;
            return;
        }

        // Get employee data using employeeId from user record
        $employee = Employee::find()
            ->where(['employeeId' => $user->employeeId])
            ->asArray()
            ->one();

        if ($employee) {
            $_SESSION['employeeId'] = $employee['employeeId'] ?? '';
            $_SESSION['employeeFirstname'] = $employee['employeeFirstname'] ?? 'User';
            $_SESSION['employeeSurename'] = $employee['employeeSurename'] ?? '';
            $_SESSION['employeePicture'] = $employee['picture'] ?? '';
            $_SESSION['companyId'] = $employee['companyId'] ?? '';
            $_SESSION['branchId'] = $employee['branchId'] ?? '';
            $_SESSION['departmentId'] = $employee['departmentId'] ?? '';
            $_SESSION['titleId'] = $employee['titleId'] ?? '';

            // Get company name
            if (!empty($employee['companyId'])) {
                $company = Company::find()
                    ->where(['companyId' => $employee['companyId']])
                    ->asArray()
                    ->one();
                $_SESSION['companyName'] = $company['companyName'] ?? '';
            }

            // Get branch data
            if (!empty($employee['branchId'])) {
                $branch = Branch::find()
                    ->where(['branchId' => $employee['branchId']])
                    ->asArray()
                    ->one();
                $_SESSION['branchName'] = $branch['branchName'] ?? '';
                $_SESSION['financial_start_month'] = $branch['financial_start_month'] ?? '1';
                $_SESSION['currency_default'] = $branch['currency_default'] ?? '';
            }

            // Get title name
            if (!empty($employee['titleId'])) {
                $title = Title::find()
                    ->where(['titleId' => $employee['titleId']])
                    ->asArray()
                    ->one();
                $_SESSION['titleName'] = $title['titleName'] ?? '';
            }

            // Get department name
            if (!empty($employee['departmentId'])) {
                $dept = Department::find()
                    ->where(['departmentId' => $employee['departmentId']])
                    ->asArray()
                    ->one();
                $_SESSION['departmentName'] = $dept['departmentName'] ?? '';
            }

            // Get first branch ID for the company
            $firstBranch = Branch::find()
                ->where(['companyId' => $employee['companyId']])
                ->orderBy(['createDateTime' => SORT_ASC])
                ->asArray()
                ->one();
            $_SESSION['firstBranchId'] = $firstBranch['branchId'] ?? '';
        }

        $_SESSION['fs_synced'] = true;
    }
}
