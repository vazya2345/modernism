<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Main;
/** @var yii\web\View $this */
/** @var app\models\Photo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="photo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'main_id')->dropDownList(Main::getAll()) ?>
    <br>
    <?= $form->field($model, 'imageFile[]')->fileInput(['multiple' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo_date')->textInput(['type'=>'date']) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
