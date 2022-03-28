<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Apartment */

$this->title = 'Редагування: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Хатини', 'url' => ['index'], 'class' => 'text-secondary'];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id], 'class' => 'text-secondary'];
$this->params['breadcrumbs'][] = 'Редагування';
?>
<div class="apartment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
