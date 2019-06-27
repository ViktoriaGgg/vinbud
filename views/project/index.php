<?php

/* @var $this yii\web\View */
/* @var $projects  yii\web\View*/


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'ВІНБУД-ЕКСПЕРТ';

?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                foreach ($projects as $project):?>

                    <article class="well">

                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                <h4><a href="<?= Url::toRoute(['project/view', 'id'=>$project->id]);?>"> <?= $project->number;?></a></h4>

                                <h2 class="entry-title"><a href="<?= Url::toRoute(['project/view', 'id'=>$project->id]);?>"><?= $project->title;?></a></h2>


                            </header>
                            <div class="entry-content">
                                <p>
                                <h4><strong>Замовник - </strong>
                                    <?= $project->client;?></h4>
                                </p>
                                <p>
                                <h4><strong>Експерти - </strong>
                                    <?= $project->getExpertsAsString(); ?>
                                </h4>
                                </p>

                                <div class="btn-continue-reading text-center text-uppercase">
                                    <a href="<?= Url::toRoute(['project/view', 'id'=>$project->id]);?>" class="btn btn-primary">Детальніше</a>
                                </div>
                            </div>
                            <div class="social-share">
                                <span ><?= $project->getDate();?></span>
                                <!-- <ul class="text-center pull-right">
                                    <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li><?= (int) $project->viewed;?>
                                </ul>-->
                            </div>
                        </div>
                    </article>

                <?php endforeach; ?>
                <div class="pagination">
                <?php
                echo LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
                </div>
            </div>

            <div class="col-md-4" data-sticky_column>
                <?=
                $this->render('/partials/sidebar', [
                    'popular' => $popular,
                    'new' => $new,
                    'experts' => $experts,
                ]);?>
            </div>
        </div>
    </div>
</div>
