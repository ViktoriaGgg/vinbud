<?php
use yii\helpers\Url;
/** @var  $new */
/** @var  $experts */
/** @var  $popular */

?>
<div class="primary-sidebar">

    <aside class="well widget border pos-padding">
        <h3 class="widget-title text-uppercase text-center">Експерти</h3>
        <ul>

            <?php foreach ($experts as $expert):?>

                <li><h4>
                        <a href="<?=
                        Url::toRoute(['project/expert', 'id'=>$expert->id]);?>"><?= $expert->name;?></a>
                        <span class="post-count pull-right"> (<?= $expert->getProjects()->count();?>)</span>
                    </h4>
                </li>

            <?php endforeach;?>
        </ul>
    </aside>

    <aside class="well widget border pos-padding">
        <h3 class="widget-title text-uppercase text-center">Корисна інформація</h3>

    <?php if(!empty($informs)):?>

        <?php foreach($informs as $inform):?>

            <div class="well bottom-comment"><!--bottom comment-->

                <div class="comment-text">
                    <h4>
                        <strong class="para"><strong></strong><?= $inform->text; ?></strong></p>
                    </h4>
                    <p class="comment-date">
                        <?= $inform->date;?>
                    </p>
                    <h4><?= $inform->user->expert->name;?></h4>



                </div>
            </div>

        <?php endforeach;?>

    <?php endif;?>
    <!-- end bottom comment-->
    </aside>
    <div class="well leave-comment">
        <h3 class="widget-title text-uppercase text-center">Це може бути потрібне іншим експертам</h3>
    <?php $form = \yii\widgets\ActiveForm::begin([
        'action'=>['project/inform', 'id'=>$project->id],
        'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>

    <div class="form-group">
        <div class="col-md-12">
            <?=
                      $form->field($informForm, 'inform')->textarea(['class'=>'form-control','placeholder'=>'Корисна інформація по проекту', 'rows' => 10])->label(false)?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Зберегти  </button>
    <?php \yii\widgets\ActiveForm::end();?>

    </div>
</div>