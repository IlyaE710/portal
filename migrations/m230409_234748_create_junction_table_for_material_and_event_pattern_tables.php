<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%material_event_pattern}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%material}}`
 * - `{{%event_pattern}}`
 */
class m230409_234748_create_junction_table_for_material_and_event_pattern_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%material_event_pattern}}', [
            'material_id' => $this->integer(),
            'event_pattern_id' => $this->integer(),
            'PRIMARY KEY(material_id, event_pattern_id)',
        ]);

        // creates index for column `material_id`
        $this->createIndex(
            '{{%idx-material_event_pattern-material_id}}',
            '{{%material_event_pattern}}',
            'material_id'
        );

        // add foreign key for table `{{%material}}`
        $this->addForeignKey(
            '{{%fk-material_event_pattern-material_id}}',
            '{{%material_event_pattern}}',
            'material_id',
            '{{%material}}',
            'id',
            'CASCADE'
        );

        // creates index for column `event_pattern_id`
        $this->createIndex(
            '{{%idx-material_event_pattern-event_pattern_id}}',
            '{{%material_event_pattern}}',
            'event_pattern_id'
        );

        // add foreign key for table `{{%event_pattern}}`
        $this->addForeignKey(
            '{{%fk-material_event_pattern-event_pattern_id}}',
            '{{%material_event_pattern}}',
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
        // drops foreign key for table `{{%material}}`
        $this->dropForeignKey(
            '{{%fk-material_event_pattern-material_id}}',
            '{{%material_event_pattern}}'
        );

        // drops index for column `material_id`
        $this->dropIndex(
            '{{%idx-material_event_pattern-material_id}}',
            '{{%material_event_pattern}}'
        );

        // drops foreign key for table `{{%event_pattern}}`
        $this->dropForeignKey(
            '{{%fk-material_event_pattern-event_pattern_id}}',
            '{{%material_event_pattern}}'
        );

        // drops index for column `event_pattern_id`
        $this->dropIndex(
            '{{%idx-material_event_pattern-event_pattern_id}}',
            '{{%material_event_pattern}}'
        );

        $this->dropTable('{{%material_event_pattern}}');
    }
}
