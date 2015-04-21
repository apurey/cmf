<?php

namespace app\modules\imperavi\actions;

use app\modules\imperavi\models\FileListModel;

class FileListAction extends \yii\base\Action
{
    /**
     * @return string
     */
    function run()
    {
        return (new FileListModel(['uploadDir' => $this->controller->module->uploadDir]))->toJson();
    }
}
