<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Permission */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('item', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-view">

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

</div>
