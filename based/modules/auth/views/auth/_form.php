<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Auth */
/* @var $form yii\widgets\ActiveForm */
/* @var $blocked [] */
/* @var $rbac [] */
?>

<div class="auth-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 512, 'value' => '']) ?>

    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => 512, 'value' => '']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'blocked')->dropDownList($blocked) ?>

    <?=
    $form->field($model, 'permissions')->checkboxList(
        ArrayHelper::getValue($rbac, 'permissions', []),
        [
            'separator' => '<br/>',
        ]
    ); ?>

    <?=
    $form->field($model, 'roles')->checkboxList(
        ArrayHelper::getValue($rbac, 'roles', []),
        [
            'separator' => '<br/>',
        ]
    ); ?>

    <div class="form-group">
        <?=
        Html::submitButton(
            $model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
