<?php

use app\models\Project;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекти';

?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати новий проект', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
           ['class' => 'yii\grid\ActionColumn', 'template' => ' {update}'], //update view
          //  'id',
            'date',
            ['attribute'=>'exp', 'filter'=> Project::getStadList(), 'value'=> 'stadName' ],
            'title',
            'number',
            'client',
            //'designer:ntext',
            //'general:ntext',
            //'exp',

            //'engineer',
            //'viewed',
            //'status',
            ['attribute'=>'experts', 'value'=>'expertsAsString'],
            ['attribute'=>'status', 'filter'=> Project::getStatusList(), 'value'=> 'statusName' ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
