<?php

namespace app\modules\magic\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%magic}}".
 *
 * @property integer $id
 * @property string $module
 * @property integer $group_id
 * @property integer $record_id
 * @property string $label
 * @property string $src
 * @property string $preview
 * @property string $mime
 * @property int $position
 */
class Magic extends \yii\db\ActiveRecord
{
    const PREVIEW_WIDTH = 600;
    const PREVIEW_HEIGHT = 400;

    const ATTRIBUTE = 'files[]';

    /**
     * @var \yii\web\UploadedFile::getInstance()
     */
    public $file = null;

    /**
     * @var \yii\web\UploadedFile::getInstances()
     */
    public $files = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%magic}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'record_id', 'position'], 'integer'],
            [['module'], 'string', 'max' => 64],
            [['label'], 'string', 'max' => 256],
            [['src', 'preview', 'mime'], 'string', 'max' => 128],
            [['file'], 'file', 'skipOnEmpty' => false, 'on' => ['one']],
            [['files'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 20, 'on' => ['many']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('magic', 'ID'),
            'module' => Yii::t('magic', 'Module'),
            'group_id' => Yii::t('magic', 'Group ID'),
            'record_id' => Yii::t('magic', 'Record ID'),
            'label' => Yii::t('magic', 'Label'),
            'src' => Yii::t('magic', 'Src'),
            'preview' => Yii::t('magic', 'Preview'),
            'mime' => Yii::t('magic', 'MIME'),
            'position' => Yii::t('magic', 'Position'),
            'file' => Yii::t('magic', 'File'),
            'files' => Yii::t('magic', 'Files'),
        ];
    }

    /**
     * @return string
     */
    public function getSrcUrl()
    {
        return DIRECTORY_SEPARATOR . Magic::getUploadDir() . DIRECTORY_SEPARATOR . $this->src;
    }

    /**
     * @return string
     */
    public function getPreviewUrl()
    {
        return DIRECTORY_SEPARATOR . Magic::getUploadDir() . DIRECTORY_SEPARATOR . $this->preview;
    }

    /**
     * @return string
     */
    public function getSrcPath()
    {
        return Yii::getAlias('@webroot') . $this->getSrcUrl();
    }

    /**
     * @return string
     */
    public function getPreviewPath()
    {
        return Yii::getAlias('@webroot') . $this->getPreviewUrl();
    }

    public function setSrc()
    {
        $this->src =
            $this->module . '-' . intval($this->group_id) . '-' . intval($this->record_id) . '-src-' . microtime(
                true
            ) . '.' . $this->file->getExtension();
    }

    public function setPreview()
    {
        $this->preview =
            $this->module . '-' . intval($this->group_id) . '-' . intval($this->record_id) . '-preview-' . microtime(
                true
            ) . '.' . $this->file->getExtension();
    }

    /**
     * @param int $part
     * @return mixed
     */
    public function getType($part = 0)
    {
        $type = explode('/', $this->mime, 2);
        return ArrayHelper::getValue($type, $part, null);
    }

    /**
     * @return mixed
     */
    public static function getUploadDir()
    {
        /* @var $module \app\modules\magic\Magic */
        $module = Yii::$app->getModule('magic');
        return $module->uploadDir;
    }
}
