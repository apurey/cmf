<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Permission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'name')->textInput(
        ArrayHelper::merge(
            [
                'maxlength' => 64
            ],
            $model->getIsNewRecord() ? [] : ['disabled' => true]
        )
    ) ?>

    <?= $form->field($model, 'description') ?>

    <div class="form-group">
        <?=
        Html::submitButton(
            $model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
