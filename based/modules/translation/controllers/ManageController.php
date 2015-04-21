<?php

namespace app\modules\translation\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\modules\translation\models\I18nSource;
use app\modules\translation\models\I18nMessage;
use app\modules\translation\models\I18nSourceSearch;
use app\modules\cp\components\Controller;
use app\modules\language\models\Language;

/**
 * ManageController implements the CRUD actions for I18nSource model.
 */
class ManageController extends Controller
{
    /**
     * Lists all I18nSource models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new I18nSourceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays a single I18nSource model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
                'language' => ArrayHelper::map(Language::listing(), 'iso', 'title'),
            ]
        );
    }

    /**
     * Updates an existing I18nSource model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $i18nSource = $this->findModel($id);
        $i18nMessage = I18nMessage::find()
            ->where(['id' => $id, 'language' => Language::getCurrent()])
            ->one();

        if (Yii::$app->request->isPost) {

            $transaction = Yii::$app->db->beginTransaction();

            try {
                $i18nSource->load(Yii::$app->request->post());
                if ($i18nSource->save()) {
                    $i18nMessage->load(Yii::$app->request->post());
                    if ($i18nMessage->save()) {
                        $transaction->commit();
                    }
                }
                return $this->redirect(['view', 'id' => $id]);
            } catch (\Exception $e) {
                $transaction->rollBack();
                return $this->redirect(['update', 'id' => $id]);
            }
        }

        return $this->render(
            'update',
            [
                'i18nSource' => $i18nSource,
                'i18nMessage' => $i18nMessage,
            ]
        );
    }

    /**
     * Deletes an existing I18nSource model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the I18nSource model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return I18nSource the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = I18nSource::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
