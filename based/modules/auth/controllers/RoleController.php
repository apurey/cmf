<?php

namespace app\modules\auth\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\auth\models\Role;
use app\modules\auth\models\RoleSearch;
use app\modules\cp\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends Controller
{
    /**
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
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
     * Displays a single Role model.
     * @param string $name
     * @return mixed
     */
    public function actionView($name)
    {
        $model = $this->findModel($name);
        $model->loadChildren();

        return $this->render(
            'view',
            [
                'model' => $model,
                'permissions' => $model->getPermissions(),
                'roles' => $model->getRoles(),
            ]
        );
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role();

        $permissions = ArrayHelper::getValue(Yii::$app->request->post(), 'Role.permissions', []);
        $permissions = is_array($permissions) ? $permissions : [];

        $roles = ArrayHelper::getValue(Yii::$app->request->post(), 'Role.roles', []);
        $roles = is_array($roles) ? $roles : [];

        if ($model->load(Yii::$app->request->post()) && $model->createRole($permissions, $roles)) {
            return $this->redirect(['view', 'name' => $model->name]);
        } else {
            return $this->render(
                'create',
                [
                    'model' => $model,
                    'permissions' => $model->getPermissions(),
                    'roles' => $model->getRoles(),
                ]
            );
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $name
     * @return mixed
     */
    public function actionUpdate($name)
    {
        $model = $this->findModel($name);

        $permissions = ArrayHelper::getValue(Yii::$app->request->post(), 'Role.permissions', []);
        $permissions = is_array($permissions) ? $permissions : [];

        $roles = ArrayHelper::getValue(Yii::$app->request->post(), 'Role.roles', []);
        $roles = is_array($roles) ? $roles : [];

        if ($model->load(Yii::$app->request->post()) && $model->updateRole($name, $permissions, $roles)) {
            return $this->redirect(['view', 'name' => $model->name]);
        } else {
            $model->loadChildren();
            return $this->render(
                'update',
                [
                    'model' => $model,
                    'permissions' => $model->getPermissions(),
                    'roles' => $model->getRoles(),
                ]
            );
        }
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $name
     * @return mixed
     */
    public function actionDelete($name)
    {
        $model = $this->findModel($name);

        $role = new Role();
        $role->authManager->remove($role->authManager->getRole($model->name));

        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $name
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name)
    {
        $model = new Role();
        $role = $model->authManager->getRole($name);
        if (!($role === null)) {
            $model->name = $role->name;
            $model->description = $role->description;
            $model->setIsNewRecord(false);
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
