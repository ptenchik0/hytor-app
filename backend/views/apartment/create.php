<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Apartment */

$this->title = 'Додати Хатину';
$this->params['breadcrumbs'][] = ['label' => 'Хатини', 'url' => ['index'], 'class' => 'text-secondary'];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>


