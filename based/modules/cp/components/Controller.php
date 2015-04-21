<?php

namespace app\modules\cp\components;

use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\modules\cp\components\AccessControl;

class Controller extends \yii\web\Controller
{
    /**
     * @var string
     */
    public $layout = '@app/modules/cp/views/layouts/main';

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                ],
            ]
        );
    }
}
