<?php

namespace app\modules\language\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%language}}".
 *
 * @property string $id
 * @property string $title
 * @property string $iso
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    private static $_languages = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%language}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 16],
            [['iso'], 'string', 'max' => 8],
            [['title', 'iso'], 'required'],
            [['iso'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('language', 'ID'),
            'title' => Yii::t('language', 'Title'),
            'iso' => Yii::t('language', 'ISO'),
        ];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function listing()
    {
        if (self::$_languages == []) {
            self::$_languages = self::find()->asArray()->all();
        }
        return self::$_languages;
    }

    /**
     * @return string
     */
    public static function getCurrent()
    {
        return Yii::$app->language;
    }

    /**
     * @param string $language
     */
    public static function setCurrent($language)
    {
        Yii::$app->language = $language;
    }

    /**
     * @param string $language
     * @return bool
     */
    public static function isLanguage($language)
    {
        if (in_array($language, ArrayHelper::getColumn(self::listing(), 'iso'))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return static
     */
    public static function getCurrentRecord()
    {
        return self::findOne(['iso' => self::getCurrent()]);
    }

    /**
     * @return mixed
     */
    public static function getCurrentCode()
    {
        list($code) = explode('-', self::getCurrent(), 2);
        return $code;
    }
}
