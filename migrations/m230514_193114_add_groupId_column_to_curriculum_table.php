<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%curriculum}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%group}}`
 */
class m230514_193114_add_groupId_column_to_curriculum_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%curriculum}}', 'groupId', $this->integer());

        // creates index for column `groupId`
        $this->createIndex(
            '{{%idx-curriculum-groupId}}',
            '{{%curriculum}}',
            'groupId'
        );

        // add foreign key for table `{{%group}}`
        $this->addForeignKey(
            '{{%fk-curriculum-groupId}}',
            '{{%curriculum}}',
            'groupId',
            '{{%group}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%group}}`
        $this->dropForeignKey(
            '{{%fk-curriculum-groupId}}',
            '{{%curriculum}}'
        );

        // drops index for column `groupId`
        $this->dropIndex(
            '{{%idx-curriculum-groupId}}',
            '{{%curriculum}}'
        );

        $this->dropColumn('{{%curriculum}}', 'groupId');
    }
}
