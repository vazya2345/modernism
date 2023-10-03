<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Architector;

/** @var yii\web\View $this */
/** @var app\models\Main $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="main-form">
    

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="card">
    <div class="card-body">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'order_num')->textInput(['maxlength' => true]) ?>

        
    </div>
</div>
<div class="card">
    <div class="card-body">
        <?= $form->field($model, 'historical_title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'historical_title_ru')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'historical_title_en')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <?= $form->field($model, 'imageFile')->fileInput() ?>
        <?= $form->field($model, 'build_period')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'arcitector_id')->dropDownList(Architector::getAll()) ?>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'desc_ru')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'desc_en')->textarea(['rows' => 6]) ?>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <?= $form->field($model, 'main_text')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'main_text_ru')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'main_text_en')->textarea(['rows' => 6]) ?>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'address_ru')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'address_en')->textarea(['rows' => 6]) ?>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <?= $form->field($model, 'geolocation')->widget(alexantr\coordinates\CoordinatesInput::className(), ['yandexMaps' => true]) ?>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <?= $form->field($model, 'videoFile')->fileInput() ?>

        <?= $form->field($model, 'audioFile')->fileInput() ?>
        
        <?= $form->field($model, 'threedFile')->fileInput() ?>
    </div>
</div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


<style type="text/css">
    .card{
        margin: 10px;
    }
</style>