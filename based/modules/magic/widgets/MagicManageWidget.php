<?php

namespace app\modules\magic\widgets;

use yii\helpers\ArrayHelper;
use yii\widgets\InputWidget;
use app\modules\magic\models\Magic;

class MagicManageWidget extends InputWidget
{
    /**
     * @var array
     */
    public $attributes = [];

    /**
     * @return string
     */
    public function run()
    {
        $this->model->setAttributes($this->attributes);

        return $this->render(
            'manage',
            [
                'model' => $this->model,
                'attribute' => $this->attribute,
                'list' => ArrayHelper::map(
                        Magic::find()->where($this->attributes)->orderBy(
                            ['position' => SORT_ASC, 'id' => SORT_ASC]
                        )->all(),
                        'id',
                        function ($row) {
                            return $this->render('_item', ['row' => $row]);
                        }
                    ),
            ]
        );
    }
}
