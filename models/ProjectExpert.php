<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_expert".
 *
 * @property int $id
 * @property int $project_id
 * @property int $expert_id
 *
 * @property Expert $expert
 * @property Project $project
 */
class ProjectExpert extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_expert';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'expert_id'], 'integer'],
            [['expert_id'], 'exist', 'skipOnError' => true, 'targetClass' => Expert::className(), 'targetAttribute' => ['expert_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'expert_id' => 'Expert ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */


}
