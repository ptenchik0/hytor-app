<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FoodSet */
/* @var $dishes common\models\Food */

$this->title = 'Створити сет';
$this->params['breadcrumbs'][] = ['label' => 'Сети', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-set-create">

    <?= $this->render('_form', [
        'model' => $model,
        'dishes' => $dishes,
    ]) ?>

</div>
