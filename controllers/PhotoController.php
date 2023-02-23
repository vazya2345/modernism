<?php
namespace app\controllers;
 
use yii\rest\ActiveController;
 
class PhotoController extends ActiveController
{
    public $modelClass = 'app\models\Photo';
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