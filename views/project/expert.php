<?php
use yii\helpers\Url;
$this->title = 'ВІНБУД-ЕКСПЕРТ';

?>
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3> <strong><?= $expert->name;?> </strong> працює з проектами:</h3>
                <?php

                foreach ($expert->projects as $one):?>

                    <?php if($one->status !==3):?>

                    <article class="well well-lg">

                    <div class="post-content">


                            <header class="entry-header text-center text-uppercase">
                                <h4><a href="<?= Url::toRoute(['project/view', 'id'=>$one->id]);?>"> <?= $one->number;?></a></h4>
                                <h2 class="entry-title"><a href="<?= Url::toRoute(['project/view', 'id'=>$one->id]);?>"><?= $one->title;?></a></h2>


                            </header>
                            <div class="entry-content">
                                <p>
                                <h4><strong>Замовник - </strong>
                                    <?= $one->client;?></h4>

                                </p>
                                <p>
                                <h4><strong>Генеральний проектувальний - </strong>
                                    <?= $one->general;?></h4>
                                </p>

                                <p>
                                <h4><strong>Пректувальник - </strong>
                                    <?= $one->designer;?></h4>
                                </p>
                                <p>
                                <h4><strong>Експерти - </strong>
                                    <?= $one->getExpertsAsString(); ?>
                                </h4>
                                </p>
                            </div>

                            <div class="social-share">
							<span
                                    class="social-share-title pull-left text-capitalize"><?= $one->getDate();?></span>

                            </div>
                        <div class="btn-continue-reading text-right text-uppercase">
                            <a href="<?= Url::toRoute(['project/view', 'id'=>$one->id]);?>" class="btn btn-primary">Детальніше</a>
                        </div>





                    </div>

                </article>
                <?php endif;?>
                <?php endforeach;?>

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
<!-- end main content-->