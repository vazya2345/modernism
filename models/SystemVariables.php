<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "system_variables".
 *
 * @property string $id
 * @property string $text_uz
 * @property string $text_ru
 * @property string $text_en
 */
class SystemVariables extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_variables';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'text_uz', 'text_ru', 'text_en'], 'required'],
            [['text_uz', 'text_ru', 'text_en'], 'string'],
            [['id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text_uz' => 'Text Uz',
            'text_ru' => 'Text Ru',
            'text_en' => 'Text En',
        ];
    }
}
