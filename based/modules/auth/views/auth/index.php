<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auth\models\AuthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $blocked [] */

$this->title = Yii::t('auth', 'Auth');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(
            Yii::t(
                'yii',
                'Create {modelClass}',
                [
                    'modelClass' => Yii::t('auth', 'Auth'),
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
                'login',
                'email:email',
                [
                    'attribute' => 'blocked',
                    'label' => Yii::t('auth', 'Blocked'),
                    'filter' => $blocked,
                    'value' => function ($model) use ($blocked) {
                            return ArrayHelper::getValue($blocked, $model->blocked);
                        },
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

</div>
