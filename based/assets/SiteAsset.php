<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SiteAsset extends AssetBundle
{
    /**
     * @var array
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    /**
     * @param \yii\web\View $view
     */
    public function registerAssetFiles($view)
    {
        list($this->basePath, $this->baseUrl) = $this->getAssetsUrl();

        $this->css = [
            'css' . DIRECTORY_SEPARATOR . 'dev.css',
        ];

        $this->js = [
            'js' . DIRECTORY_SEPARATOR . 'dev.js',
        ];

        parent::registerAssetFiles($view);
    }

    /**
     * @return array
     */
    public function getAssetsUrl()
    {
        return Yii::$app->getAssetManager()->publish($this->getDistPath());
    }

    /**
     * @return string
     */
    public function getDistPath()
    {
        return '@webroot' . DIRECTORY_SEPARATOR . 'dist';
    }
}
