<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $i18nSource app\modules\translation\models\I18nSource */
/* @var $i18nMessage app\modules\translation\models\I18nMessage */

$this->title = Yii::t(
        'yii',
        'Update {modelClass}: ',
        [
            'modelClass' => Yii::t('translation', 'Translation'),
        ]
    ) . ' ' . $i18nSource->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Translation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $i18nSource->id, 'url' => ['view', 'id' => $i18nSource->id]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<div class="i18n-source-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render(
        '_form',
        [
            'i18nSource' => $i18nSource,
            'i18nMessage' => $i18nMessage,
        ]
    ) ?>

</div>
