<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%event}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m230528_125729_add_lector_column_to_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%event}}', 'lectorId', $this->integer());

        // creates index for column `lectorId`
        $this->createIndex(
            '{{%idx-event-lectorId}}',
            '{{%event}}',
            'lectorId'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-event-lectorId}}',
            '{{%event}}',
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
            '{{%fk-event-lectorId}}',
            '{{%event}}'
        );

        // drops index for column `lectorId`
        $this->dropIndex(
            '{{%idx-event-lectorId}}',
            '{{%event}}'
        );

        $this->dropColumn('{{%event}}', 'lectorId');
    }
}
