<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelOrder common\models\FoodOrder */
/* @var $modelsType common\models\FoodOrderType */

$this->title = 'Створити замовлення';
$this->params['breadcrumbs'][] = ['label' => 'Замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-order-create">

    <?= $this->render('_form', [
        'dishes' => $dishes,
        'sets' => $sets,
        'modelOrder' => $modelOrder,
        'modelsType' => $modelsType,
        'modelsItem' => $modelsItem,
    ]) ?>

</div>
