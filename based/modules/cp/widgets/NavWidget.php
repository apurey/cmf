<?php

namespace app\modules\cp\widgets;

use Yii;
use yii\bootstrap\Nav;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

class NavWidget extends Nav
{
    public function init()
    {
        $this->items = ArrayHelper::merge(
            $this->convertToNav(ArrayHelper::getValue(Yii::$app->params, 'nav', [])),
            $this->items
        );
        parent::init();
    }

    /**
     * @param array $nav
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    protected function convertToNav(array $nav)
    {
        $_items = [];

        foreach ($nav as $row) {

            if (is_array($row)) {

                $label = ArrayHelper::remove($row, 'label');
                $items = ArrayHelper::remove($row, 'items');

                if ($label === null) {
                    throw new InvalidConfigException("The 'label' option is required.");
                }

                $row = ArrayHelper::merge($row, ['label' => Yii::t($label['category'], $label['context'])]);

                if (!($items === null)) {
                    $row = ArrayHelper::merge($row, ['items' => $this->convertToNav($items)]);
                }
            }

            $_items = ArrayHelper::merge($_items, [$row]);
        }

        return $_items;
    }
}
