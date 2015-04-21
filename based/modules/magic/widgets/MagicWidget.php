<?php

namespace app\modules\magic\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use app\modules\magic\models\Magic;

class MagicWidget extends Widget
{
    /**
     * @var array
     */
    protected $list = [];

    /**
     * @var array
     */
    public $options = [];

    public function init()
    {
        /* @var $row Magic */

        $model = Magic::find()->where($this->options)->orderBy(['position' => SORT_ASC, 'id' => SORT_ASC])->all();
        foreach ($model as $row) {
            $type = $row->getType();
            $this->list = ArrayHelper::merge(
                $this->list,
                [
                    $type => [
                        $row,
                    ],
                ]
            );
        }

        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
        return $this->render('example', ['model' => $this->list]);
    }
}
