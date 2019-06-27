<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */

$this->title = 'ВІНБУД-ЕКСПЕРТ';

?>
<div class="comment-update">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <div class="col-md-12">

            <?php/*
            $form->field($model, 'text')->widget(Widget::className(), [

                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 400,
                    'plugins' => [
                        'fullscreen',
                    ],
                ],
            ]);*/?>
            <?= $form->field($model, 'text')->textarea(['class'=>'form-control', 'rows' => 25])->label(false)?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
