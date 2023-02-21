<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "main".
 *
 * @property int $id
 * @property string $title
 * @property string|null $title_ru
 * @property string|null $title_en
 * @property string|null $photo_url
 * @property string|null $desc
 * @property string|null $desc_ru
 * @property string|null $desc_en
 * @property int|null $arcitector_id
 * @property string|null $address
 * @property string|null $address_ru
 * @property string|null $address_en
 * @property string|null $geolocation
 * @property string|null $video_presentation_url
 * @property string|null $threed_model_url
 * @property string|null $build_period
 */
class Main extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $imageFile;
    public $videoFile;
    public $threedFile;

    public static function tableName()
    {
        return 'main';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['desc', 'desc_ru', 'desc_en', 'address', 'address_ru', 'address_en'], 'string'],
            [['arcitector_id'], 'integer'],
            [['title', 'title_ru', 'title_en', 'photo_url', 'geolocation', 'video_presentation_url', 'threed_model_url'], 'string', 'max' => 255],
            [['build_period'], 'string', 'max' => 50],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, JPG'],
            [['videoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp4'],
            [['threedFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'svg'],
        ];
    }

    public function uploadImage($filename)
    {
        if ($this->validate()) {
            // $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . time() . '.' . $this->imageFile->extension);
            $this->imageFile->saveAs('uploads/' . $filename);
            return true;
        } else {
            return false;
        }
    }

    public function uploadVideo($filename)
    {
        if ($this->validate()) {
            // $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . time() . '.' . $this->imageFile->extension);
            $this->videoFile->saveAs('uploads/' . $filename);
            return true;
        } else {
            return false;
        }
    }

    public function uploadThreed($filename)
    {
        if ($this->validate()) {
            // $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . time() . '.' . $this->imageFile->extension);
            $this->threedFile->saveAs('uploads/' . $filename);
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'O‘zbekcha nomi',
            'title_ru' => 'Русское название',
            'title_en' => 'English title',
            'photo_url' => 'Asosiy rasm',
            'desc' => 'Tasnifi',
            'desc_ru' => 'Русское описание',
            'desc_en' => 'English description',
            'arcitector_id' => 'Arhitektor',
            'address' => 'Manzil',
            'address_ru' => 'Адрес на русском',
            'address_en' => 'Address in English',
            'geolocation' => 'Geomanzil',
            'video_presentation_url' => 'Video',
            'threed_model_url' => '3D model',
            'build_period' => 'Period',
        ];
    }

    public static function getAll()
    {
        $array = self::find()->all();
        $result = ArrayHelper::map($array, 'id', 'title');
        return $result;
    }

    public static function getName($id)
    {
        $model = self::findOne($id);
        if($model)
            return $model->title;
        else
            return 'Not Found';
    }
}
