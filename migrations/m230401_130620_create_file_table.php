<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%file}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%material}}`
 */
class m230401_130620_create_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'filename' => $this->text()->notNull(),
            'path' => $this->text()->notNull(),
            'size' => $this->integer()->notNull(),
            'extension' => $this->string(10)->notNull(),
            'material_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `material_id`
        $this->createIndex(
            '{{%idx-file-material_id}}',
            '{{%file}}',
            'material_id'
        );

        // add foreign key for table `{{%material}}`
        $this->addForeignKey(
            '{{%fk-file-material_id}}',
            '{{%file}}',
            'material_id',
            '{{%material}}',
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
            '{{%fk-file-material_id}}',
            '{{%file}}'
        );

        // drops index for column `material_id`
        $this->dropIndex(
            '{{%idx-file-material_id}}',
            '{{%file}}'
        );

        $this->dropTable('{{%file}}');
    }
}
