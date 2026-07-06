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
 * @property string|null $historical_title
 * @property string|null $historical_title_ru
 * @property string|null $historical_title_en
 * @property string|null $photo_url
 * @property string|null $build_period
 * @property string|null $status
 * @property int|null $arcitector_id
 * @property string|null $desc
 * @property string|null $desc_ru
 * @property string|null $desc_en
 * @property string|null $main_text
 * @property string|null $main_text_ru
 * @property string|null $main_text_en
 * @property string|null $address
 * @property string|null $address_ru
 * @property string|null $address_en
 * @property string|null $video_presentation_url
 * @property string|null $geolocation
 * @property string|null $threed_model_url
 * @property string|null $audio_presentation_url
 * @property int|null $order_num
 */
class Main extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $imageFile;
    public $videoFile;
    public $threedFile;
    public $audioFile;


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
            [['order_num'], 'integer'],
            [['desc', 'desc_ru', 'desc_en', 'main_text', 'main_text_ru', 'main_text_en', 'address', 'address_ru', 'address_en', 'arcitectors_text', 'arcitectors_text_ru', 'arcitectors_text_en'], 'string'],
            [['title', 'title_ru', 'title_en', 'historical_title', 'historical_title_ru', 'historical_title_en', 'photo_url', 'status', 'video_presentation_url', 'geolocation', 'threed_model_url', 'audio_presentation_url'], 'string', 'max' => 255],
            [['build_period'], 'string', 'max' => 50],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, JPG'],
            [['videoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp4'],
            [['threedFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'svg'],
            [['audioFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp3, wav'],
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

    public function uploadAudio($filename)
    {
        if ($this->validate()) {
            // $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . time() . '.' . $this->imageFile->extension);
            $this->audioFile->saveAs('uploads/' . $filename);
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
            'title' => 'Nomi',
            'title_ru' => 'Название',
            'title_en' => 'Title',
            'historical_title' => 'Oldingi nomi',
            'historical_title_ru' => 'Историческое название',
            'historical_title_en' => 'Historical Title',
            'photo_url' => 'Asosiy rasm',
            'build_period' => 'Qurilgan vaqti',
            'status' => 'Status',
            'arcitectors_text' => 'Me\'morlar',
            'arcitectors_text_ru' => 'Архитекторы',
            'arcitectors_text_en' => 'Architectors',
            'desc' => 'Tasnifi',
            'desc_ru' => 'Описание',
            'desc_en' => 'Description',
            'main_text' => 'Asosiy matn',
            'main_text_ru' => 'Основной текст',
            'main_text_en' => 'Main Text',
            'address' => 'Manzil',
            'address_ru' => 'Адрес',
            'address_en' => 'Address',
            'video_presentation_url' => 'Video',
            'geolocation' => 'Geolokatsiya',
            'threed_model_url' => '3D model',
            'audio_presentation_url' => 'Audio',
            'order_num' => 'Tartib raqami',
        ];
    }

    public static function getAll($lang='ru')
    {
        $array = self::find()->all();
        if($lang=='ru'){
            $result = ArrayHelper::map($array, 'id', 'title_ru');
        }
        elseif($lang=='en'){
            $result = ArrayHelper::map($array, 'id', 'title_en');
        }
        else{
            $result = ArrayHelper::map($array, 'id', 'title');
        }
        
        return $result;
    }

    public static function getName($id,$lang='ru')
    {
        $model = self::findOne($id);
        if($model){
            if($lang=='ru'){
                return $model->title_ru;
            }
            elseif($lang=='en'){
                return $model->title_en;
            }
            else{
                return $model->title;
            }
        }
        else
            return 'Not Found';
    }
}
