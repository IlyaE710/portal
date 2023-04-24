<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%material_event}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%material}}`
 * - `{{%event}}`
 */
class m230422_194046_create_junction_table_for_material_and_event_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%material_event}}', [
            'material_id' => $this->integer(),
            'event_id' => $this->integer(),
            'PRIMARY KEY(material_id, event_id)',
        ]);

        // creates index for column `material_id`
        $this->createIndex(
            '{{%idx-material_event-material_id}}',
            '{{%material_event}}',
            'material_id'
        );

        // add foreign key for table `{{%material}}`
        $this->addForeignKey(
            '{{%fk-material_event-material_id}}',
            '{{%material_event}}',
            'material_id',
            '{{%material}}',
            'id',
            'CASCADE'
        );

        // creates index for column `event_id`
        $this->createIndex(
            '{{%idx-material_event-event_id}}',
            '{{%material_event}}',
            'event_id'
        );

        // add foreign key for table `{{%event}}`
        $this->addForeignKey(
            '{{%fk-material_event-event_id}}',
            '{{%material_event}}',
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
        // drops foreign key for table `{{%material}}`
        $this->dropForeignKey(
            '{{%fk-material_event-material_id}}',
            '{{%material_event}}'
        );

        // drops index for column `material_id`
        $this->dropIndex(
            '{{%idx-material_event-material_id}}',
            '{{%material_event}}'
        );

        // drops foreign key for table `{{%event}}`
        $this->dropForeignKey(
            '{{%fk-material_event-event_id}}',
            '{{%material_event}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            '{{%idx-material_event-event_id}}',
            '{{%material_event}}'
        );

        $this->dropTable('{{%material_event}}');
    }
}
