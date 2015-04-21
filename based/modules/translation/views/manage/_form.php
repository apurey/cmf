<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $i18nSource app\modules\translation\models\I18nSource */
/* @var $i18nMessage app\modules\translation\models\I18nMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="i18n-source-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($i18nSource, 'category')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($i18nSource, 'message')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($i18nMessage, 'translation')->textInput(['maxlength' => 128]) ?>

    <div class="form-group">
        <?=
        Html::submitButton(
            $i18nSource->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Update'),
            ['class' => $i18nSource->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
