<?php

use app\models\Expert;
use app\models\Project;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'Редагувати проект: ' . $model->title;
?>
<div class="project-update">

    <h1><?= Html::encode($this->title) ?></h1>



    <div class="project-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'exp')->dropDownList(Project::getStadList()) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'client')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'designer')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'general')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'engineer')->textInput(['maxlength' => true]) ?>


        <?= $form->field($model, 'status')->dropDownList(Project::getStatusList()) ?>

        <div class="form-group">
            <?= Html::a('Редагувати експертів', ['set-experts', 'id' => $model->id], ['class' => 'btn btn-success pull-right']) ?>

            <?= Html::submitButton('Зберегти', ['class' => 'btn btn-primary']) ?>



        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
