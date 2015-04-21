<?php

namespace app\modules\imperavi\controllers;

use app\modules\cp\components\Controller;

class ManageController extends Controller
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'FileUpload' => 'app\modules\imperavi\actions\FileUploadAction',
            'FileList' => 'app\modules\imperavi\actions\FileListAction',
            'ImageUpload' => 'app\modules\imperavi\actions\ImageUploadAction',
            'ImageList' => 'app\modules\imperavi\actions\ImageListAction',
            'PageList' => 'app\modules\imperavi\actions\PageListAction',
        ];
    }
}
