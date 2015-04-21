<?php
/* @var $this yii\web\View */
/* @var $dp app\modules\page\models\Page */

use yii\helpers\HtmlPurifier;

$this->title = $dp->title;

$this->registerMetaTag(['name' => 'keywords', 'content' => $dp->keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $dp->description]);

if ($this->beginCache('page', ['duration' => 60, 'variations' => ['id' => $dp->id]])) {
    echo HTMLPurifier::process(
        $dp->text,
        [
            'Attr.AllowedFrameTargets' => [
                '_blank',
                '_self',
                '_parent',
                '_top',
            ],
        ]
    );
    $this->endCache();
}
