<?php

namespace app\modules\page\models;

use Yii;
use app\modules\magic\models\Magic;
use app\modules\language\models\Language;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $text
 * @property string $layout
 * @property string $template
 * @property string $description
 * @property string $keywords
 * @property int $active
 * @property string $language
 *
 * @property Language $language0
 */
class Page extends \yii\db\ActiveRecord
{
    const ACTIVE_YES = 1;
    const ACTIVE_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 64],
            [['title'], 'string', 'max' => 128],
            [['text'], 'string'],
            [['layout'], 'string', 'max' => 64],
            [['template'], 'string', 'max' => 64],
            [['description', 'keywords'], 'string', 'max' => 256],
            [['language'], 'string', 'max' => 8],
            [['name', 'title'], 'required'],
            [['name'], 'unique', 'targetAttribute' => ['name', 'language']],
            [['active'], 'in', 'range' => array_keys(Page::getActiveList())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('page', 'ID'),
            'name' => Yii::t('page', 'Name'),
            'title' => Yii::t('page', 'Title'),
            'text' => Yii::t('page', 'Text'),
            'layout' => Yii::t('page', 'Layout'),
            'template' => Yii::t('page', 'Template'),
            'description' => Yii::t('page', 'Description'),
            'keywords' => Yii::t('page', 'Keywords'),
            'active' => Yii::t('page', 'Active'),
            'language' => Yii::t('page', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['iso' => 'language']);
    }

    /**
     * @return mixed
     */
    public static function getLayouts()
    {
        return Yii::$app->controller->module->layouts;
    }

    /**
     * @return mixed
     */
    public static function getTemplates()
    {
        return Yii::$app->controller->module->templates;
    }

    /**
     * @param string $route
     * @return mixed
     */
    public static function parse($route)
    {
        $pages = explode('/', trim($route, '/'));
        return array_pop($pages);
    }

    /**
     * @return array
     */
    public static function getActiveList()
    {
        return [
            Page::ACTIVE_YES => Yii::t('page', 'Yes'),
            Page::ACTIVE_NO => Yii::t('page', 'No'),
        ];
    }

	public function delete()
	{
		$images = Magic::find()->where(['module'=>$this->formName(), 'group_id'=>0, 'record_id'=>$this->id])->all();
		if ($images) {
			foreach ($images as $image) {
				$image->delete();
			}
		}

		parent::delete();
	}
    
}
