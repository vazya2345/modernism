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

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
    <br>
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <br>
    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc_ru')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc_en')->textarea(['rows' => 6]) ?>
    <br>
    <?= $form->field($model, 'arcitector_id')->dropDownList(Architector::getAll()) ?>
    <br>
    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address_ru')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address_en')->textarea(['rows' => 6]) ?>
    <br>
    <?= $form->field($model, 'geolocation')->widget(alexantr\coordinates\CoordinatesInput::className(), ['yandexMaps' => true]) ?>
    <br>
    <?= $form->field($model, 'videoFile')->fileInput() ?>
    <br>
    <?= $form->field($model, 'threedFile')->fileInput() ?>
    <br>
    <?= $form->field($model, 'build_period')->textInput(['maxlength' => true]) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
