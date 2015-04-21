<?php

namespace app\modules\auth\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\auth\models\Permission;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 */
class Role extends \yii\db\ActiveRecord
{
    const TYPE = 1;

    /**
     * @var array
     */
    public $permissions = [];

    /**
     * @var array
     */
    public $roles = [];

    /**
     * @var \yii\rbac\ManagerInterface
     */
    public $authManager = null;

    public function init()
    {
        $this->authManager = Yii::$app->getAuthManager();
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'unique'],
            ['name', 'match', 'pattern' => '/^[a-z0-9\-\/]+$/i'],
            ['name', 'string', 'min' => 2, 'max' => 64],
            ['name', 'validateRole'],
            ['description', 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('item', 'Name'),
            'type' => Yii::t('item', 'Type'),
            'description' => Yii::t('item', 'Description'),
            'rule_name' => Yii::t('item', 'Rule Name'),
            'data' => Yii::t('item', 'Data'),
            'created_at' => Yii::t('item', 'Created At'),
            'updated_at' => Yii::t('item', 'Updated At'),
            'permissions' => Yii::t('item', 'Permissions'),
            'roles' => Yii::t('item', 'Role'),
        ];
    }

    public function validateRole()
    {
        if (!$this->hasErrors()) {
            if ($this->getIsNewRecord() && $this->authManager->getRole($this->name)) {
                $this->addError('name', Yii::t('item', 'This name already exists'));
            }
        }
    }

    /**
     * @param array $permissions
     * @param array $roles
     * @return bool
     */
    public function createRole(array $permissions, array $roles)
    {
        if ($this->validate()) {
            $object = $this->authManager->createRole($this->name);
            $object->description = $this->description;
            if ($this->authManager->add($object)) {
                foreach ($permissions as $permission) {
                    $this->authManager->addChild($object, $this->authManager->getPermission($permission));
                }
                foreach ($roles as $role) {
                    $this->authManager->addChild($object, $this->authManager->getRole($role));
                }
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $name
     * @param array $permissions
     * @param array $roles
     * @return bool
     */
    public function updateRole($name, array $permissions, array $roles)
    {
        if ($this->validate()) {
            $object = $this->authManager->getRole($name);
            $object->description = $this->description;
            if ($this->authManager->update($name, $object)) {
                $this->authManager->removeChildren($object);
                foreach ($permissions as $permission) {
                    $this->authManager->addChild($object, $this->authManager->getPermission($permission));
                }
                foreach ($roles as $role) {
                    $this->authManager->addChild($object, $this->authManager->getRole($role));
                }
                return true;
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public function loadChildren()
    {
        if ($this->permissions + $this->roles == []) {
            foreach ($this->authManager->getChildren($this->name) as $item) {
                switch ($item->type) {
                    case Permission::TYPE :
                        $this->permissions = ArrayHelper::merge($this->permissions, [$item->name]);
                        break;
                    case Role::TYPE :
                        $this->roles = ArrayHelper::merge($this->roles, [$item->name]);
                        break;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getPermissions()
    {
        /* @var $model Permission */

        $permissions = [];
        $models = Permission::find()->where(['type' => Permission::TYPE])->all();
        foreach ($models as $model) {
            $permissions = ArrayHelper::merge(
                $permissions,
                [
                    $model->name => $model->name,
                ]
            );
        }
        return $permissions;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        /* @var $model Role */

        $roles = [];
        $models = Role::find()->where(['type' => Role::TYPE])->all();
        foreach ($models as $model) {
            if (!($this->name == $model->name)) {
                $roles = ArrayHelper::merge(
                    $roles,
                    [
                        $model->name => $model->name,
                    ]
                );
            }
        }
        return $roles;
    }
}
