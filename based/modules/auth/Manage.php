<?php

namespace app\modules\auth;

use app\modules\cp\components\Module;

class Manage extends Module
{
    /**
     * @var string
     */
    public $defaultRoute = 'auth';

    /**
     * @var string
     */
    public $controllerNamespace = 'app\modules\auth\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
