<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "architector".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $photo_url
 * @property string|null $desc
 * @property string|null $birthdate
 * @property string|null $deathdate
 */
class Architector extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $imageFile;

    public static function tableName()
    {
        return 'architector';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desc'], 'string'],
            [['birthdate', 'deathdate'], 'safe'],
            [['name', 'photo_url'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, JPG'],
        ];
    }

    public function upload($filename)
    {
        if ($this->validate()) {
            // $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . time() . '.' . $this->imageFile->extension);
            $this->imageFile->saveAs('uploads/' . $filename);
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
            'name' => 'Name',
            'photo_url' => 'Photo',
            'desc' => 'Desc',
            'birthdate' => 'Birthdate',
            'deathdate' => 'Deathdate',
        ];
    }

    public static function getAll()
    {
        $array = self::find()->all();
        $result = ArrayHelper::map($array, 'id', 'name');
        return $result;
    }

    public static function getName($id)
    {
        $model = self::findOne($id);
        if($model)
            return $model->name;
        else
            return 'Not Found';
    }
}
