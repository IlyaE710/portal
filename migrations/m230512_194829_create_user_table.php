<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m230512_194829_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(),
            'patronymic' => $this->string(),
            'lastname' => $this->string(),
            'email' => $this->string()->unique(),
            'passwordHash' => $this->string()->notNull(),
            'role' => $this->string()->notNull()->defaultValue('student'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
