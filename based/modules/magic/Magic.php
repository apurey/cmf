<?php

namespace app\modules\magic;

use Yii;
use yii\helpers\FileHelper;
use app\modules\language\models\Language;

class Magic extends \yii\base\Module
{
    /**
     * @var string
     */
    public $controllerNamespace = 'app\modules\magic\controllers';

    /**
     * @var string
     */
    public $uploadDir = '';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->registerUploadDir();
    }

    public function registerUploadDir()
    {
        $this->uploadDir = $this->uploadDir . DIRECTORY_SEPARATOR . Language::getCurrent();
        FileHelper::createDirectory(Yii::getAlias('@webroot' . DIRECTORY_SEPARATOR . $this->uploadDir), 0777, true);
    }
}
