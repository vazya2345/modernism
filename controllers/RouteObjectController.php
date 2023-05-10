<?php
namespace app\controllers;
 
use yii\rest\ActiveController;
 
class RouteObjectController extends ActiveController
{
    public $modelClass = 'app\models\RouteObject';
    public function behaviors() {
      return [
        [

          'class' => \yii\ filters\ ContentNegotiator::className(),
          'only' => ['index', 'view'],
          'formats' => [
            'application/json' => \yii\ web\ Response::FORMAT_JSON,
          ],
        ],
      ];
    }
}