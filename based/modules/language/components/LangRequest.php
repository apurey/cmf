<?php

namespace app\modules\language\components;

use Yii;
use yii\web\Request;
use yii\helpers\ArrayHelper;
use app\modules\language\models\Language;

class LangRequest extends Request
{
    /**
     * @return bool|string
     */
    protected function resolveRequestUri()
    {
        $pattern = [];
        $resolveRequestUri = parent::resolveRequestUri();

        if (Yii::$app->getUrlManager()->enablePrettyUrl === true) {
            $pattern[] = '/' . preg_replace('/\//', '\/', Yii::$app->getUrlManager()->suffix) . '/';
        }

        if (Yii::$app->getUrlManager()->showScriptName === true) {
            $pattern[] = '/' . preg_replace('/\//', '\/', $this->getScriptUrl()) . '/';
        }

        $requestUri = preg_replace($pattern, '', $resolveRequestUri);

        list($language,) = explode('/', trim($requestUri, '/'));

        if (Language::isLanguage($language)) {
            Language::setCurrent($language);
        } else {
            Language::setCurrent(
                $this->getPreferredLanguage(ArrayHelper::getColumn(Language::listing(), 'iso'))
            );
        }

        return $resolveRequestUri;
    }
}
