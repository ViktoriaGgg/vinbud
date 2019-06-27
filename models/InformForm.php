<?php

namespace app\models;

use Yii;
use yii\base\Model;

class InformForm extends Model
{
    public $inform;
    
    public function rules()
    {
        return [
            [['inform'], 'required'],
            [['inform'], 'string']
        ];
    }

    public function saveInform($project_id)
    {
        $inform = new Inform;
        $inform->text = $this->inform;
        $inform->user_id = Yii::$app->user->id;
        $inform->project_id = $project_id;
        $inform->date = date('Y-m-d');
        return $inform->save();

    }
}