<?php

use yii\db\Migration;

/**
 * Handles the creation of table `notification`.
 */
class m260317_054931_create_notification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Only create if it doesn't already exist (safe for local dev where it was created manually)
        if ($this->db->getTableSchema('notification', true) === null) {
            $this->createTable('notification', [
                'notificationId' => $this->bigPrimaryKey()->unsigned(),
                'userId' => $this->integer()->notNull()->defaultValue(0),
                'companyId' => $this->integer()->notNull()->defaultValue(0),
                'type' => $this->string(50)->notNull()->defaultValue('info'),
                'title' => $this->string(255)->notNull()->defaultValue(''),
                'message' => $this->text(),
                'link' => $this->string(500)->defaultValue(null),
                'icon' => $this->string(100)->defaultValue(null),
                'is_read' => $this->tinyInteger(1)->notNull()->defaultValue(0),
                'created_by' => $this->integer()->defaultValue(null),
                'create_datetime' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'update_datetime' => $this->dateTime()->defaultValue(null),
                'status' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

            $this->createIndex('idx_notification_user', 'notification', ['userId', 'is_read', 'status']);
            $this->createIndex('idx_notification_company', 'notification', ['companyId']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('notification');
    }
}
