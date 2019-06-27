<?php

use app\models\Status;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\StatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статус експертів';

?>
<div class="status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'project_number',
            'project',
            'expert',

            // 'id',
            //'user_id',
            //'project_id',
            //'status',
            ['attribute'=>'status', 'filter'=> Status::getStatusList(), 'value'=> 'statusName' ],
            'date',

            ['class' => 'yii\grid\ActionColumn', 'template' => ' {update}'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
