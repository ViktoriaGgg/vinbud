<?php

use yii\db\Migration;

/**
 * Handles the creation of table `inform`.
 */
class m180710_190449_create_inform_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('inform', [
            'id' => $this->primaryKey(),
            'text'=>$this->text(),
            'user_id'=>$this->integer(),
            'project_id'=>$this->integer(),
            'date'=>$this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('inform');
    }
}
