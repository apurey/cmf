<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\translation\models\I18nSourceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'Translation');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="i18n-source-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'category',
                'message',
                [
                    'attribute' => 'translation',
                    'label' => Yii::t('translation', 'Translation'),
                    'value' => function ($model) {
                            return ArrayHelper::getValue($model->i18nMessage, 'translation');
                        },
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

</div>
