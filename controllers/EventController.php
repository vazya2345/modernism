<?php
namespace app\controllers;
 
use yii\rest\ActiveController;
 
class EventController extends ActiveController
{
    public $modelClass = 'app\models\Event';
    public function behaviors() {
      return [
        [
<<<<<<< HEAD
          'class' => \yii\ filters\ ContentNegotiator::className(),
          'only' => ['index', 'view'],
          'formats' => [
            'application/json' => \yii\ web\ Response::FORMAT_JSON,
=======
          'class' => \yii\filters\ContentNegotiator::className(),
          'only' => ['index', 'view'],
          'formats' => [
            'application/json' => \yii\web\Response::FORMAT_JSON,
>>>>>>> 3ee9d8b12cff4a9b53b4418d8c88fb4fd020cb70
          ],
        ],
      ];
    }
}