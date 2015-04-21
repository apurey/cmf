<?php

namespace app\modules\magic\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\magic\models\Magic;

class DefaultController extends Controller
{
    public function init()
    {
        ini_set('max_execution_time', 0);
        parent::init();
    }

    /**
     * @param int $id
     * @return string
     */
    public function actionDownload($id)
    {
        $model = $this->findModel($id);
        return Yii::$app->response->sendFile(
            $model->getSrcPath(),
            $model->label . '.' . pathinfo($model->getSrcPath(), PATHINFO_EXTENSION),
            ['mimeType' => $model->mime]
        );
    }

    /**
     * @param int $id
     * @return \app\modules\magic\models\Magic
     * @throws \yii\web\NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Magic::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
