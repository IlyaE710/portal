<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%homework}}`.
 */
class m230601_182449_create_homework_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%homework}}', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull(),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%homework}}');
    }
}
