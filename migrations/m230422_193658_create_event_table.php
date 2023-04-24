<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%event_type}}`
 * - `{{%curriculum}}`
 */
class m230422_193658_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'duration' => $this->integer()->notNull()->defaultValue(60),
            'typeId' => $this->integer()->notNull(),
            'curriculumId' => $this->integer()->notNull(),
        ]);

        // creates index for column `typeId`
        $this->createIndex(
            '{{%idx-event-typeId}}',
            '{{%event}}',
            'typeId'
        );

        // add foreign key for table `{{%event_type}}`
        $this->addForeignKey(
            '{{%fk-event-typeId}}',
            '{{%event}}',
            'typeId',
            '{{%event_type}}',
            'id',
            'CASCADE'
        );

        // creates index for column `curriculumId`
        $this->createIndex(
            '{{%idx-event-curriculumId}}',
            '{{%event}}',
            'curriculumId'
        );

        // add foreign key for table `{{%curriculum}}`
        $this->addForeignKey(
            '{{%fk-event-curriculumId}}',
            '{{%event}}',
            'curriculumId',
            '{{%curriculum}}',
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
            '{{%fk-event-typeId}}',
            '{{%event}}'
        );

        // drops index for column `typeId`
        $this->dropIndex(
            '{{%idx-event-typeId}}',
            '{{%event}}'
        );

        // drops foreign key for table `{{%curriculum}}`
        $this->dropForeignKey(
            '{{%fk-event-curriculumId}}',
            '{{%event}}'
        );

        // drops index for column `curriculumId`
        $this->dropIndex(
            '{{%idx-event-curriculumId}}',
            '{{%event}}'
        );

        $this->dropTable('{{%event}}');
    }
}
