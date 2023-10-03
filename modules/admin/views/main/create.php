<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Main $model */

$this->title = 'Create Main';
$this->params['breadcrumbs'][] = ['label' => 'Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
