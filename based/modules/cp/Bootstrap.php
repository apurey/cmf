<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 20.04.15
 * Time: 20:58
 */

namespace app\modules\cp;

use Yii;

class Bootstrap implements \yii\base\BootstrapInterface
{
    /**
     * @var string
     */
    public $id = 'cp';

    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $this->registerRules($app);
        $this->registerTranslations();
    }

    /**
     * @param \yii\base\Application $app
     */
    public function registerRules($app)
    {
        $app->getUrlManager()->addRules(
            [
                '<language:\w+\-\w+>/' . $this->id => $this->id,
                '<language:\w+\-\w+>/' . $this->id . '/<controller:\w+>' => $this->id . '/<controller>',
                '<language:\w+\-\w+>/' . $this->id . '/<controller:\w+>/<action:\w+>' => $this->id . '/<controller>/<action>',
            ],
            false
        );
        $app->getUrlManager()->addRules(
            [
                $this->id => $this->id,
                $this->id . '/<controller:\w+>' => $this->id . '/<controller>',
                $this->id . '/<controller:\w+>/<action:\w+>' => $this->id . '/<controller>/<action>',
            ],
            false
        );
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations[$this->id] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $this->id . DIRECTORY_SEPARATOR . 'messages',
        ];
    }
}
