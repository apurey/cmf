<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Auth */
/* @var $blocked [] */
/* @var $rbac [] */

$this->title = Yii::t(
        'yii',
        'Update {modelClass}: ',
        [
            'modelClass' => Yii::t('auth', 'Auth'),
        ]
    ) . ' ' . $model->login;
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Auth'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->login, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<div class="auth-update">

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
