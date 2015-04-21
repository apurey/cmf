<?php

namespace app\modules\page\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\page\models\Page;
use app\modules\language\models\Language;

class PageController extends Controller
{
    /**
     * @var string
     */
    public $layout = '//common';

    /**
     * @param string $route
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionRoute($route = 'index')
    {
        /* @var $dp Page */

        $page = Page::parse($route);

        $dp = Page::find()->where(
            'name = :name AND active = :active AND language = :language',
            [':name' => $page, ':active' => Page::ACTIVE_YES, ':language' => Language::getCurrent()]
        )->one();

        if ($dp === null) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
        $this->registerLayout($dp->layout);

        return $this->render($dp->template, ['dp' => $dp]);
    }

    /**
     * @param $layout
     */
    protected function registerLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}
