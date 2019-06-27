<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;



AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">


    <?php

    NavBar::begin([
        'brandLabel' => 'ВІНБУД-ЕКСПЕРТ',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if(Yii::$app->user->isGuest):
         echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Про нас', 'url' => ['/site/index']],
            ['label' => 'Сформувати замовлення', 'url' => ['/site/docum']],
            ['label' => 'Обовязковій експертизі пядлягають', 'url' => ['/site/obovexpertiza']],
            ['label' => 'Законодавство', 'url' => ['/site/zakon']],
            ['label' => 'Контакти', 'url' => ['/site/about']],
           // ['label' => 'Реєстрація', 'url' => ['/njhnbr/signup']],
            //  ['label' => 'Регістрація', 'url' => ['/site/signup']],
            Yii::$app->user->isGuest ? (
           // ['label' => '', 'url' => ['/njhnbr/login']]
            ['label' => '', 'url' => ['/site/error']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Вийти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'

            )
        ],
    ]);

    else:
         echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Про нас', 'url' => ['/site/index']],

            ['label' => 'Проекти', 'url' => ['/project/index']],
            ['label' => 'Статуси', 'url' => ['/status/index']],


            Yii::$app->user->isGuest ? (
            ['label' => 'Війти', 'url' => ['/njhnbr/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Вийти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'

            )
        ],
    ]);
    endif;
    NavBar::end();
    ?>



    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>





</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; ВІНБУД-ЕКПЕРТ <?= date('Y') ?></p>

        <p class="pull-right">
            Весь контент ліцензовано на умовах
            <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">
                Ліцензії Creative Commons Зазначення Авторства 4.0 Міжнародна</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
