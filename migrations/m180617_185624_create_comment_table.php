<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m180617_185624_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'text'=>$this->text(),
            'user_id'=>$this->integer(),
            'project_id'=>$this->integer(),
            'status'=>$this->integer(),
            'date'=>$this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comment');
    }
}
