<?php

namespace app\modules\auth\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use app\modules\auth\models\Role;
use app\modules\auth\models\Permission;

/**
 * This is the model class for table "{{%auth}}".
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property string $email
 * @property integer $blocked
 */
class Auth extends \yii\db\ActiveRecord implements IdentityInterface
{
    const BLOCKED_NO = 0;
    const BLOCKED_YES = 1;

    /**
     * @var array
     */
    public $permissions = [];

    /**
     * @var array
     */
    public $roles = [];

    /**
     * @var null
     */
    public $password_repeat = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blocked'], 'integer'],
            [['login'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['password_repeat'], 'string', 'max' => 512, 'min' => 8],
            [['auth_key', 'email'], 'string', 'max' => 64],
            [['access_token'], 'string', 'max' => 128],
            [['email'], 'email'],
            [['login'], 'required'],
            [['login'], 'unique'],
            [['password', 'password_repeat'], 'required', 'on' => ['create']],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('auth', 'ID'),
            'login' => Yii::t('auth', 'Login'),
            'password' => Yii::t('auth', 'Password'),
            'password_repeat' => Yii::t('auth', 'Password Repeat'),
            'auth_key' => Yii::t('auth', 'Auth Key'),
            'access_token' => Yii::t('auth', 'Access Token'),
            'email' => Yii::t('auth', 'Email'),
            'blocked' => Yii::t('auth', 'Blocked'),
            'verifyCode' => Yii::t('auth', 'Captcha'),
            'permissions' => Yii::t('item', 'Permissions'),
            'roles' => Yii::t('item', 'Roles'),
        ];
    }

    /**
     * @return array
     */
    public static function getBlockedList()
    {
        return [
            Auth::BLOCKED_NO => Yii::t('auth', Yii::t('auth', 'No')),
            Auth::BLOCKED_YES => Yii::t('auth', Yii::t('auth', 'Yes')),
        ];
    }

    /**
     * @return array
     */
    public static function getRbacItems()
    {
        /**
         * @var $role Role
         * @var $permission Permission
         */

        $roles = [];
        $permissions = [];

        foreach (Role::find()->where(['type' => Role::TYPE])->all() as $role) {
            $roles = ArrayHelper::merge($roles, [$role->name => $role->name]);
        }

        foreach (Permission::find()->where(['type' => Permission::TYPE])->all() as $permission) {
            $permissions = ArrayHelper::merge($permissions, [$permission->name => $permission->name]);
        }

        return [
            'roles' => $roles,
            'permissions' => $permissions,
        ];
    }

    public function loadRbacItems()
    {
        $role = new Role();
        foreach ($role->authManager->getRolesByUser($this->id) as $item) {
            switch ($item->type) {
                case Role::TYPE :
                    $this->roles = ArrayHelper::merge($this->roles, [$item->name]);
                    break;
                case Permission::TYPE :
                    $this->permissions = ArrayHelper::merge($this->permissions, [$item->name]);
                    break;
            }
        }
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (!empty($this->password)) {
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $this->auth_key = Yii::$app->getSecurity()->generateRandomString(64);
            $this->access_token = Yii::$app->getSecurity()->generateRandomString(128);
        } else {
            unset($this->password);
        }

        return parent::beforeSave($insert);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        /**
         * @var $permission Permission
         * @var $role Role
         */

        $permissions = ArrayHelper::getValue(Yii::$app->request->post(), 'Auth.permissions', []);
        $permissions = is_array($permissions) ? $permissions : [];

        $roles = ArrayHelper::getValue(Yii::$app->request->post(), 'Auth.roles', []);
        $roles = is_array($roles) ? $roles : [];

        Yii::$app->getAuthManager()->revokeAll($this->id);

        $permission = new Permission();
        foreach ($permissions as $item) {
            $permission->authManager->assign($permission->authManager->getPermission($item), $this->id);
        }

        $role = new Role();
        foreach ($roles as $item) {
            $role->authManager->assign($role->authManager->getRole($item), $this->id);
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /**
     * @param int|string $id
     * @return IdentityInterface|static
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'blocked' => Auth::BLOCKED_NO]);
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return IdentityInterface|static
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $auth_key
     * @return bool
     */
    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }
}
