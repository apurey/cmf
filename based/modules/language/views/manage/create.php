<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\language\models\Language */

$this->title = Yii::t(
    'yii',
    'Create {modelClass}',
    [
        'modelClass' => Yii::t('language', 'Language'),
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('language', 'Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
