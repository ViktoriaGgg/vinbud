<?php
$this->title = 'ВІНБУД-ЕКСПЕРТ';

?>
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <article class="well well-lg">

                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h4> <?= $project->number;?></h4>

                            <h2 class="entry-title"><?= $project->title;?></h2>


                        </header>
                        <div class="entry-content">
                            <p>
                            <h4><strong>Замовник - </strong>
                                <?= $project->client;?></h4>
                            </p>
                            <p>
                            <h4><strong>Генеральний проектувальник - </strong>
                                <?= $project->general;?></h4>
                            </p>

                            <p>
                            <h4><strong>Пректувальник - </strong>
                                <?= $project->designer;?></h4>
                            </p>
                            <p>
                            <h4><strong>Експерти - </strong>
                                <?= $project->getExpertsAsString(); ?>
                            </h4>
                            </p>
                            <p>
                            <h4><strong>Головний інженер проекту - </strong>
                                <?= $project->engineer; ?>
                            </h4>
                            </p>
                        </div>

                        <div class="social-share">

							<span
                                    class="social-share-title pull-left text-capitalize"><?= $project->getDate();?></span>

                        </div>
                        
                    </div>
                </article>


                <?= $this->render('/partials/comment', [
                    'project' => $project,
                    'comments' => $comments,
                    'commentForm' => $commentForm,
                ]);?>

            </div>
            <div class="col-md-4" data-sticky_column>
                <?=
                $this->render('/partials/inform', [
                    'informs' => $informs,
                    'informForm'=>$informForm,
                    'experts' => $experts,
                    'project' => $project,
                ]);?>
            </div>
        </div>
    </div>
</div>
<!-- end main content-->