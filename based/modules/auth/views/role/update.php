<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Role */
/* @var $permissions [] */
/* @var $roles [] */

$this->title = Yii::t(
        'yii',
        'Update {modelClass}: ',
        [
            'modelClass' => Yii::t('item', 'Role'),
        ]
    ) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('item', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'name' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<div class="role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render(
        '_form',
        [
            'model' => $model,
            'permissions' => $permissions,
            'roles' => $roles,
        ]
    ) ?>

</div>
