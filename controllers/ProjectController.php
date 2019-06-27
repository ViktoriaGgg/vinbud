<?php

namespace app\controllers;

use app\models\Comment;
use app\models\CommentForm;
use app\models\Expert;
use app\models\InformForm;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\Project;

class ProjectController extends Controller
{
    public function actionIndex()
    {
        $query = Project::find()->orderBy('date desc')->where(['status' => 1 ]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>4]);
        $projects = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $popular = Project::getPopular();
        $new = Project::getNew();
        $experts = Expert::find()->all();

        return $this->render('index', [
            'projects' => $projects,
            'pages' => $pages,
            'popular' => $popular,
            'new' => $new,
            'experts' => $experts,
        ]);
    }
    public function actionView($id)
    {
        $project = Project::findOne($id);
        $popular = Project::getPopular();
        $new = Project::getNew();
        $experts = Expert::find()->all();
        $comments = $project->getProjectComments();
        $commentForm = new CommentForm();
        $informs=$project->getProjectInforms();
        $informForm=new InformForm();

        $project->viewedCount();

        return $this->render('single',[
            'project'=> $project,
            'popular' => $popular,
            'new' => $new,
            'experts' => $experts,
            'comments' => $comments,
            'commentForm'=>$commentForm,
            'informs'=>$informs,
            'informForm'=>$informForm,
        ]);
    }
    public function actionComment($id)
    {
        $model = new CommentForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                // Yii::$app->getSession()->setFlash('comment', 'Ваше зауваження збережене');
                return $this->redirect(['project/view','id'=>$id]);
            }
        }
    }

    public function actionAllow($id){
        $comment = Comment::findOne($id);

        Yii::$app->getSession()->setFlash('word', 'Ваші зауваження та рекомендації збережені та відправлені');

        if($comment->allow()){
        //    Expert::findOne(3)->sendMail('example', 'Зауваження оформлені',
         //       ['paramExample' => $comment->id, 'name'=> $comment->user->expert->name, 'project' => $comment->projects->number, 'fil' => $comment->id]);

            return $this->redirect(['comment/word', 'id'=>$comment->id]);
        }

    }

    public function actionUpdate($id)
    {
        $comment = Comment::findOne($id);

        return $this->redirect(['site/comentform']);

    }
    public function actionInform($id)
    {
        $model = new InformForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveInform($id))
            {
                return $this->redirect(['project/view','id'=>$id]);
            }
        }
    }


    public function actionExpert($id)
    {
        $expert = Expert::findOne($id);
        $popular = Project::getPopular();
        $new = Project::getNew();
        $experts = Expert::find()->all();

        return $this->render('expert',[
            'expert'=> $expert,
            'popular' => $popular,
            'new' => $new,
            'experts' => $experts,

        ]);
    }

}