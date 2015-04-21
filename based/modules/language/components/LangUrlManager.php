<?php

namespace app\modules\language\components;

use yii\web\UrlManager;
use app\modules\language\models\Language;

class LangUrlManager extends UrlManager
{
    /**
     * @param array|string $params
     * @return string
     */
    public function createUrl($params)
    {
        $params = (array)$params;
        $language = isset($params['language']) ? $params['language'] : Language::getCurrent();

        if (!Language::isLanguage($language)) {
            $language = Language::getCurrent();
        }

        unset($params['route'], $params['language']);
        $params['0'] = $language . '/' . trim($params['0'], '/');

        return parent::createUrl($params);
    }
}
