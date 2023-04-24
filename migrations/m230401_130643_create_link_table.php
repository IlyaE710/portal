<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%link}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%material}}`
 */
class m230401_130643_create_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%link}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'description' => $this->text(),
            'material_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `material_id`
        $this->createIndex(
            '{{%idx-link-material_id}}',
            '{{%link}}',
            'material_id'
        );

        // add foreign key for table `{{%material}}`
        $this->addForeignKey(
            '{{%fk-link-material_id}}',
            '{{%link}}',
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
            '{{%fk-link-material_id}}',
            '{{%link}}'
        );

        // drops index for column `material_id`
        $this->dropIndex(
            '{{%idx-link-material_id}}',
            '{{%link}}'
        );

        $this->dropTable('{{%link}}');
    }
}
