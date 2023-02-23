<?php

use app\models\Main;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MainSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Modernism objects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Main', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'title_ru',
            'title_en',
            // 'photo_url:url',
            //'desc:ntext',
            //'desc_ru:ntext',
            //'desc_en:ntext',
            //'arcitector_id',
            //'address:ntext',
            //'address_ru:ntext',
            //'address_en:ntext',
            //'geolocation',
            //'video_presentation_url:url',
            //'threed_model_url:url',
            //'build_period',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Main $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
