<?php

namespace app\modules\auth\models;

use Yii;

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
class Permission extends \yii\db\ActiveRecord
{
    const TYPE = 2;

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
            ['name', 'validatePermission'],
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
        ];
    }

    public function validatePermission()
    {
        if (!$this->hasErrors()) {
            if ($this->getIsNewRecord() && $this->authManager->getPermission($this->name)) {
                $this->addError('name', Yii::t('item', 'This name already exists'));
            }
        }
    }

    /**
     * @return bool
     */
    public function createPermission()
    {
        if ($this->validate()) {
            $permission = $this->authManager->createPermission($this->name);
            $permission->description = $this->description;
            return $this->authManager->add($permission);
        }
        return false;
    }

    /**
     * @return bool
     */
    public function updatePermission()
    {
        if ($this->validate()) {
            $permission = $this->authManager->getPermission($this->name);
            $permission->description = $this->description;
            return $this->authManager->update($this->name, $permission);
        }
        return false;
    }
}
