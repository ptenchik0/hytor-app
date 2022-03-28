<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Food */

$this->title = 'Редагувати: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Страви', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагування';
?>
<div class="food-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
