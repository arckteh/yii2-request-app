<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 */
class m231221_164756_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'status' => "ENUM ('Active', 'Resolved') NOT NULL DEFAULT  'Active'",
            'message' => $this->text(),
            'comment' => $this->text(),
            'created_at' => $this->timestamp()->null(),
            'updated_at' => $this->timestamp()->null(),
        ]);
        $this->createIndex('status', '{{%request}}', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request}}');
    }
}
