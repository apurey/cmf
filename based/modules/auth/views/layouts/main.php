<?php

use yii\helpers\Html;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use app\modules\language\widgets\LanguageWidget;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
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
    NavBar::end();
    ?>

    <div class="container">
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
