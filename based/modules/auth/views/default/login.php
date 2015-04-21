<?php

use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\AuthLogin */
/* @var $form ActiveForm */

$this->title = Yii::t('auth', 'Authorization');
?>
<div class="default-login">

    <?php $form = ActiveForm::begin(
        [
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]
    ); ?>

    <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?=
    $form->field($model, 'verifyCode')->widget(
        Captcha::className(),
        [
            'captchaAction' => '/cp/auth/default/captcha',
        ]
    ) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton(Yii::t('auth', 'Authorization'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- default-login -->
