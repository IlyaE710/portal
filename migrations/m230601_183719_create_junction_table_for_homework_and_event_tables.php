<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%homework_event}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%homework}}`
 * - `{{%event}}`
 */
class m230601_183719_create_junction_table_for_homework_and_event_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%homework_event}}', [
            'homework_id' => $this->integer(),
            'event_id' => $this->integer(),
            'PRIMARY KEY(homework_id, event_id)',
        ]);

        // creates index for column `homework_id`
        $this->createIndex(
            '{{%idx-homework_event-homework_id}}',
            '{{%homework_event}}',
            'homework_id'
        );

        // add foreign key for table `{{%homework}}`
        $this->addForeignKey(
            '{{%fk-homework_event-homework_id}}',
            '{{%homework_event}}',
            'homework_id',
            '{{%homework}}',
            'id',
            'CASCADE'
        );

        // creates index for column `event_id`
        $this->createIndex(
            '{{%idx-homework_event-event_id}}',
            '{{%homework_event}}',
            'event_id'
        );

        // add foreign key for table `{{%event}}`
        $this->addForeignKey(
            '{{%fk-homework_event-event_id}}',
            '{{%homework_event}}',
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%homework}}`
        $this->dropForeignKey(
            '{{%fk-homework_event-homework_id}}',
            '{{%homework_event}}'
        );

        // drops index for column `homework_id`
        $this->dropIndex(
            '{{%idx-homework_event-homework_id}}',
            '{{%homework_event}}'
        );

        // drops foreign key for table `{{%event}}`
        $this->dropForeignKey(
            '{{%fk-homework_event-event_id}}',
            '{{%homework_event}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            '{{%idx-homework_event-event_id}}',
            '{{%homework_event}}'
        );

        $this->dropTable('{{%homework_event}}');
    }
}
