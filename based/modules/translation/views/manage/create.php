<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\translation\models\I18nSource */

$this->title = Yii::t(
    'yii',
    'Create {modelClass}',
    [
        'modelClass' => Yii::t('translation', 'Translation'),
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Translation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="i18n-source-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
