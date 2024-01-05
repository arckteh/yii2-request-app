<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m231222_165754_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->null()->unique(),
            'email' => $this->string()->null()->unique(),
            'password' => $this->string()->notNull()->defaultValue(''),
            'auth_key' => $this->string(32)->notNull()->defaultValue(''),
            'access_token' => $this->string(32)->notNull()->defaultValue(''),
            'created_at' => $this->timestamp()->null(),
            'updated_at' => $this->timestamp()->null(),
            'logged_in_at' => $this->timestamp()->null(),
            'ip' => $this->bigInteger(20)->notNull()->defaultValue(0),
            'role_name' => $this->string(64)->notNull()->defaultValue(''),
            'status' => 'tinyint NOT NULL DEFAULT 0',
        ]);
        $this->createIndex('username', '{{%username}}', 'username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
