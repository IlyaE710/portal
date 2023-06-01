<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%event_pattern}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m230528_125712_add_lector_column_to_event_pattern_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%event_pattern}}', 'lectorId', $this->integer());

        // creates index for column `lectorId`
        $this->createIndex(
            '{{%idx-event_pattern-lectorId}}',
            '{{%event_pattern}}',
            'lectorId'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-event_pattern-lectorId}}',
            '{{%event_pattern}}',
            'lectorId',
            '{{%user}}',
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
            '{{%fk-event_pattern-lectorId}}',
            '{{%event_pattern}}'
        );

        // drops index for column `lectorId`
        $this->dropIndex(
            '{{%idx-event_pattern-lectorId}}',
            '{{%event_pattern}}'
        );

        $this->dropColumn('{{%event_pattern}}', 'lectorId');
    }
}
