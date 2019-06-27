<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Expert */

$this->title = 'Додати експерта';
?>
<div class="expert-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
