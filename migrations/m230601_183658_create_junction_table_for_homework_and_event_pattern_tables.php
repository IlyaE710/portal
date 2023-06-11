<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%homework_event_pattern}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%homework}}`
 * - `{{%event_pattern}}`
 */
class m230601_183658_create_junction_table_for_homework_and_event_pattern_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%homework_event_pattern}}', [
            'homework_id' => $this->integer(),
            'event_pattern_id' => $this->integer(),
            'PRIMARY KEY(homework_id, event_pattern_id)',
        ]);

        // creates index for column `homework_id`
        $this->createIndex(
            '{{%idx-homework_event_pattern-homework_id}}',
            '{{%homework_event_pattern}}',
            'homework_id'
        );

        // add foreign key for table `{{%homework}}`
        $this->addForeignKey(
            '{{%fk-homework_event_pattern-homework_id}}',
            '{{%homework_event_pattern}}',
            'homework_id',
            '{{%homework}}',
            'id',
            'CASCADE'
        );

        // creates index for column `event_pattern_id`
        $this->createIndex(
            '{{%idx-homework_event_pattern-event_pattern_id}}',
            '{{%homework_event_pattern}}',
            'event_pattern_id'
        );

        // add foreign key for table `{{%event_pattern}}`
        $this->addForeignKey(
            '{{%fk-homework_event_pattern-event_pattern_id}}',
            '{{%homework_event_pattern}}',
            'event_pattern_id',
            '{{%event_pattern}}',
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
            '{{%fk-homework_event_pattern-homework_id}}',
            '{{%homework_event_pattern}}'
        );

        // drops index for column `homework_id`
        $this->dropIndex(
            '{{%idx-homework_event_pattern-homework_id}}',
            '{{%homework_event_pattern}}'
        );

        // drops foreign key for table `{{%event_pattern}}`
        $this->dropForeignKey(
            '{{%fk-homework_event_pattern-event_pattern_id}}',
            '{{%homework_event_pattern}}'
        );

        // drops index for column `event_pattern_id`
        $this->dropIndex(
            '{{%idx-homework_event_pattern-event_pattern_id}}',
            '{{%homework_event_pattern}}'
        );

        $this->dropTable('{{%homework_event_pattern}}');
    }
}
