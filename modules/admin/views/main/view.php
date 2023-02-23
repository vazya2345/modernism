<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Main $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Modernism objects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="main-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'title_ru',
            'title_en',
            'photo_url' => [
                'attribute' => 'photo_url',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->photo_url != ""){
                        return Html::a('Открыть', '/web/uploads/'.$model->photo_url, ['target'=>'_blank']);
                    }
                    else{
                        return '';
                    }
                },
            ],
            'desc:ntext',
            'desc_ru:ntext',
            'desc_en:ntext',
            'arcitector_id',
            'address:ntext',
            'address_ru:ntext',
            'address_en:ntext',
            'geolocation',
            'video_presentation_url:url' => [
                'attribute' => 'video_presentation_url',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->video_presentation_url != ""){
                        return Html::a('Открыть', '/web/uploads/'.$model->video_presentation_url, ['target'=>'_blank']);
                    }
                    else{
                        return '';
                    }
                },
            ],
            'threed_model_url:url' => [
                'attribute' => 'threed_model_url',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->threed_model_url != ""){
                        return Html::a('Открыть', '/web/uploads/'.$model->threed_model_url, ['target'=>'_blank']);
                    }
                    else{
                        return '';
                    }
                },
            ],
            'build_period',
        ],
    ]) ?>

</div>
