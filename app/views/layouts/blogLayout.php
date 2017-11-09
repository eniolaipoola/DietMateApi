<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 10/24/17
 * Time: 12:29 AM
 */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
    <?= Html::csrfMetaTags() ?>
    <title> <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>

<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Dietitian Dashboard',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/base/index']],
            /*['label' => 'Dietitian', 'url'=>['/blog/index']],
            ['label' => 'Login', 'url' => ['/site/#']],
            ['label' => 'Sign Up', 'url'=>['/ site/#']],*/
        ],
    ]);
    NavBar::end();
    ?>
</div>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= $content ?>
</div>

<!--<div class="wrap">
    <div class="container">
        <?/*= $content */?>
    </div>
</div>-->


</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"> @Enny 2017 <?= date('Y')?></p>
        <p class="pull-right"> <?= Yii::powered() ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>



</html>

<?php $this->endPage() ?>
