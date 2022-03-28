<?php

use common\widgets\EnumColumn;
use common\models\Food;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var yii\web\View $this */
/* @var backend\modules\nutrition\models\search\FoodSearch $searchModel */
/* @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Страви';
$this->params['breadcrumbs'][] = ['label' => 'Харчування', 'url' => ['index'], 'class' => 'text-secondary'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-index">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><span class="sr-only"><?= Html::encode($this->title) ?></span> <?= Html::a('Додати страву', ['create'], ['class' => 'btn btn-success']) ?> </h3>


            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">

            <?php Pjax::begin(); ?>
            <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                //'layout' => "{items}\n{pager}",
                'options' => [
                    'class' => ['gridview', 'table-responsive'],
                ],
                'tableOptions' => [
                    'class' => ['table', 'table-striped', 'table-hover', 'mb-0'],
                ],
                'summaryOptions' => ['class' => 'summary p-3'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'title',
                    //'description:ntext',
                    'price',
                    'outlet_amount',
                    [
                        'class' => EnumColumn::class,
                        'attribute' => 'outlet',
                        'options' => ['style' => 'width: 10%'],
                        'enum' => Food::outletTypes(),
                        'filter' => Food::outletTypes(),
                    ],
                    //'outlet_amount',

                    [
                        'class' => EnumColumn::class,
                        'attribute' => 'dish_type',
                        'options' => ['style' => 'width: 10%'],
                        'enum' => Food::dishItemTypes(),
                        'filter' => Food::dishItemTypes(),
                    ],
                    //'sort_order',
                    /*[
                        'class' => EnumColumn::class,
                        'attribute' => 'type',
                        'options' => ['style' => 'width: 10%'],
                        'enum' => Food::rationTypes(),
                        'filter' => Food::rationTypes(),
                    ],*/
                    [
                        'class' => EnumColumn::class,
                        'attribute' => 'status',
                        'dataDisplayTyle' => 'icon',
                        'options' => ['style' => 'width: 10%'],
                        'contentOptions' => ['class' => 'text-center'],
                        'enum' => Food::statuses(),
                        'filter' => Food::statuses(),
                    ],
                    [
                        'class' => \common\widgets\ActionColumn::class,
                        'options' => ['style' => 'width: 140px'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'filterOptions' => ['class' => 'text-center'],
                        'filterContent' => Html::a(\rmrevin\yii\fontawesome\FAS::icon('filter'), ['/nutrition/food'], ['class'=>'btn btn-block btn-default', 'data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Скинути фільтр']),
                        //'header' => Html::a(\rmrevin\yii\fontawesome\FAS::icon('filter'), ['index'], ['class'=>'btn btn-xs btn-block btn-default py-0', 'data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Скинути фільтр'])
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>

</div>