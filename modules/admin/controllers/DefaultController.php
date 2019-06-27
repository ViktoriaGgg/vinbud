<?php

namespace app\modules\admin\controllers;

use app\models\Project;
use app\models\ProjectSearch;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $query = Project::find()->orderBy('date desc')->where(['status' => 3]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>4]);
        $projects = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'projects' => $projects,
            'pages' => $pages,
        ]);
        //$model = Project::find()->all();
        //return $this->render('index', ['model'=>$model]);
       // return $this->render('index');
    }
}
