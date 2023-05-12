<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_group}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%group}}`
 */
class m230512_194939_create_junction_table_for_user_and_group_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_group}}', [
            'user_id' => $this->integer(),
            'group_id' => $this->integer(),
            'PRIMARY KEY(user_id, group_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_group-user_id}}',
            '{{%user_group}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_group-user_id}}',
            '{{%user_group}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `group_id`
        $this->createIndex(
            '{{%idx-user_group-group_id}}',
            '{{%user_group}}',
            'group_id'
        );

        // add foreign key for table `{{%group}}`
        $this->addForeignKey(
            '{{%fk-user_group-group_id}}',
            '{{%user_group}}',
            'group_id',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-user_group-user_id}}',
            '{{%user_group}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_group-user_id}}',
            '{{%user_group}}'
        );

        // drops foreign key for table `{{%group}}`
        $this->dropForeignKey(
            '{{%fk-user_group-group_id}}',
            '{{%user_group}}'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            '{{%idx-user_group-group_id}}',
            '{{%user_group}}'
        );

        $this->dropTable('{{%user_group}}');
    }
}
