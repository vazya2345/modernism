<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SystemVariables $model */

$this->title = 'Create System Variables';
$this->params['breadcrumbs'][] = ['label' => 'System Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-variables-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
