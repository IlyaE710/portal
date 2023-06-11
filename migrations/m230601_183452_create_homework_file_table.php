<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%homework_file}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%homework_answer}}`
 */
class m230601_183452_create_homework_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%homework_file}}', [
            'id' => $this->primaryKey(),
            'homeworkAnswerId' => $this->integer()->notNull(),
            'pathname' => $this->text()->notNull(),
        ]);

        // creates index for column `homeworkAnswerId`
        $this->createIndex(
            '{{%idx-homework_file-homeworkAnswerId}}',
            '{{%homework_file}}',
            'homeworkAnswerId'
        );

        // add foreign key for table `{{%homework_answer}}`
        $this->addForeignKey(
            '{{%fk-homework_file-homeworkAnswerId}}',
            '{{%homework_file}}',
            'homeworkAnswerId',
            '{{%homework_answer}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%homework_answer}}`
        $this->dropForeignKey(
            '{{%fk-homework_file-homeworkAnswerId}}',
            '{{%homework_file}}'
        );

        // drops index for column `homeworkAnswerId`
        $this->dropIndex(
            '{{%idx-homework_file-homeworkAnswerId}}',
            '{{%homework_file}}'
        );

        $this->dropTable('{{%homework_file}}');
    }
}
