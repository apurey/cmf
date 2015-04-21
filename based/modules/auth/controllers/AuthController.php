<?php

namespace app\modules\auth\controllers;

use Yii;
use app\modules\auth\models\Auth;
use app\modules\auth\models\AuthSearch;
use app\modules\cp\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * AuthController implements the CRUD actions for Auth model.
 */
class AuthController extends Controller
{
    /**
     * Lists all Auth models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'blocked' => Auth::getBlockedList(),
            ]
        );
    }

    /**
     * Displays a single Auth model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->loadRbacItems();

        return $this->render(
            'view',
            [
                'model' => $model,
                'blocked' => Auth::getBlockedList(),
                'rbac' => Auth::getRbacItems(),
            ]
        );
    }

    /**
     * Creates a new Auth model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Auth(['scenario' => 'create']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render(
                'create',
                [
                    'model' => $model,
                    'blocked' => Auth::getBlockedList(),
                    'rbac' => Auth::getRbacItems(),
                ]
            );
        }
    }

    /**
     * Updates an existing Auth model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->loadRbacItems();
            return $this->render(
                'update',
                [
                    'model' => $model,
                    'blocked' => Auth::getBlockedList(),
                    'rbac' => Auth::getRbacItems(),
                ]
            );
        }
    }

    /**
     * Deletes an existing Auth model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Auth model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Auth the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Auth::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
