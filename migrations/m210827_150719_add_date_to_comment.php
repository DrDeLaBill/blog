<?php

use yii\db\Migration;

/**
 * Class m210827_150719_add_date_to_comment
 */
class m210827_150719_add_date_to_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'comment',
            'date',
            $this->date()->defaultValue(date('Y-m-d'))
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(
            'comment',
            'date'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210827_150719_add_date_to_comment cannot be reverted.\n";

        return false;
    }
    */
}
