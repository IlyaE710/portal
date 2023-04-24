<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_pattern}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%event_type}}`
 */
class m230409_233622_create_event_pattern_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_pattern}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'typeId' => $this->integer()->notNull(),
        ]);

        // creates index for column `typeId`
        $this->createIndex(
            '{{%idx-event_pattern-typeId}}',
            '{{%event_pattern}}',
            'typeId'
        );

        // add foreign key for table `{{%event_type}}`
        $this->addForeignKey(
            '{{%fk-event_pattern-typeId}}',
            '{{%event_pattern}}',
            'typeId',
            '{{%event_type}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%event_type}}`
        $this->dropForeignKey(
            '{{%fk-event_pattern-typeId}}',
            '{{%event_pattern}}'
        );

        // drops index for column `typeId`
        $this->dropIndex(
            '{{%idx-event_pattern-typeId}}',
            '{{%event_pattern}}'
        );

        $this->dropTable('{{%event_pattern}}');
    }
}
