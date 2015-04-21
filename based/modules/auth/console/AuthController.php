<?php

namespace app\modules\auth\console;

use Yii;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use app\modules\auth\models\Auth;

class AuthController extends Controller
{
    /**
     * @var null
     */
    public $name = null;

    /**
     * @var null
     */
    public $login = null;

    /**
     * @var string
     * on|off
     */
    public $drop = 'off';

    /**
     * @var array
     */
    public $methods = [
        'index',
        'create',
        'view',
        'update',
        'delete',
    ];

    /**
     * @var string
     */
    private $prefix = 'cp';

    /**
     * @var string
     */
    private $separator = '/';

    /**
     * @param string $actionID
     * @return array
     */
    public function options($actionID)
    {
        return ArrayHelper::merge(
            parent::options($actionID),
            ($actionID == 'create') ? ['name', 'login', 'drop', 'methods'] : []
        );
    }

    public function actionCreate()
    {
        $rbac = Yii::$app->getAuthManager();

        if ($this->drop == 'on') {
            $rbac->removeAll();
        }

        $roleList = [
            $this->normalizeString($this->prefix),
            $this->normalizeString($this->name),
        ];
        $roleName = implode($this->separator, $roleList);

        $roleObject = $rbac->createRole($roleName);
        $rbac->add($roleObject);

        foreach ($this->normalizeMethods($this->methods) as $method) {

            $permissionList = [
                $roleName,
                $this->normalizeString($method),
            ];
            $permissionName = implode($this->separator, $permissionList);

            $permissionObject = $rbac->createPermission($permissionName);
            $rbac->add($permissionObject);

            $rbac->addChild($roleObject, $permissionObject);
        }

        $userId = $this->getUserId($this->login);
        if ($userId) {
            $rbac->assign($roleObject, $userId);
        }
    }

    /**
     * @param string $login
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    private function getUserId($login)
    {
        /* @var $model \app\modules\auth\models\Auth */
        $model = Auth::findOne(['login' => $login]);
        if ($model === null) {
            throw new InvalidConfigException(Yii::t('auth', 'The user login is not found'));
        }
        return $model->id;
    }

    /**
     * @param string $string
     * @return string
     */
    private function normalizeString($string)
    {
        return trim($string, '/');
    }

    /**
     * @param mixed $methods
     * @return array
     */
    private function normalizeMethods($methods)
    {
        if (is_string($methods)) {
            $methods = explode(',', $methods);
        }
        return array_map(
            function ($row) {
                return trim($row, '/');
            },
            $methods
        );
    }
}
