<?php

namespace common\helpers;

use Yii;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\User;
use frontend\models\hrvc\Branch;

/**
 * CompanyContext - Session-based company filtering for multi-company architecture.
 * 
 * Stores the user's selected company in session. All modules read from this
 * to filter data by the active company. When no company is selected ("All"),
 * companyId is null and no filter is applied.
 */
class CompanyContext
{
    const SESSION_KEY = 'hrvc_selected_company_id';

    /**
     * Set the active company ID in session.
     * Pass null or 0 for "All Companies" (no filter).
     * @param int|null $companyId
     */
    public static function setCompanyId($companyId)
    {
        $session = Yii::$app->session;
        if (!$session->getIsActive()) {
            $session->open();
        }
        if (empty($companyId) || $companyId == 0) {
            $session->remove(self::SESSION_KEY);
        } else {
            $session->set(self::SESSION_KEY, (int)$companyId);
        }
    }

    /**
     * Get the currently selected company ID from session.
     * Returns null when "All Companies" is active.
     * @return int|null
     */
    public static function getCompanyId()
    {
        $session = Yii::$app->session;
        if (!$session->getIsActive()) {
            $session->open();
        }
        $companyId = $session->get(self::SESSION_KEY);
        return $companyId ? (int)$companyId : null;
    }

    /**
     * Check if "All Companies" mode is active (no company filter).
     * @return bool
     */
    public static function isAllCompanies()
    {
        return self::getCompanyId() === null;
    }

    /**
     * Apply company filter to an ActiveQuery.
     * If a company is selected, adds a WHERE condition. Otherwise, no filter.
     * 
     * @param \yii\db\ActiveQuery $query The query to filter
     * @param string $column The column name to filter on (e.g., 'companyId' or 'employee.companyId')
     * @return \yii\db\ActiveQuery The modified query
     */
    public static function applyFilter($query, $column = 'companyId')
    {
        $companyId = self::getCompanyId();
        if ($companyId !== null) {
            $query->andWhere([$column => $companyId]);
        }
        return $query;
    }

    /**
     * Get all companies accessible to the current user (same group).
     * @return array Array of company records
     */
    public static function getUserCompanies()
    {
        if (!Yii::$app->user->id) {
            return [];
        }

        // Get current user's employee → company → group
        $user = User::find()
            ->where(['userId' => Yii::$app->user->id])
            ->asArray()
            ->one();

        if (!$user || empty($user['employeeId'])) {
            return [];
        }

        $employee = Employee::find()
            ->where(['employeeId' => $user['employeeId']])
            ->asArray()
            ->one();

        if (!$employee || empty($employee['companyId'])) {
            return [];
        }

        $company = Company::find()
            ->where(['companyId' => $employee['companyId']])
            ->asArray()
            ->one();

        if (!$company || empty($company['groupId'])) {
            return [];
        }

        // Get all companies in the same group
        return Company::find()
            ->where(['groupId' => $company['groupId'], 'status' => 1])
            ->orderBy(['companyName' => SORT_ASC])
            ->asArray()
            ->all();
    }

    /**
     * Get the name of the currently selected company.
     * @return string
     */
    public static function getCompanyName()
    {
        $companyId = self::getCompanyId();
        if ($companyId === null) {
            return 'All Companies';
        }
        $company = Company::find()
            ->select(['companyName'])
            ->where(['companyId' => $companyId])
            ->asArray()
            ->one();
        return $company ? $company['companyName'] : 'Select Company';
    }
}
