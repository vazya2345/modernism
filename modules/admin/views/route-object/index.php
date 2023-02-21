<?php

use app\models\RouteObject;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Route;
use app\models\Main;
/** @var yii\web\View $this */
/** @var app\models\RouteObjectSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Route Objects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-object-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Route Object', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'route_id' => [
                'attribute' => 'route_id',
                'value' => function ($data) {
                    return Route::getName($data->route_id);
                },
            ],
            'main_id' => [
                'attribute' => 'main_id',
                'value' => function ($data) {
                    return Main::getName($data->main_id);
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RouteObject $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
