<?php

namespace app\modules\magic\controllers;

use Yii;
use yii\helpers\StringHelper;
use yii\helpers\FileHelper;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\imagine\Image;
use app\modules\cp\components\Controller;
use app\modules\magic\models\Magic;

class ManageController extends Controller
{
    public function init()
    {
        ini_set('max_execution_time', 0);
        parent::init();
    }

    /**
     * @return string
     */
    public function actionUpload()
    {
        $magic = new Magic(['scenario' => 'many']);
        $magic->load(Yii::$app->request->post());
        $magic->files = UploadedFile::getInstances($magic, 'files');

        if ($magic->validate()) {

            foreach ($magic->files as $file) {

                $model = new Magic(['scenario' => 'one']);

                $model->load(Yii::$app->request->post());
                $model->file = $file;

                $model->label = StringHelper::basename($model->file->name, '.' . $model->file->extension);
                $model->mime = FileHelper::getMimeTypeByExtension($model->file);

                $model->setSrc();
                $model->file->saveAs($model->getSrcPath());

                if ($model->getType() == 'image') {
                    $model->setPreview();
                    Image::thumbnail($model->getSrcPath(), Magic::PREVIEW_WIDTH, Magic::PREVIEW_HEIGHT)
                        ->save(
                            $model->getPreviewPath(),
                            ['quality' => 75]
                        );
                }

                $model->save();
            }
        }

        return $this->display($magic);
    }

    /**
     * @return string
     */
    public function actionUpdate()
    {
        $model = new Magic();
        $list = Yii::$app->request->post($model->formName(), []);

        foreach ($list as $id => $row) {
            $model = $this->findModel($id);
            $model->setAttributes($row);
            $model->save(true, ['label', 'position']);
        }

        return $this->display($model);
    }

    /**
     * @return string
     */
    public function actionDelete()
    {
        $model = $this->findModel(Yii::$app->request->get('id', null));
        if (is_file($model->getSrcPath())) {
            unlink($model->getSrcPath());
        }
        if (is_file($model->getPreviewPath())) {
            unlink($model->getPreviewPath());
        }
        $model->delete();

        return $this->display($model);
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

    /**
     * @param \app\modules\magic\models\Magic $model
     * @return string
     */
    protected function display(Magic $model)
    {
        $model->scenario = 'many';
        return $this->renderAjax(
            '@app/modules/magic/widgets/views/manage',
            [
                'model' => $model,
                'attribute' => $model::ATTRIBUTE,
                'list' => ArrayHelper::map(
                        Magic::find()->where(
                            [
                                'module' => $model->module,
                                'group_id' => $model->group_id,
                                'record_id' => $model->record_id,
                            ]
                        )->orderBy(
                                ['position' => SORT_ASC, 'id' => SORT_ASC]
                            )->all(),
                        'id',
                        function ($row) {
                            return $this->renderPartial('@app/modules/magic/widgets/views/_item', ['row' => $row]);
                        }
                    ),
            ]
        );
    }
}
