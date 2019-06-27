<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $comment;
    
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string']
        ];
    }

    public function saveComment($project_id)
    {
        $comment = new Comment;
        $comment->text = $this->comment;
        $comment->user_id = Yii::$app->user->id;
        $comment->project_id = $project_id;
        $comment->status = 0;
        $comment->date = date('Y-m-d');
        return $comment->save();

    }
}