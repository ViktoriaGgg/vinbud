<?php

use yii\db\Migration;

/**
 * Handles the creation of table `expert`.
 */
class m180617_185531_create_expert_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('expert', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'email'=>$this->string()->defaultValue(null),
            'mobile'=>$this->string(),
            'description'=>$this->text(),
            'user_id'=>$this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('expert');
    }
}
