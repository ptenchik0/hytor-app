<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FoodSet */
/* @var $dishes common\models\Food */

$this->title = 'Редагувати: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Сети', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагування';
?>
<div class="food-set-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dishes' => $dishes,
        'dished_d' => $dished_d
    ]) ?>

</div>
