<?php
namespace app\controllers;
 
use yii\rest\ActiveController;
use app\models\Main;
use app\models\Architector;
class MainController extends ActiveController
{
    public $modelClass = 'app\models\Main';
    public function behaviors() {
      return [
        [
          'class' => \yii\filters\ContentNegotiator::className(),
          'only' => ['index', 'view', 'getobject'],
          'formats' => [
            'application/json' => \yii\web\Response::FORMAT_JSON,
          ],
        ],
      ];
    }




    public function actionGetobject($id = 3, $lang = 'uz') {
        $model = Main::findOne($id);
        $res = [];
        if($lang == 'ru'){
          $res['title'] = $model->title_ru;
          $res['desc'] = $model->desc_ru;
          $res['address'] = $model->address_ru;
          $res['historical_title'] = $model->historical_title_ru;
          $res['main_text'] = $model->main_text_ru;
        }
        elseif($lang == 'en'){
          $res['title'] = $model->title_en;
          $res['desc'] = $model->desc_en;
          $res['address'] = $model->address_en;
          $res['historical_title'] = $model->historical_title_en;
          $res['main_text'] = $model->main_text_en;
        }
        else{
          $res['title'] = $model->title;
          $res['desc'] = $model->desc;
          $res['address'] = $model->address;
          $res['historical_title'] = $model->historical_title;
          $res['main_text'] = $model->main_text;
        }
        $res['photo_url'] = $model->photo_url;
        $res['arcitector_id'] = $model->arcitector_id;
        $res['arcitector_name'] = Architector::getName($model->arcitector_id);

        if($model->geolocation != NULL){
          $coordinates = explode(", ", $model->geolocation);
        }
        $res['geolocation'] = ['latitude' => $coordinates[0], 'longitude' => $coordinates[1]];

        $res['video_presentation_url'] = $model->video_presentation_url;
        $res['audio_presentation_url'] = $model->audio_presentation_url;
        
        $res['threed_model_url'] = $model->threed_model_url;
        $res['build_period'] = $model->build_period;
        $res['order_num'] = $model->order_num;
        

        return $res;


    }

}