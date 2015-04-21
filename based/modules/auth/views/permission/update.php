<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Permission */

$this->title = Yii::t(
        'yii',
        'Update {modelClass}: ',
        [
            'modelClass' => Yii::t('item', 'Permission'),
        ]
    ) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('item', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'name' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<div class="permission-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
