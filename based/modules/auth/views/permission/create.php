<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Permission */

$this->title = Yii::t(
    'yii',
    'Create {modelClass}',
    [
        'modelClass' => Yii::t('item', 'Permission'),
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('item', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
