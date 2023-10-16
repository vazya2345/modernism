<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "photo".
 *
 * @property int $id
 * @property int $main_id
 * @property string|null $photo_url
 * @property string|null $title
 * @property string|null $photo_date
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $imageFile;

    public static function tableName()
    {
        return 'photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['main_id'], 'required'],
            [['main_id'], 'integer'],
            [['photo_date'], 'safe'],
            [['photo_url', 'title'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'maxFiles' => 20, 'skipOnEmpty' => true, 'extensions' => 'png, jpg, JPG'],
        ];
    }

    public function upload($filename)
    {
        $this->imageFile->saveAs('uploads/' . $filename);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_id' => 'Object',
            'photo_url' => 'Photo',
            'title' => 'Title',
            'photo_date' => 'Date',
        ];
    }
}
