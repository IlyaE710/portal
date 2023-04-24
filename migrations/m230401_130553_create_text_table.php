<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%text}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%material}}`
 */
class m230401_130553_create_text_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%text}}', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull(),
            'material_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `material_id`
        $this->createIndex(
            '{{%idx-text-material_id}}',
            '{{%text}}',
            'material_id'
        );

        // add foreign key for table `{{%material}}`
        $this->addForeignKey(
            '{{%fk-text-material_id}}',
            '{{%text}}',
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
            '{{%fk-text-material_id}}',
            '{{%text}}'
        );

        // drops index for column `material_id`
        $this->dropIndex(
            '{{%idx-text-material_id}}',
            '{{%text}}'
        );

        $this->dropTable('{{%text}}');
    }
}
