<?php

use app\models\Status;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Status */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="status-form">
    <?php $model->status=1;?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList(Status::getStatusList()) ?>

    <?= $form->field($model, 'date')->widget(
        DatePicker::className(), [
        // inline too, not bad
        //'inline' => false,
        // modify template for custom rendering
        'language' => 'ru',
        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d',
            'startDate' => false,

        ]
    ]);?>
    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
