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
                        <?php $q=0;?>
                        <?php foreach($expert->projects as $one):?>

                        <?php if($one->status !==3):?>
                            <?php $q+=1;
                        endif;?>

                    <?php endforeach;?>

                        <span class="post-count pull-right"><p>(<?= $q ;?>) Всього (<?= $expert->getProjects()->count();?>)</p></span>

                    </h4>
                </li>

            <?php endforeach;?>
        </ul>
    </aside>
    <aside class="well widget">
        <h3 class="widget-title text-uppercase text-center">Проекти на розгляді</h3>

        <?php

        foreach ($popular as $project):?>

            <div class="popular-post">

                <div class="p-content">
                    <h4>
                    <a href="<?= Url::toRoute(['project/view', 'id'=>$project->id]);?>"  class="text-uppercase"><?= $project->title;?></a>
                    </h4>
                        <span class="p-date"><?= $project->getDate();?></span>

                </div>
            </div>

        <?php endforeach;?>

    </aside>
    <aside class="well widget pos-padding">
        <h3 class="widget-title text-uppercase text-center">Нові проекти</h3>

        <?php
        foreach ($new as $project):?>

            <div class="thumb-latest-posts">


                <div class="media">
                    <div class="media-left">



                    </div>
                    <div class="p-content"><h4>
                        <a href="<?= Url::toRoute(['project/view', 'id'=>$project->id]);?>" class="text-uppercase"><?= $project->title;?></a>
                        </h4>
                            <span class="p-date"><?= $project->getDate();?></span>
                    </div>
                </div>
            </div>

        <?php endforeach;?>

    </aside>

</div>