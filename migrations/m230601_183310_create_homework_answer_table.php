<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%homework_answer}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%homework}}`
 */
class m230601_183310_create_homework_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%homework_answer}}', [
            'id' => $this->primaryKey(),
            'studentId' => $this->integer()->notNull(),
            'homeworkId' => $this->integer()->notNull(),
            'content' => $this->text(),
        ]);

        // creates index for column `studentId`
        $this->createIndex(
            '{{%idx-homework_answer-studentId}}',
            '{{%homework_answer}}',
            'studentId'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-homework_answer-studentId}}',
            '{{%homework_answer}}',
            'studentId',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `homeworkId`
        $this->createIndex(
            '{{%idx-homework_answer-homeworkId}}',
            '{{%homework_answer}}',
            'homeworkId'
        );

        // add foreign key for table `{{%homework}}`
        $this->addForeignKey(
            '{{%fk-homework_answer-homeworkId}}',
            '{{%homework_answer}}',
            'homeworkId',
            '{{%homework}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-homework_answer-studentId}}',
            '{{%homework_answer}}'
        );

        // drops index for column `studentId`
        $this->dropIndex(
            '{{%idx-homework_answer-studentId}}',
            '{{%homework_answer}}'
        );

        // drops foreign key for table `{{%homework}}`
        $this->dropForeignKey(
            '{{%fk-homework_answer-homeworkId}}',
            '{{%homework_answer}}'
        );

        // drops index for column `homeworkId`
        $this->dropIndex(
            '{{%idx-homework_answer-homeworkId}}',
            '{{%homework_answer}}'
        );

        $this->dropTable('{{%homework_answer}}');
    }
}
