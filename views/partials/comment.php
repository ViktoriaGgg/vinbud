<?php
use vova07\imperavi\Widget;
use yii\helpers\Url;

/** @var $commentForm \app\models\CommentForm*/
?>
<?php if(!empty($comments)):?>

    <?php foreach($comments as $comment):?>
        <?php if($comment->isAllowed()):?>
        <div class="well bottom-comment"><!--bottom comment-->
            <div class="comment-text">


                <h4><strong><?= $comment->user->expert->name;?></strong>
                </h4> <p class="comment-date">
                    <?= $comment->getDate();?> </p><h4>
                <p class="para"><?= $comment->text; ?></p>
                </h4>
            </div> </div>

                <?php else :?>
                <?php if(Yii::$app->user->id == $comment->user_id ):?>
                <div class="well bottom-comment"><!--bottom comment-->
                <div class="comment-text">

                        <?= \yii\bootstrap\Html::a('Редагувати', ['comment/update', 'id'=>$comment->id], ['class'=>'btn btn-success pull-right'])?>
                        <a class="btn btn-primary pull-right" href="<?= Url::toRoute(['project/allow', 'id'=>$comment->id]);?>">Відправити</a>


                    <h4><strong><?= $comment->user->expert->name;?></strong>
                    </h4> <p class="comment-date">  <?= $comment->getDate();?>  </p> <h4>
                        <p class="para"><?= $comment->text; ?></p>
                    </h4>

            </div>
        </div><?php endif;?><?php endif;?>
    <?php endforeach;?>
<?php endif;?>
<!-- end bottom comment-->




    <div class="well leave-comment"><!--leave comment-->
        <h4><strong>Зауваження та рекомендації експертизи</strong></h4>

        <?php if(Yii::$app->session->getFlash('comment')):?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('comment'); ?>
            </div>
        <?php endif;?>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action'=>['project/comment', 'id'=>$project->id],
            'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>

        <div class="form-group">
            <div class="col-md-12">
                <?php
               /* $form->field($commentForm, 'comment')->widget(Widget::className(), [

                'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                'fullscreen',
                ],
                ],
                ]);*/?>
              <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Зауваження та рекомендації', 'rows' => 10])->label(false)?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти  </button>
        <?php \yii\widgets\ActiveForm::end();?>
    </div><!--end leave comment-->
