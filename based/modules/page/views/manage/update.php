<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\page\models\Page */
/* @var $layouts [] */
/* @var $templates [] */
/* @var $active [] */

$this->title = Yii::t(
        'yii',
        'Update {modelClass}: ',
        [
            'modelClass' => Yii::t('page', 'Page'),
        ]
    ) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('page', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<div class="page-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render(
        '_form',
        [
            'model' => $model,
            'layouts' => $layouts,
            'templates' => $templates,
            'active' => $active,
        ]
    ) ?>

</div>
