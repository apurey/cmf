<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\language\models\Language */

$this->title = Yii::t(
        'yii',
        'Update {modelClass}: ',
        [
            'modelClass' => Yii::t('language', 'Language'),
        ]
    ) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('language', 'Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<div class="language-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
