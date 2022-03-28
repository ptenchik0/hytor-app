<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FoodOrder */
/* @var $apartments \common\models\Apartment */
/* @var $dishes common\models\Food */

$this->title = 'Редагувати: ' . $model->food_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->food_order_id, 'url' => ['view', 'id' => $model->food_order_id]];
$this->params['breadcrumbs'][] = 'Редагування';
?>
<div class="food-order-update">

    <?= $this->render('_form', [
        'model' => $model,
        'apartments' => $apartments,
        'dishes' => $dishes,
    ]) ?>

</div>
