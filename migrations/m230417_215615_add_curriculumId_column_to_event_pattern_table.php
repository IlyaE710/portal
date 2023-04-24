<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%event_pattern}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%curriculum_pattern}}`
 */
class m230417_215615_add_curriculumId_column_to_event_pattern_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%event_pattern}}', 'curriculumId', $this->integer()->notNull());

        // creates index for column `curriculumId`
        $this->createIndex(
            '{{%idx-event_pattern-curriculumId}}',
            '{{%event_pattern}}',
            'curriculumId'
        );

        // add foreign key for table `{{%curriculum_pattern}}`
        $this->addForeignKey(
            '{{%fk-event_pattern-curriculumId}}',
            '{{%event_pattern}}',
            'curriculumId',
            '{{%curriculum_pattern}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%curriculum_pattern}}`
        $this->dropForeignKey(
            '{{%fk-event_pattern-curriculumId}}',
            '{{%event_pattern}}'
        );

        // drops index for column `curriculumId`
        $this->dropIndex(
            '{{%idx-event_pattern-curriculumId}}',
            '{{%event_pattern}}'
        );

        $this->dropColumn('{{%event_pattern}}', 'curriculumId');
    }
}
