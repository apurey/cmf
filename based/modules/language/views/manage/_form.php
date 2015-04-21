<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\language\models\Language */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="language-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'iso')->textInput(['maxlength' => 8]) ?>

    <div class="form-group">
        <?=
        Html::submitButton(
            $model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
