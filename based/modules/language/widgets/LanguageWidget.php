<?php

namespace app\modules\language\widgets;

use Yii;
use yii\base\Widget;
use yii\bootstrap\Nav;
use yii\helpers\ArrayHelper;
use app\modules\language\models\Language;

class LanguageWidget extends Widget
{
    /**
     * @var array
     */
    protected $languages = [];

    /**
     * @var array
     */
    public $options = [];

    public function init()
    {
        $this->languages = Language::listing();
    }

    /**
     * @return string
     */
    public function run()
    {
        $list = [];

        list($route, $params) = Yii::$app->getUrlManager()->parseRequest(Yii::$app->getRequest());
        $params = ArrayHelper::merge($_GET, $params);
        $url = isset($params['route']) ? $params['route'] : $route;

        foreach ($this->languages as $row) {
            $list = ArrayHelper::merge(
                $list,
                [
                    [
                        'label' => $row['title'],
                        'url' => Yii::$app->urlManager->createUrl(
                                ArrayHelper::merge($params, [$url, 'language' => $row['iso']])
                            ),
                    ],
                ]
            );
        }

        return Nav::widget(
            [
                'options' => $this->options,
                'items' => [
                    [
                        'label' => Language::getCurrentRecord()->title,
                        'items' => $list,
                    ],
                ],
            ]
        );
    }
}
