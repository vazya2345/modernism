<?php
namespace app\controllers;
 
use yii\rest\ActiveController;
 
class EventController extends ActiveController
{
    public $modelClass = 'app\models\Event';
    public function behaviors() {
      return [
        [
          'class' => \yii\filters\ContentNegotiator::className(),
          'only' => ['index', 'view'],
          'formats' => [
            'application/json' => \yii\web\Response::FORMAT_JSON,
          ],
        ],
      ];
    }
}