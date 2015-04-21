<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 20.02.15
 * Time: 21:41
 */

/* @var $this yii\web\View */
/* @var $model /app/modules/magic/model/Magic */
/* @var $attribute string */
/* @var $list [] */

use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\jui\Sortable;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

// sortable
$url = Url::to(['/cp/magic/manage/update']);

?>

<?php Pjax::begin(
    [
        'enablePushState' => false,
        'timeout' => 5000,
        'options' => [
            'id' => 'magic_pjax',
        ],
        'clientOptions' => [
            'type' => 'post',
        ],
    ]
) ?>

<div class="panel panel-default">
    <div class="panel-heading"><?= Yii::t('magic', 'Download file') ?></div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(
            [
                'action' => ['/cp/magic/manage/upload'],
                'options' => [
                    'id' => 'magic_form_upload',
                    'data-pjax' => 1,
                    'enctype' => 'multipart/form-data',
                ],
            ]
        ); ?>
        <?= $form->field($model, 'module', ['template' => '{input}', 'options' => []])->hiddenInput(); ?>
        <?= $form->field($model, 'group_id', ['template' => '{input}'])->hiddenInput(); ?>
        <?= $form->field($model, 'record_id', ['template' => '{input}'])->hiddenInput(); ?>
        <?= $form->field($model, $attribute)->fileInput(['multiple' => 1]); ?>
        <?= Html::submitButton(Yii::t('magic', 'Upload'), ['class' => 'btn btn-success']); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php $form = ActiveForm::begin(
    [
        'action' => ['/cp/magic/manage/update'],
        'options' => [
            'id' => 'magic_form_update',
            'data-pjax' => 1,
        ],
    ]
); ?>
<div class="panel panel-default">
    <div class="panel-heading"><?= Yii::t('magic', 'Uploaded files') ?></div>
    <div class="panel-body">
        <?=
        Sortable::widget(
            [
                'items' => $list,
                'options' => [
                    'id' => 'magic_sortable',
                    'tag' => 'div',
                    'class' => 'row',
                    'style' => 'margin-top: 20px;',
                ],
                'itemOptions' => [
                    'tag' => 'div',
                    'class' => 'col-sm-6 col-md-4',
                ],
                'clientOptions' => [
                    'cursor' => 'move',
                    'beforeStop' => new JsExpression("
                    function (event, ui) {
                        jQuery(ui.item.parent()).sortable('option', 'disabled', true);

                        jQuery(ui.item.parent()).find('div.caption').each(function (index, el) {
                            jQuery(el).find('input[type=hidden]').val(index + 1);
                        });

                        jQuery.ajax({
                            'type': 'post',
                            'url': '{$url}',
                            'dataType': 'html',
                            'data': jQuery(this).closest('form').serialize()
                        }).done(function () {
                            jQuery(ui.item.parent()).sortable('option', 'disabled', false);
                        });
                    }"),
                ],
            ]
        );?>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php Pjax::end() ?>
