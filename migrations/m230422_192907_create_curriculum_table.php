<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%curriculum}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%subject}}`
 */
class m230422_192907_create_curriculum_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%curriculum}}', [
            'id' => $this->primaryKey(),
            'subjectId' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            'semester' => $this->integer()->notNull()->defaultValue(1),
            'image' => $this->text()->defaultValue('thumb.png'),
        ]);

        // creates index for column `subjectId`
        $this->createIndex(
            '{{%idx-curriculum-subjectId}}',
            '{{%curriculum}}',
            'subjectId'
        );

        // add foreign key for table `{{%subject}}`
        $this->addForeignKey(
            '{{%fk-curriculum-subjectId}}',
            '{{%curriculum}}',
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
            '{{%fk-curriculum-subjectId}}',
            '{{%curriculum}}'
        );

        // drops index for column `subjectId`
        $this->dropIndex(
            '{{%idx-curriculum-subjectId}}',
            '{{%curriculum}}'
        );

        $this->dropTable('{{%curriculum}}');
    }
}
