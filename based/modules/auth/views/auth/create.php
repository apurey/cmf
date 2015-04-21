<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Auth */
/* @var $blocked [] */
/* @var $rbac [] */

$this->title = Yii::t(
    'yii',
    'Create {modelClass}',
    [
        'modelClass' => Yii::t('auth', 'Auth'),
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Auth'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render(
        '_form',
        [
            'model' => $model,
            'blocked' => $blocked,
            'rbac' => $rbac,
        ]
    ) ?>

</div>
