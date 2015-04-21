<?php

namespace app\modules\imperavi\actions;

use app\modules\imperavi\models\FileUploadModel;

class FileUploadAction extends \yii\base\Action
{
    /**
     * @return string
     */
    function run()
    {
        if (isset($_FILES)) {
            $model = new FileUploadModel(['uploadDir' => $this->controller->module->uploadDir]);
            if ($model->upload()) {
                return $model->toJson();
            }
        }
        return null;
    }
}
