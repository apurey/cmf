<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auth\models\PermissionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('item', 'Permissions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(
            Yii::t(
                'yii',
                'Create {modelClass}',
                [
                    'modelClass' => Yii::t('item', 'Permission'),
                ]
            ),
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>

    <?=
    GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'description:ntext',
                [
                    'attribute' => 'created_at',
                    'label' => Yii::t('item', 'Created At'),
                    'value' => function ($model) {
                            return Yii::$app->formatter->asDatetime($model->created_at);
                        },
                ],
                [
                    'attribute' => 'updated_at',
                    'label' => Yii::t('item', 'Updated At'),
                    'value' => function ($model) {
                            return Yii::$app->formatter->asDatetime($model->updated_at);
                        },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'urlCreator' => function ($action, $model) {
                            return Url::to([$action, 'name' => $model->name]);
                        },
                ],
            ],
        ]
    ); ?>

</div>
