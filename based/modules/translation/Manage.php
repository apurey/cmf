<?php

namespace app\modules\translation;

use app\modules\cp\components\Module;

class Manage extends Module
{
    /**
     * @var string
     */
    public $defaultRoute = 'manage';

    /**
     * @var string
     */
    public $controllerNamespace = 'app\modules\translation\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
