<?php

namespace app\assets;

use Yii;
use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    /**
     * @var array
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    /**
     * @param \yii\web\View $view
     */
    public function registerAssetFiles($view)
    {
        list($this->basePath, $this->baseUrl) = $this->getAssetsUrl();

        $this->css = [
            'css' . DIRECTORY_SEPARATOR . 'dev.css',
            'highslide' . DIRECTORY_SEPARATOR . 'highslide.css',
        ];

        $this->js = [
            'js' . DIRECTORY_SEPARATOR . 'dev.js',
            'highslide' . DIRECTORY_SEPARATOR . 'highslide.packed.js',
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
        return __DIR__ . DIRECTORY_SEPARATOR . 'dist';
    }
}
