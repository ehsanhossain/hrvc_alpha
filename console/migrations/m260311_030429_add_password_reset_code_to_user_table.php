<?php

use yii\db\Migration;

/**
 * Adds password_reset_code and password_reset_code_expires columns to the user table.
 * These columns support the 4-digit verification code for password reset,
 * as an alternative to the existing token-based reset link.
 */
class m260311_030429_add_password_reset_code_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'password_reset_code', $this->string(6)->null()->after('password_reset_token'));
        $this->addColumn('{{%user}}', 'password_reset_code_expires', $this->integer()->null()->after('password_reset_code'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'password_reset_code_expires');
        $this->dropColumn('{{%user}}', 'password_reset_code');
    }
}
