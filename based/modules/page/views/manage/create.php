<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\page\models\Page */
/* @var $layouts [] */
/* @var $templates [] */
/* @var $active [] */

$this->title = Yii::t(
    'yii',
    'Create {modelClass}',
    [
        'modelClass' => Yii::t('page', 'Page'),
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('page', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

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
