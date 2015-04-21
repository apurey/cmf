<?php

namespace app\modules\translation\models;

use Yii;
use app\modules\language\models\Language;

/**
 * This is the model class for table "{{%i18n_message}}".
 *
 * @property string $id
 * @property string $language
 * @property string $translation
 *
 * @property Language $language0
 * @property I18nSource $id0
 */
class I18nMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%i18n_message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'language'], 'required'],
            [['id'], 'integer'],
            [['language'], 'string', 'max' => 8],
            [['translation'], 'string', 'max' => 128],
            [['translation'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'language' => Yii::t('translation', 'Language'),
            'translation' => Yii::t('translation', 'Translation'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getId()
    {
        return $this->hasOne(I18nSource::className(), ['id' => 'id']);
    }
}
