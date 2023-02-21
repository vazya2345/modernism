<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RouteObject $model */

$this->title = 'Create Route Object';
$this->params['breadcrumbs'][] = ['label' => 'Route Objects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-object-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
