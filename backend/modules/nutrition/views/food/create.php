<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Food */

$this->title = 'Додати страву';
$this->params['breadcrumbs'][] = ['label' => 'Страви', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
