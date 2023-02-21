<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Route;
use app\models\Main;

/** @var yii\web\View $this */
/** @var app\models\RouteObject $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="route-object-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'route_id')->dropDownList(Route::getAll()) ?>

    <?= $form->field($model, 'main_id')->dropDownList(Main::getAll()) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
