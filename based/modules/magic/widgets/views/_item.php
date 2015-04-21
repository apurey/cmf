<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 07.03.15
 * Time: 14:57
 */

/* @var $this yii\web\View */
/* @var $row /app/modules/magic/model/Magic */

use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="thumbnail">
    <?php if ($row->getType() == 'image') : ?>
        <img alt="<?= Html::encode($row->label); ?>" src="<?= $row->getPreviewUrl() ?>">
    <?php endif; ?>

    <div class="caption">
        <div class="form-group">
            <?=
            Html::activeInput(
                'text',
                $row,
                'label',
                ['name' => $row->formName() . '[' . $row->id . '][label]', 'class' => 'form-control']
            ) ?>
            <?=
            Html::activeInput(
                'hidden',
                $row,
                'position',
                ['name' => $row->formName() . '[' . $row->id . '][position]', 'class' => 'form-control']
            ) ?>
        </div>
        <p>
            <a class="btn btn-danger" href="<?=
            Url::to(
                ['/cp/magic/manage/delete', 'id' => $row->id]
            ) ?>" data-pjax="1"><?= Yii::t('yii', 'Delete') ?></a>

            <?= Html::submitButton(Yii::t('yii', 'Update'), ['class' => 'btn btn-primary']); ?>

            <a class="btn btn-default" href="<?=
            Url::to(
                ['/magic/default/download', 'id' => $row->id]
            ) ?>" data-pjax="0"><?= Yii::t('magic', 'Download') ?></a>
        </p>
    </div>
</div>
