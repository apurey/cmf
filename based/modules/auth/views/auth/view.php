<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Auth */
/* @var $blocked [] */
/* @var $rbac [] */

$this->title = $model->login;
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Auth'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(
            Yii::t('yii', 'Delete'),
            ['delete', 'id' => $model->id],
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
                'id',
                'login',
                'email:email',
                [
                    'label' => Yii::t('auth', 'Blocked'),
                    'value' => ArrayHelper::getValue($blocked, $model->blocked),
                ],
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
                            <?= ArrayHelper::getValue($rbac, 'permissions.' . $permission) ?>
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
                            <?= ArrayHelper::getValue($rbac, 'roles.' . $role) ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>
