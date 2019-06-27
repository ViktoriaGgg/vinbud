<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project`.
 */
class m180617_133446_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'date'=>$this->date(),
            'title'=>$this->string(),
            'number'=>$this->string(),
            'client'=>$this->string(),
            'designer'=>$this->text(),
            'general'=>$this->text(),
            'exp'=>$this->string(),
            'engineer'=>$this->string(),
            'viewed'=>$this->integer()->defaultValue(0),
            'status'=>$this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('project');
    }
}
