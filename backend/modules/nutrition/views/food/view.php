<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Food */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Страви', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="food-view">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><span class="sr-only"><?= Html::encode($this->title) ?></span></h3>


            <div class="card-tools">

                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'description:ntext',
                    'price',
                    'outlet_amount',
                    [
                        'attribute' => 'outlet',
                        'value' => function($model){
                            return \yii\helpers\ArrayHelper::getValue(\common\models\Food::outletTypes(), $model->outlet);
                        }
                    ],
                    [
                        'attribute' => 'dish_type',
                        'value' => function($model){
                            return \yii\helpers\ArrayHelper::getValue(\common\models\Food::dishItemTypes(), $model->dish_type);
                        }
                    ],
                    [
                        'attribute' => 'type',
                        'value' => function($model){
                            return \yii\helpers\ArrayHelper::getValue(\common\models\Food::rationTypes(), $model->type);
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function($model){
                            return \yii\helpers\ArrayHelper::getValue(\common\models\Food::statuses(), $model->status);
                        }
                    ],
                    'sort_order',
                ],
            ]) ?>
        </div>
        <div class="card-footer">
            <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger float-right',
                'data' => [
                    'confirm' => 'Ви дійсно бажаєте видалити цю хатину?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>

</div>
