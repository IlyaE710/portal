<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%curriculum_pattern}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%subject}}`
 */
class m230417_214529_create_curriculum_pattern_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%curriculum_pattern}}', [
            'id' => $this->primaryKey(),
            'subjectId' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
        ]);

        // creates index for column `subjectId`
        $this->createIndex(
            '{{%idx-curriculum_pattern-subjectId}}',
            '{{%curriculum_pattern}}',
            'subjectId'
        );

        // add foreign key for table `{{%subject}}`
        $this->addForeignKey(
            '{{%fk-curriculum_pattern-subjectId}}',
            '{{%curriculum_pattern}}',
            'subjectId',
            '{{%subject}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%subject}}`
        $this->dropForeignKey(
            '{{%fk-curriculum_pattern-subjectId}}',
            '{{%curriculum_pattern}}'
        );

        // drops index for column `subjectId`
        $this->dropIndex(
            '{{%idx-curriculum_pattern-subjectId}}',
            '{{%curriculum_pattern}}'
        );

        $this->dropTable('{{%curriculum_pattern}}');
    }
}
