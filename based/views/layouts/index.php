<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\SiteAsset;
use app\modules\language\widgets\LanguageWidget;

/* @var $this \yii\web\View */
/* @var $content string */

SiteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin(
        [
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]
    );
    echo LanguageWidget::widget(
        [
            'options' => ['class' => 'navbar-nav navbar-left'],
        ]
    );
    echo Nav::widget(
        [
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Home', 'url' => ['/index']],
                ['label' => 'About', 'url' => ['/about']],
                ['label' => 'Control Panel', 'url' => ['/cp']],
            ],
        ]
    );
    NavBar::end();
    ?>

    <div class="container">
        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->id ?> <?= date('Y') ?></p>

        <p class="pull-right">
            <?=
            Yii::t(
                'yii',
                'Framework {version_core}',
                [
                    'version_core' => Yii::getVersion(),
                ]
            ) ?>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
