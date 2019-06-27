<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property int $status
 * @property string $date
 * @property string $expert
 * @property string $project
 * @property string $project_number
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'project_id', 'status'], 'integer'],
            [['date'], 'safe'],

            [['expert', 'project'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'project_id' => Yii::t('app', 'Project ID'),
            'status' => Yii::t('app', 'Статус'),
            'date' => Yii::t('app', 'Дата'),
            'expert' => Yii::t('app', 'Експерт'),
            'project' => Yii::t('app', 'Назва проекта'),
            'project_number' => Yii::t('app', 'Номер проекта'),
        ];
    }
    public static function getStatusList(){
        return ['Не розглядався', 'ПКД передано експерту', 'Завершено'];
    }
    public function getStatusName(){
        $list=self::getStatusList();
        return $list[$this->status];
    }

}
