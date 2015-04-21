<?php

namespace app\modules\page;

use app\modules\cp\components\Module;

class Manage extends Module
{
    /**
     * @var array
     */
    public $layouts = [];

    /**
     * @var array
     */
    public $templates = [];

    /**
     * @var string
     */
    public $defaultRoute = 'manage';

    /**
     * @var string
     */
    public $controllerNamespace = 'app\modules\page\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
