<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 20.04.15
 * Time: 21:29
 */

namespace app\modules\magic;

use Yii;

class Bootstrap implements \yii\base\BootstrapInterface
{
    /**
     * @var string
     */
    public $id = 'magic';

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
                '<language:\w+\-\w+>/cp/' . $this->id => 'cp/' . $this->id,
                '<language:\w+\-\w+>/cp/' . $this->id . '/<controller:\w+>' => 'cp/' . $this->id . '/<controller>',
                '<language:\w+\-\w+>/cp/' . $this->id . '/<controller:\w+>/<action:\w+>' => 'cp/' . $this->id . '/<controller>/<action>',
            ],
            false
        );

        /**
         * magic/default/download.html?id=1
         * ru-RU/magic/default/download.html?id=1
         */
        $app->getUrlManager()->addRules(
            [
                $this->id . '/<controller:\w+>/<action:\w+>' => $this->id . '/<controller>/<action>',
                '<language:\w+\-\w+>/' . $this->id . '/<controller:\w+>/<action:\w+>' => $this->id . '/<controller>/<action>',
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
