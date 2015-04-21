<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Role */
/* @var $permissions [] */
/* @var $roles [] */

$this->title = Yii::t(
    'yii',
    'Create {modelClass}',
    [
        'modelClass' => Yii::t('item', 'Role'),
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('item', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

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
