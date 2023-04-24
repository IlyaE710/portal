<?php

use yii\db\Migration;

/**
 * Class m230401_173453_yii_add_column
 */
class m230401_173453_yii_add_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('file', 'hashCode', $this->string(32));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('file', 'hashCode');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230401_173453_yiiAddcolumn cannot be reverted.\n";

        return false;
    }
    */
}
