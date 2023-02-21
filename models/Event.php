<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property int $main_id
 * @property string|null $title
 * @property string|null $desc
 * @property string|null $photo_url
 * @property string|null $event_date
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['main_id'], 'required'],
            [['main_id'], 'integer'],
            [['desc'], 'string'],
            [['event_date'], 'safe'],
            [['title', 'photo_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_id' => 'Main ID',
            'title' => 'Title',
            'desc' => 'Desc',
            'photo_url' => 'Photo Url',
            'event_date' => 'Event Date',
        ];
    }
}
