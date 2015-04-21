<?php

namespace app\modules\imperavi;

use Yii;
use yii\helpers\FileHelper;
use app\modules\cp\components\Module;
use app\modules\language\models\Language;

class Manage extends Module
{
    /**
     * @var string
     */
    public $defaultRoute = 'manage';

    /**
     * @var string
     */
    public $controllerNamespace = 'app\modules\imperavi\controllers';

    /**
     * @var string
     */
    public $uploadDir = 'uploads';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->registerUploadDir();
    }

    public function registerUploadDir()
    {
        $this->uploadDir = '@webroot' . DIRECTORY_SEPARATOR . $this->uploadDir . DIRECTORY_SEPARATOR . Language::getCurrent(
            );
        FileHelper::createDirectory(Yii::getAlias($this->uploadDir), 0777, true);
    }
}
