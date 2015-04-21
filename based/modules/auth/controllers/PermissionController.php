<?php

namespace app\modules\auth\controllers;

use Yii;
use app\modules\auth\models\Permission;
use app\modules\auth\models\PermissionSearch;
use app\modules\cp\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * PermissionController implements the CRUD actions for Permission model.
 */
class PermissionController extends Controller
{
    /**
     * Lists all Permission models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermissionSearch();
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
     * Displays a single Permission model.
     * @param string $name
     * @return mixed
     */
    public function actionView($name)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($name),
            ]
        );
    }

    /**
     * Creates a new Permission model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Permission();

        if ($model->load(Yii::$app->request->post()) && $model->createPermission()) {
            return $this->redirect(['view', 'name' => $model->name]);
        } else {
            return $this->render(
                'create',
                [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * Updates an existing Permission model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $name
     * @return mixed
     */
    public function actionUpdate($name)
    {
        $model = $this->findModel($name);

        if ($model->load(Yii::$app->request->post()) && $model->updatePermission()) {
            return $this->redirect(['view', 'name' => $model->name]);
        } else {
            return $this->render(
                'update',
                [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * Deletes an existing Permission model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $name
     * @return mixed
     */
    public function actionDelete($name)
    {
        $model = $this->findModel($name);

        $permission = new Permission();
        $permission->authManager->remove($permission->authManager->getPermission($model->name));

        return $this->redirect(['index']);
    }

    /**
     * Finds the Permission model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $name
     * @return Permission the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name)
    {
        $model = new Permission();
        $permission = $model->authManager->getPermission($name);
        if (!($permission === null)) {
            $model->name = $permission->name;
            $model->description = $permission->description;
            $model->setIsNewRecord(false);
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
