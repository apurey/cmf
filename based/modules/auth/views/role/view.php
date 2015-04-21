<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Role */
/* @var $permissions [] */
/* @var $roles [] */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('item', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update', 'name' => $model->name], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(
            Yii::t('yii', 'Delete'),
            ['delete', 'name' => $model->name],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]
        ) ?>
    </p>

    <?=
    DetailView::widget(
        [
            'model' => $model,
            'attributes' => [
                'name',
                'description:ntext',
            ],
        ]
    ) ?>

    <div class="col-lg">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('item', 'Permissions') ?>
            </div>

            <div class="panel-body">
                <div class="list-group">
                    <?php foreach ($model->permissions as $permission) { ?>
                        <a class="list-group-item">
                            <?= ArrayHelper::getValue($permissions, $permission) ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('item', 'Roles') ?>
            </div>

            <div class="panel-body">
                <div class="list-group">
                    <?php foreach ($model->roles as $role) { ?>
                        <a class="list-group-item">
                            <?= ArrayHelper::getValue($roles, $role) ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>
