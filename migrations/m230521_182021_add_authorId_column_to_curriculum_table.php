<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%curriculum}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m230521_182021_add_authorId_column_to_curriculum_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%curriculum}}', 'authorId', $this->integer()->notNull());

        // creates index for column `authorId`
        $this->createIndex(
            '{{%idx-curriculum-authorId}}',
            '{{%curriculum}}',
            'authorId'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-curriculum-authorId}}',
            '{{%curriculum}}',
            'authorId',
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
            '{{%fk-curriculum-authorId}}',
            '{{%curriculum}}'
        );

        // drops index for column `authorId`
        $this->dropIndex(
            '{{%idx-curriculum-authorId}}',
            '{{%curriculum}}'
        );

        $this->dropColumn('{{%curriculum}}', 'authorId');
    }
}
