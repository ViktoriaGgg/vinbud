<?php

use yii\db\Migration;

/**
 * Handles the creation of table `status`.
 */
class m180617_185639_create_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('status', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'project_id'=>$this->integer(),
            'status'=>$this->integer(),
            'date'=>$this->date(),
            'expert'=>$this->string(),
            'project'=>$this->string(),
            'project_number'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('status');
    }
}
