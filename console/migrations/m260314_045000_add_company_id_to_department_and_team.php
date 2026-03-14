<?php

use yii\db\Migration;

/**
 * Add companyId column to department and team tables for direct company filtering.
 * Backfills existing data from branch→company relationships.
 */
class m260314_045000_add_company_id_to_department_and_team extends Migration
{
    public function safeUp()
    {
        // --- Add companyId to department ---
        $this->addColumn('department', 'companyId', $this->integer()->null()->after('branchId'));
        
        // Backfill: department.companyId = branch.companyId via department.branchId
        $this->execute("
            UPDATE department d
            INNER JOIN branch b ON d.branchId = b.branchId
            SET d.companyId = b.companyId
        ");

        // --- Add companyId to team ---
        $this->addColumn('team', 'companyId', $this->integer()->null()->after('departmentId'));
        
        // Backfill: team.companyId via team.departmentId → department.companyId (already backfilled above)
        $this->execute("
            UPDATE team t
            INNER JOIN department d ON t.departmentId = d.departmentId
            SET t.companyId = d.companyId
        ");
    }

    public function safeDown()
    {
        $this->dropColumn('team', 'companyId');
        $this->dropColumn('department', 'companyId');
    }
}
