<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inform".
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property int $project_id
 * @property string $date
 */
class Inform extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inform';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['user_id', 'project_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'user_id' => 'User ID',
            'project_id' => 'Project ID',
            'date' => 'Date',
        ];
    }
    public function getDate()
    {

        return Yii::$app->formatter->asDate($this->date,  $format = 'long');
    }
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
