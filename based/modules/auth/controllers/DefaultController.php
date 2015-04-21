<?php

namespace app\modules\auth\controllers;

use Yii;
use yii\web\Controller;
use app\modules\auth\models\AuthLogin;

class DefaultController extends Controller
{
    /**
     * @var string
     */
    public $layout = '@app/modules/auth/views/layouts/main';

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'cmf' : null,
            ],
        ];
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->getIsGuest()) {
            return $this->redirect(Yii::$app->user->getReturnUrl());
        }

        $model = new AuthLogin();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->user->getReturnUrl());
        }

        return $this->render(
            'login',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
