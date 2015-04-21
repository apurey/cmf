<?php

namespace app\modules\imperavi\actions;

use app\modules\imperavi\models\ImageListModel;

class ImageListAction extends \yii\base\Action
{
    /**
     * @return string
     */
    function run()
    {
        return (new ImageListModel(['uploadDir' => $this->controller->module->uploadDir]))->toJson();
    }
}
