<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%material_tag}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%material}}`
 * - `{{%tag}}`
 */
class m230401_130724_create_junction_table_for_material_and_tag_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%material_tag}}', [
            'material_id' => $this->integer(),
            'tag_id' => $this->integer(),
            'PRIMARY KEY(material_id, tag_id)',
        ]);

        // creates index for column `material_id`
        $this->createIndex(
            '{{%idx-material_tag-material_id}}',
            '{{%material_tag}}',
            'material_id'
        );

        // add foreign key for table `{{%material}}`
        $this->addForeignKey(
            '{{%fk-material_tag-material_id}}',
            '{{%material_tag}}',
            'material_id',
            '{{%material}}',
            'id',
            'CASCADE'
        );

        // creates index for column `tag_id`
        $this->createIndex(
            '{{%idx-material_tag-tag_id}}',
            '{{%material_tag}}',
            'tag_id'
        );

        // add foreign key for table `{{%tag}}`
        $this->addForeignKey(
            '{{%fk-material_tag-tag_id}}',
            '{{%material_tag}}',
            'tag_id',
            '{{%tag}}',
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
            '{{%fk-material_tag-material_id}}',
            '{{%material_tag}}'
        );

        // drops index for column `material_id`
        $this->dropIndex(
            '{{%idx-material_tag-material_id}}',
            '{{%material_tag}}'
        );

        // drops foreign key for table `{{%tag}}`
        $this->dropForeignKey(
            '{{%fk-material_tag-tag_id}}',
            '{{%material_tag}}'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            '{{%idx-material_tag-tag_id}}',
            '{{%material_tag}}'
        );

        $this->dropTable('{{%material_tag}}');
    }
}
