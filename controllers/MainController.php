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
          'only' => ['index', 'view', 'getobject', 'list', 'indexpage'],
          'formats' => [
            'application/json' => \yii\web\Response::FORMAT_JSON,
          ],
        ],
      ];
    }




    public function actionGetobject($id = 3, $lang = 'uz') {
        $model = Main::findOne($id);
        $mainres = [];
        $res = [];
        if(isset($model)){
                  
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
                  $res['photo_url'] = 'http://modernism.acdf.uz/uploads/'.$model->photo_url;
                  $res['arcitector_id'] = $model->arcitector_id;
                  $res['arcitector_name'] = Architector::getName($model->arcitector_id);

                  if($model->geolocation != NULL){
                    $coordinates = explode(", ", $model->geolocation);
                  }
                  $res['geolocation'] = ['latitude' => $coordinates[0], 'longitude' => $coordinates[1]];

                  $res['video_presentation_url'] = 'http://modernism.acdf.uz/uploads/'.$model->video_presentation_url;
                  $res['audio_presentation_url'] = 'http://modernism.acdf.uz/uploads/'.$model->audio_presentation_url;
                  
                  $res['threed_model_url'] = 'http://modernism.acdf.uz/uploads/'.$model->threed_model_url;
                  $res['build_period'] = $model->build_period;
                  $res['order_num'] = $model->order_num;
                  

                  $mainres["status"] = true;
                  $mainres["result"] = $res;
                  $mainres["message"] = "OK";
        }
        else{
                  $mainres["status"] = false;
                  $mainres["result"] = $res;
                  $mainres["message"] = "NOT FOUND";
        }





        return $mainres;


    }

        public function actionList($lang = 'uz') {
        $models = Main::find()->all();
        $mainres = [];
        $res = [];
        $i = 0;

        foreach ($models as $model) {
                            
                  if($lang == 'ru'){
                    $res[$i]['title'] = $model->title_ru;
                    $res[$i]['desc'] = $model->desc_ru;
                    $res[$i]['address'] = $model->address_ru;
                    $res[$i]['historical_title'] = $model->historical_title_ru;
                    $res[$i]['main_text'] = $model->main_text_ru;
                  }
                  elseif($lang == 'en'){
                    $res[$i]['title'] = $model->title_en;
                    $res[$i]['desc'] = $model->desc_en;
                    $res[$i]['address'] = $model->address_en;
                    $res[$i]['historical_title'] = $model->historical_title_en;
                    $res[$i]['main_text'] = $model->main_text_en;
                  }
                  else{
                    $res[$i]['title'] = $model->title;
                    $res[$i]['desc'] = $model->desc;
                    $res[$i]['address'] = $model->address;
                    $res[$i]['historical_title'] = $model->historical_title;
                    $res[$i]['main_text'] = $model->main_text;
                  }
                  $res[$i]['photo_url'] = 'http://modernism.acdf.uz/uploads/'.$model->photo_url;
                  $res[$i]['arcitector_id'] = $model->arcitector_id;
                  $res[$i]['arcitector_name'] = Architector::getName($model->arcitector_id);

                  if($model->geolocation != NULL){
                    $coordinates = explode(", ", $model->geolocation);
                  }
                  $res[$i]['geolocation'] = ['latitude' => $coordinates[0], 'longitude' => $coordinates[1]];

                  $res[$i]['video_presentation_url'] = 'http://modernism.acdf.uz/uploads/'.$model->video_presentation_url;
                  $res[$i]['audio_presentation_url'] = $model->audio_presentation_url;
                  
                  $resv['threed_model_url'] = 'http://modernism.acdf.uz/uploads/'.$model->threed_model_url;
                  $res[$i]['build_period'] = $model->build_period;
                  $res[$i]['order_num'] = $model->order_num;
                  $i++;
        }

        if(count($res)>0){
                  $mainres["status"] = true;
                  $mainres["result"] = $res;
                  $mainres["message"] = "OK";
        }
        else{
                  $mainres["status"] = false;
                  $mainres["result"] = $res;
                  $mainres["message"] = "NOT FOUND";
        }





        return $mainres;


    }

    public function actionIndexpage($lang = 'uz') {
        $mainres = [];
        $res = [];


        $model = Main::findOne(9);
        $model1 = Main::findOne(8);
        $model2 = Main::findOne(7);
        

                  if($lang == 'ru'){
                    $res['main_text']['title'] = 'About the trail';
                    $res['main_text']['text'] = 'Прежде всего, новая модель организационной деятельности не даёт нам иного выбора, кроме определения системы массового участия. Господа, семантический разбор внешних противодействий позволяет оценить значение экспериментов, поражающих по своей масштабности и грандиозности.';
                    $res['objects'][0]['title'] = $model->title_ru;
                    $res['objects'][1]['title'] = $model1->title_ru;
                    $res['objects'][2]['title'] = $model2->title_ru;
                  }
                  elseif($lang == 'en'){
                    $res['main_text']['title'] = 'About the trail';
                    $res['main_text']['text'] = 'Прежде всего, новая модель организационной деятельности не даёт нам иного выбора, кроме определения системы массового участия. Господа, семантический разбор внешних противодействий позволяет оценить значение экспериментов, поражающих по своей масштабности и грандиозности.';
                    $res['objects'][0]['title'] = $model->title_en;
                    $res['objects'][1]['title'] = $model1->title_en;
                    $res['objects'][2]['title'] = $model2->title_en;
                  }
                  else{
                    $res['main_text']['title'] = 'About the trail';
                    $res['main_text']['text'] = 'Прежде всего, новая модель организационной деятельности не даёт нам иного выбора, кроме определения системы массового участия. Господа, семантический разбор внешних противодействий позволяет оценить значение экспериментов, поражающих по своей масштабности и грандиозности.';
                    $res['objects'][0]['title'] = $model->title;
                    $res['objects'][1]['title'] = $model1->title;
                    $res['objects'][2]['title'] = $model2->title; 
                  }

                  $res['objects'][0]['img'] = 'http://modernism.acdf.uz/uploads/'.$model->photo_url;
                  $res['objects'][0]['id'] = $model->id;

                  $res['objects'][1]['img'] = 'http://modernism.acdf.uz/uploads/'.$model1->photo_url;
                  $res['objects'][1]['id'] = $model1->id;

                  $res['objects'][2]['img'] = 'http://modernism.acdf.uz/uploads/'.$model2->photo_url;
                  $res['objects'][2]['id'] = $model2->id;

                  $mainres["status"] = true;
                  $mainres["result"] = $res;
                  $mainres["message"] = "OK";

        return $mainres;


    }

}