<?php
namespace app\controllers;
 
use yii\rest\ActiveController;
use app\models\Main;
use app\models\Photo;
use app\models\Architector;
class MainController extends ActiveController
{
    public $modelClass = 'app\models\Main';
    public function behaviors() {
      return [
        [
          'class' => \yii\filters\ContentNegotiator::className(),
          'only' => ['index', 'view', 'getobject', 'list', 'indexpage', 'aboutpage'],
          'formats' => [
            'application/json' => \yii\web\Response::FORMAT_JSON,
          ],
        ],
      ];
    }




    public function actionGetobject($id = 10) {
        $model = Main::findOne($id);
        $mainres = [];
        $res = [];
        if(isset($model)){
                  
                  
                    $res['title_ru'] = $model->title_ru;
                    $res['desc_ru'] = $model->desc_ru;
                    $res['address_ru'] = $model->address_ru;
                    $res['historical_title_ru'] = $model->historical_title_ru;
                    $res['main_text_ru'] = $model->main_text_ru;
                    $res['arcitectors_text_ru'] = $model->arcitectors_text_ru;

                    $res['title_en'] = $model->title_en;
                    $res['desc_en'] = $model->desc_en;
                    $res['address_en'] = $model->address_en;
                    $res['historical_title_en'] = $model->historical_title_en;
                    $res['main_text_en'] = $model->main_text_en;
                    $res['arcitectors_text_en'] = $model->arcitectors_text_en;

                    $res['title'] = $model->title;
                    $res['desc'] = $model->desc;
                    $res['address'] = $model->address;
                    $res['historical_title'] = $model->historical_title;
                    $res['main_text'] = $model->main_text;
                    $res['arcitectors_text'] = $model->arcitectors_text;


                  $res['photo_url'] = 'http://modernism.acdf.uz/uploads/'.$model->photo_url;
                  

                  if($model->geolocation != NULL){
                    $coordinates = explode(", ", $model->geolocation);
                  }
                  $res['geolocation'] = ['latitude' => $coordinates[0], 'longitude' => $coordinates[1]];

                  $res['video_presentation_url'] = 'http://modernism.acdf.uz/uploads/'.$model->video_presentation_url;
                  $res['audio_presentation_url'] = 'http://modernism.acdf.uz/uploads/'.$model->audio_presentation_url;
                  
                  $res['threed_model_url'] = 'http://modernism.acdf.uz/uploads/'.$model->threed_model_url;
                  $res['build_period'] = $model->build_period;
                  $res['order_num'] = $model->order_num;


                  $res['status_ru'] = $model->status;
                  if($model->status=='не охраняется государством'){
                    $res['status_en'] = 'unprotected';
                    $res['status'] = 'davlat tomonidan muhofaza qilinmaydi';
                  }
                  elseif($model->status=='охраняется государством'){
                    $res['status_en'] = 'nationally protected';
                    $res['status'] = 'davlat tomonidan muhofazalanadi';
                  }
                  else{
                    $res['status_en'] = 'undefined';
                    $res['status'] = 'aniqlanmagan';
                  }





                  $photo_modern = Photo::find()->where(['main_id'=>$id, 'title'=>'1'])->all();
                  $photo_archive = Photo::find()->where(['main_id'=>$id, 'title'=>'2'])->all();
                  $i=0;
                  foreach ($photo_modern as $key) {
                    $res['photo_modern'][$i] = 'http://modernism.acdf.uz/uploads/'.$key->photo_url;
                    $i++;
                  }
                  $i=0;
                  foreach ($photo_archive as $key) {
                    $res['photo_archive'][$i] = 'http://modernism.acdf.uz/uploads/'.$key->photo_url;
                    $i++;
                  }

                  

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

    public function actionList()
    {
        $baseUrl = 'http://modernism.acdf.uz/uploads/';

        $result = array_map(function ($model) use ($baseUrl) {
            $coordinates = $model->geolocation !== null
                ? explode(', ', $model->geolocation)
                : [null, null];

            return [
                'id' => $model->id,
                'title' => $model->title,
                'desc' => $model->desc,
                'address' => $model->address,
                'historical_title' => $model->historical_title,
                'main_text' => $model->main_text,
                'arcitectors_text' => $model->arcitectors_text,

                'title_ru' => $model->title_ru,
                'desc_ru' => $model->desc_ru,
                'address_ru' => $model->address_ru,
                'historical_title_ru' => $model->historical_title_ru,
                'main_text_ru' => $model->main_text_ru,
                'arcitectors_text_ru' => $model->arcitectors_text_ru,

                'title_en' => $model->title_en,
                'desc_en' => $model->desc_en,
                'address_en' => $model->address_en,
                'historical_title_en' => $model->historical_title_en,
                'main_text_en' => $model->main_text_en,
                'arcitectors_text_en' => $model->arcitectors_text_en,

                'photo_url' => $model->photo_url ? $baseUrl . $model->photo_url : null,
                'geolocation' => [
                    'latitude' => $coordinates[0] ?? null,
                    'longitude' => $coordinates[1] ?? null,
                ],
                'video_presentation_url' => $model->video_presentation_url ? $baseUrl . $model->video_presentation_url : null,
                'audio_presentation_url' => $model->audio_presentation_url,
                'threed_model_url' => $model->threed_model_url ? $baseUrl . $model->threed_model_url : null,
                'build_period' => $model->build_period,
                'order_num' => $model->order_num,
            ];
        }, Main::find()->orderBy(['order_num' => SORT_ASC])->all());

        return [
            'status' => !empty($result),
            'result' => $result,
            'message' => !empty($result) ? 'OK' : 'NOT FOUND',
        ];
    }

    public function actionIndexpage() {
        $mainres = [];
        $res = [];


        $model = Main::findOne(10);
        $model1 = Main::findOne(11);
        $model2 = Main::findOne(12);


                    $res['main_text']['title_ru'] = 'О проекте';
                    $res['main_text']['text_ru'] = 'Tashkent Modernism XX/XXI — масштабный исследовательский проект, посвященный архитектуре ташкентского модернизма второй половины XX века. Целью проекта является не только исследование архитектуры, но и развитие и сохранение городской среды Ташкента и наследия модернизма для горожан и гостей города. 

Приложение Tashkent Modernism объединяет двадцать один объект, созданный с 1964 по 1993 года, в единый маршрут, который позволяет познакомиться с архитектурным достоянием столицы Узбекистана. Начать исследование модернистских зданий можно из любой точки города: приложение подскажет, где находится ближайший объект, и поможет проложить до него маршрут. 

Знакомство с шедеврами архитектуры происходит по маршруту, разработанному бюро Laboratorio Permanente. Страница каждого объекта включает не только современные и архивные фотографии, но и тексты об их истории и архитектурных особенностях, основанный на обширных исследовательских материалах, собранных командой Фонда развития культуры и искусства Узбекистана, архитектурным бюро GRACE и историком архитектуры Борисом Чуховичем.

Помимо страниц с подробной информацией о каждом здании, приложение позволяет увидеть маршрут на интерактивный карте, а также ознакомиться с историческим материалом в разделе «Список» даже тем, кто находится вдалеке от Ташкента.';
                    $res['objects'][0]['title_ru'] = $model->title_ru;
                    $res['objects'][1]['title_ru'] = $model1->title_ru;
                    $res['objects'][2]['title_ru'] = $model2->title_ru;



                    $res['main_text']['title_en'] = 'About the project';
                    $res['main_text']['text_en'] = 'Tashkent Modernism XX/XXI is an extensive research project dedicated to the modernist architecture of Uzbekistan\'s capital. The project aims not only to study the architecture of the second half of the twentieth century but also to develop Tashkent’s urban environment and protect the legacy of modernism for both residents and visitors of the city.

The Tashkent Modernism app consolidates twenty-one architectural objects created between 1964 and 1993 into a single route, allowing users to delve into Tashkent\'s rich architectural heritage. You can begin your journey from any location in the city; the app will identify the closest landmark and assist in mapping out a route to it.

The architectural trail was developed and curated by Laboratorio Permanente. Each site has a dedicated page, which features both modern and archival photos, as well as informative texts based on extensive research materials collected by the team of the Art and Culture Development Foundation of Uzbekistan, the architectural firm GRACE, and architectural historian Boris Chukhovich.

In addition to pages with detailed information about each building, the app allows you to see the route on an interactive map and to read historical materials in the "List" section, even if you are not in Tashkent.';
                    $res['objects'][0]['title_en'] = $model->title_en;
                    $res['objects'][1]['title_en'] = $model1->title_en;
                    $res['objects'][2]['title_en'] = $model2->title_en;



                    $res['main_text']['title'] = 'Loyiha haqida';
                    $res['main_text']['text'] = '“Tashkent Modernism.XX/XXI” XX asrning ikkinchi yarmidagi Toshkent modernizmi meʼmorchiligiga bagʻishlangan keng koʻlamli tadqiqot loyihasi hisoblanadi. Loyiha nafaqat me’morchilikni oʻrganish, balki Toshkentning shahar muhitini rivojlantirish, shahar aholisi va mehmonlari uchun modernizm merosini asrab-avaylashga qaratilgan.

“Tashkent Modernism” ilovasi 1964-1993 yillar oralig‘ida barpo etilgan yigirma bitta obyektni yagona marshrutga birlashtirib, O‘zbekiston poytaxtining me’moriy merosi bilan yaqindan tanishish imkonini beradi. Shaharning istalgan nuqtasidan modernistik binolarni o‘rganishni boshlash mumkin: ilova eng yaqin ob’ekt qayerda ekanligini ko‘rsatadi va unga yo‘nalish olishda yordam beradi.

Me’morchilik durdonalari bilan tanishish Laboratorio Permanente byurosi tomonidan ishlab chiqilgan marshrut bo‘ylab amalga oshiriladi. Har bir obʼyekt sahifasi nafaqat zamonaviy va arxiv fotosuratlarni, balki Oʻzbekiston Madaniyat va sanʼatni rivojlantirish jamgʻarmasi jamoasi, “Grace” me’morchilik byurosi hamda me’morchilik tarixshunosi Boris Chuxovich tomonidan toʻplangan keng qamrovli tadqiqot materiallari asosida ularning tarixi va meʼmoriy xususiyatlari haqidagi matnlar ham o‘rin olgan.

Ilova har bir bino haqida batafsil ma’lumotga ega sahifalardan tashqari, interaktiv xaritada marshrutni ko‘rish va “Ro‘yxat” bo‘limida joylashgan tarixiy materiallar bilan hatto Toshkentdan olisda bo‘lganlarga ham tanishish imkonini yaratadi.';
                    $res['objects'][0]['title'] = $model->title;
                    $res['objects'][1]['title'] = $model1->title;
                    $res['objects'][2]['title'] = $model2->title; 

                  $res['objects'][0]['img'] = 'http://modernism.acdf.uz/uploads/'.$model->photo_url;
                  $res['objects'][0]['id'] = $model->id;

                  $res['objects'][1]['img'] = 'http://modernism.acdf.uz/uploads/'.$model1->photo_url;
                  $res['objects'][1]['id'] = $model1->id;

                  $res['objects'][2]['img'] = 'http://modernism.acdf.uz/uploads/'.$model2->photo_url;
                  $res['objects'][2]['id'] = $model2->id;



                  $res['main_image'][0] = 'http://modernism.acdf.uz/uploads/frame1.png';
                  $res['main_image'][1] = 'http://modernism.acdf.uz/uploads/frame2.png';
                  $res['main_image'][2] = 'http://modernism.acdf.uz/uploads/frame3.png';

                  $mainres["status"] = true;
                  $mainres["result"] = $res;
                  $mainres["message"] = "OK";

        return $mainres;


    }


    public function actionAboutpage() {
        $mainres = [];
        $res = [];


        
        $res['top']['title_ru'] = 'О проекте маршрутов';
        $res['top']['text_ru'] = 'Прежду всего, новая модель организационной деятельности не даёт нам иного выбора, кроме определения системы массового учатия. Господа, семантический разбор внешних продиводействий позволяет оценить масштабность и грандиозность';

        $res['top']['title_en'] = 'О проекте маршрутов';
        $res['top']['text_en'] = 'Прежду всего, новая модель организационной деятельности не даёт нам иного выбора, кроме определения системы массового учатия. Господа, семантический разбор внешних продиводействий позволяет оценить масштабность и грандиозность';

        $res['top']['title_uz'] = 'О проекте маршрутов';
        $res['top']['text_uz'] = 'Прежду всего, новая модель организационной деятельности не даёт нам иного выбора, кроме определения системы массового учатия. Господа, семантический разбор внешних продиводействий позволяет оценить масштабность и грандиозность';


        $res['header_ru'] = 'Участники';
        $res['header_en'] = 'Участники';
        $res['header_uz'] = 'Участники';

        
        $res['main'][0]['title_ru'] = 'Комиссар'.':';
        $res['main'][0]['text_ru'][0] = 'Гаянэ Умерова, председатель Фонда развития культуры и искусства Узбекистана';

        $res['main'][0]['title_en'] = 'Комиссар:';
        $res['main'][0]['text_en'][0] = 'Гаянэ Умерова, председатель Фонда развития культуры и искусства Узбекистана';


        $res['main'][0]['title_uz'] = 'Комиссар:';
        $res['main'][0]['text_uz'][0] = 'Гаянэ Умерова, председатель Фонда развития культуры и искусства Узбекистана';




        $res['main'][1]['title_ru'] = 'Исследователи:'.':';
        $res['main'][1]['text_ru'][0] = 'Grace (Екатерина Головатюк и Джакомо Кантони, Ксения Бисти, Наталья Салтан, Рикардо Саломони, Чжунцзянь Ки),';
        $res['main'][1]['text_ru'][1] = 'Politecnico di Milano (Давиде Дель Курто, Андреа Гритти, София Целли, Федерика Део),';
        $res['main'][1]['text_ru'][2] = 'Борис Чухович,';
        $res['main'][1]['text_ru'][3] = 'Laboratorio Permanente (Никола Русси, Анжелика Силос Лабини, Лайне Лазда, Пьетро Нобили Вителлески, Амедео Норис)';

        $res['main'][1]['title_en'] = 'Исследователи:';
        $res['main'][1]['text_en'][0] = 'Grace (Екатерина Головатюк и Джакомо Кантони, Ксения Бисти, Наталья Салтан, Рикардо Саломони, Чжунцзянь Ки),';
        $res['main'][1]['text_en'][1] = 'Politecnico di Milano (Давиде Дель Курто, Андреа Гритти, София Целли, Федерика Део),';
        $res['main'][1]['text_en'][2] = 'Борис Чухович,';
        $res['main'][1]['text_en'][3] = 'Laboratorio Permanente (Никола Русси, Анжелика Силос Лабини, Лайне Лазда, Пьетро Нобили Вителлески, Амедео Норис)';

        $res['main'][1]['title_uz'] = 'Исследователи:';
        $res['main'][1]['text_uz'][0] = 'Grace (Екатерина Головатюк и Джакомо Кантони, Ксения Бисти, Наталья Салтан, Рикардо Саломони, Чжунцзянь Ки),';
        $res['main'][1]['text_uz'][1] = 'Politecnico di Milano (Давиде Дель Курто, Андреа Гритти, София Целли, Федерика Део),';
        $res['main'][1]['text_uz'][2] = 'Борис Чухович,';
        $res['main'][1]['text_uz'][3] = 'Laboratorio Permanente (Никола Русси, Анжелика Силос Лабини, Лайне Лазда, Пьетро Нобили Вителлески, Амедео Норис)';



        $res['main'][2]['title_ru'] = 'Арт-директор:';
        $res['main'][2]['text_ru'][0] = 'Александр Келлас';

        $res['main'][2]['title_en'] = 'Арт-директор:';
        $res['main'][2]['text_en'][0] = 'Александр Келлас';

        $res['main'][2]['title_uz'] = 'Арт-директор:';
        $res['main'][2]['text_uz'][0] = 'Александр Келлас';


 

        $res['main'][3]['title_ru'] = 'Дизайн приложения:';
        $res['main'][3]['text_ru'][0] = 'Артур Ха';

        $res['main'][3]['title_en'] = 'Дизайн приложения:';
        $res['main'][3]['text_en'][0] = 'Артур Ха';

        $res['main'][3]['title_uz'] = 'Дизайн приложения:';
        $res['main'][3]['text_uz'][0] = 'Артур Ха';




        $res['main'][4]['title_ru'] = 'Фотографии:';
        $res['main'][4]['text_ru'][0] = 'Алексей Народицкий';

        $res['main'][4]['title_en'] = 'Фотографии:';
        $res['main'][4]['text_en'][0] = 'Алексей Народицкий';

        $res['main'][4]['title_uz'] = 'Фотографии:';
        $res['main'][4]['text_uz'][0] = 'Алексей Народицкий';




        $res['main'][5]['title_ru'] = 'Тексты исследования:';
        $res['main'][5]['text_ru'][0] = 'Борис Чухович';

        $res['main'][5]['title_en'] = 'Тексты исследования:';
        $res['main'][5]['text_en'][0] = 'Борис Чухович';

        $res['main'][5]['title_uz'] = 'Тексты исследования:';
        $res['main'][5]['text_uz'][0] = 'Борис Чухович';




        $res['main'][6]['title_ru'] = 'Редактура текстов:';
        $res['main'][6]['text_ru'][0] = 'Тимур Золотоев';

        $res['main'][6]['title_en'] = 'Редактура текстов:';
        $res['main'][6]['text_en'][0] = 'Тимур Золотоев';

        $res['main'][6]['title_uz'] = 'Редактура текстов:';
        $res['main'][6]['text_uz'][0] = 'Тимур Золотоев';



        
        $res['main'][7]['title_ru'] = 'Управление проектом:';
        $res['main'][7]['text_ru'][0] = 'Бабур Маматхаджаев';
        $res['main'][7]['text_ru'][1] = 'Лазиза Акбарова';
        $res['main'][7]['text_ru'][2] = 'Данила Борисенко';

        $res['main'][7]['title_en'] = 'Управление проектом:';
        $res['main'][7]['text_en'][0] = 'Бабур Маматхаджаев';
        $res['main'][7]['text_en'][1] = 'Лазиза Акбарова';
        $res['main'][7]['text_en'][2] = 'Данила Борисенко';

        $res['main'][7]['title_uz'] = 'Управление проектом:';
        $res['main'][7]['text_uz'][0] = 'Бабур Маматхаджаев';
        $res['main'][7]['text_uz'][1] = 'Лазиза Акбарова';
        $res['main'][7]['text_uz'][2] = 'Данила Борисенко';




        $res['main'][8]['title_ru'] = 'Группа переводчиков:';
        $res['main'][8]['text_ru'][0] = 'Нариман Ахатов, Орифжон Назаров,';
        $res['main'][8]['text_ru'][1] = 'Забихулла Саипов (узбекский язык),';
        $res['main'][8]['text_ru'][2] = 'Тимур Золотоев (английский язык)';

        $res['main'][8]['title_en'] = 'Группа переводчиков:';
        $res['main'][8]['text_en'][0] = 'Нариман Ахатов, Орифжон Назаров,';
        $res['main'][8]['text_en'][1] = 'Забихулла Саипов (узбекский язык),';
        $res['main'][8]['text_en'][2] = 'Тимур Золотоев (английский язык)';

        $res['main'][8]['title_uz'] = 'Группа переводчиков:';
        $res['main'][8]['text_uz'][0] = 'Нариман Ахатов, Орифжон Назаров,';
        $res['main'][8]['text_uz'][1] = 'Забихулла Саипов (узбекский язык),';
        $res['main'][8]['text_uz'][2] = 'Тимур Золотоев (английский язык)';




        $res['bottom']['text1_ru'] = 'В приложении использованы архивные фотографии с сайта pastvu.com';
        $res['bottom']['text1_en'] = 'В приложении использованы архивные фотографии с сайта pastvu.com';
        $res['bottom']['text1_uz'] = 'В приложении использованы архивные фотографии с сайта pastvu.com';

        $res['bottom']['text2_ru'] = 'Для написания некоторых текстов были адаптированы материалы, подготовленного международной Обсерваторией Alerte Héritage для проекта «Архитектура Узбекистана: черная и красная книга»';
        $res['bottom']['text2_en'] = 'Для написания некоторых текстов были адаптированы материалы, подготовленного международной Обсерваторией Alerte Héritage для проекта «Архитектура Узбекистана: черная и красная книга»';
        $res['bottom']['text2_uz'] = 'Для написания некоторых текстов были адаптированы материалы, подготовленного международной Обсерваторией Alerte Héritage для проекта «Архитектура Узбекистана: черная и красная книга»';      
                    

        $mainres["status"] = true;
        $mainres["result"] = $res;
        $mainres["message"] = "OK";

        return $mainres;


    }

}