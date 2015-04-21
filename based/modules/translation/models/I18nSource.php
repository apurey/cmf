<?php

namespace app\modules\translation\models;

use Yii;
use app\modules\language\models\Language;

/**
 * This is the model class for table "{{%i18n_source}}".
 *
 * @property string $id
 * @property string $category
 * @property string $message
 *
 * @property I18nMessage[] $i18nMessage
 * @property Language[] $languages
 */
class I18nSource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%i18n_source}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category'], 'string', 'max' => 32],
            [['message'], 'string', 'max' => 128],
            [['message'], 'unique'],
            [['category', 'message'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'category' => Yii::t('translation', 'Category'),
            'message' => Yii::t('translation', 'Message'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getI18nMessage()
    {
        return $this
            ->hasOne(I18nMessage::className(), ['id' => 'id'])
            ->where(['language' => Language::getCurrent()]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this
            ->hasMany(Language::className(), ['iso' => 'language'])
            ->viaTable('{{{%i18n_message}}}', ['id' => 'id']);
    }
}
