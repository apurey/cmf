<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\modules\language\widgets\LanguageWidget;
use app\modules\cp\widgets\NavWidget;

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
            'brandLabel' => Yii::$app->id,
            'brandOptions' => ['target' => '_blank'],
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
                'style' => 'z-index: 1051',
            ],
        ]
    );
    echo Nav::widget(
        [
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                [
                    'label' => ArrayHelper::getValue(Yii::$app->user->identity, 'login') . ' ( ' . Yii::t(
                            'auth',
                            'Logout'
                        ) . ' )',
                    'url' => ['/cp/logout'],
                ],
            ],
        ]
    );
    echo LanguageWidget::widget(
        [
            'options' => ['class' => 'navbar-nav navbar-right'],
        ]
    );
    echo NavWidget::widget(
        [
            'options' => ['class' => 'navbar-nav navbar-left'],
        ]
    );
    NavBar::end();
    ?>
    <div class="container">
        <?=
        Breadcrumbs::widget(
            [
                'homeLink' => [
                    'label' => Yii::t('cp', 'Administration'),
                    'url' => ['/cp'],
                ],
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
