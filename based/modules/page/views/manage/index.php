<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\page\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $layouts [] */
/* @var $templates [] */
/* @var $active [] */

$this->title = Yii::t('page', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(
            Yii::t(
                'yii',
                'Create {modelClass}',
                [
                    'modelClass' => Yii::t('page', 'Page'),
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
                'id',
                'name',
                'title',
                [
                    'attribute' => 'layout',
                    'label' => Yii::t('page', 'Layout'),
                    'filter' => $layouts,
                    'value' => function ($model) use ($layouts) {
                            return ArrayHelper::getValue($layouts, $model->layout);
                        },
                ],
                [
                    'attribute' => 'template',
                    'label' => Yii::t('page', 'Template'),
                    'filter' => $templates,
                    'value' => function ($model) use ($templates) {
                            return ArrayHelper::getValue($templates, $model->template);
                        },
                ],
                [
                    'attribute' => 'active',
                    'label' => Yii::t('page', 'Active'),
                    'filter' => $active,
                    'value' => function ($model) use ($active) {
                            return ArrayHelper::getValue($active, $model->active);
                        },
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

</div>
