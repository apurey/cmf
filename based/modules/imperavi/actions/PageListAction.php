<?php

namespace app\modules\imperavi\actions;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use app\modules\page\models\Page;
use app\modules\language\models\Language;

class PageListAction extends \yii\base\Action
{
    /**
     * @return string
     */
    public function run()
    {
        return Json::encode(
            ArrayHelper::merge(
                [
                    [
                        'name' => Yii::t('imperavi', 'Link to the page'),
                        'url' => '#',
                    ],
                ],
                ArrayHelper::getColumn(
                    Page::find()->where(['language' => Language::getCurrent()])->asArray()->all(),
                    function ($row) {
                        return [
                            'name' => $row['title'],
                            'url' => Yii::$app->getUrlManager()->createUrl($row['name']),
                        ];
                    }
                )
            )
        );
    }
}
