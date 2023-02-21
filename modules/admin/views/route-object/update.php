<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RouteObject $model */

$this->title = 'Update Route Object: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Route Objects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="route-object-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
