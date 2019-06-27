<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project_expert`.
 */
class m180627_182737_create_project_expert_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project_expert', [
            'id' => $this->primaryKey(),
            'project_id'=>$this->integer(),
            'expert_id'=>$this->integer(),
            ]);

        // creates index for column `project_id`
        $this->createIndex(
            'idx_project_project_id',
            'project_expert',
            'project_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'chain_to_project',
            'project_expert',
            'project_id',
            'project',
            'id',
            'CASCADE'
        );
        // creates index for column `expert_id`
        $this->createIndex(
            'idx_project_expert_id',
            'project_expert',
            'expert_id'
        );
        // add foreign key for table `expert`
        $this->addForeignKey(
            'chain_to_expert',
            'project_expert',
            'expert_id',
            'expert',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('project_expert');
        // drops foreign key for table `project`
        $this->dropForeignKey(
            'chain_to_project',
            'project_expert'
        );
        $this->dropIndex(
            'idx_project_project_id',
            'project_expert'
        );
        // add foreign key for table `expert`
        $this->dropForeignKey(
            'chain_to_expert',
            'project_expert'
        );
        $this->dropIndex(
            'idx_project_expert_id',
            'project_expert'
        );
    }
}
