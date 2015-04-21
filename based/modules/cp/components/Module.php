<?php

namespace app\modules\cp\components;

use Yii;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();

        $this->registerErrorHandler();
    }

    public function registerErrorHandler()
    {
        Yii::$app->errorHandler->errorAction = 'cp/default/error';
    }
}
