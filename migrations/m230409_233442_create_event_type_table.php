<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_type}}`.
 */
class m230409_233442_create_event_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event_type}}');
    }
}
