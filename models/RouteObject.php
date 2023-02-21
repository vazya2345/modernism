<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "route_object".
 *
 * @property int $id
 * @property int|null $route_id
 * @property int|null $main_id
 */
class RouteObject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'route_object';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['route_id', 'main_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route_id' => 'Route ID',
            'main_id' => 'Main ID',
        ];
    }
}
