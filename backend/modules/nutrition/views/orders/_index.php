<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\nutrition\models\search\FoodOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Замовлення';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="food-order-index">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><span class="sr-only"><?= Html::encode($this->title) ?></span> <?= Html::a('Створити замовлення', ['create'], ['class' => 'btn btn-success']) ?> </h3>


            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
        <div class="card-body pt-0 pr-0 pb-0 pl-0">1111

            <?php //Pjax::begin(); ?>
            <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                //'showPageSummary' => true,
                'striped' => true,
                'hover' => true,
                'condensed' => true,
                'pjax' => true,
                'pjaxSettings'=>[
                    'neverTimeout'=>true,
                    //'beforeGrid'=>'My fancy content before.',
                    //'afterGrid'=>'My fancy content after.',
                ],
                'tableOptions' => [
                    'class' => ['table', 'table-striped', 'table-hover', 'mb-0'],
                ],
                'summaryOptions' => ['class' => 'summary p-3'],
                'columns' => [

                    //'orderTypeWithOrder.orderWithApartment.food_order_id',
                    [
                        'attribute' => 'orderTypeWithOrder.orderWithApartment.food_order_id',
                        'value' => function ($model, $key, $index, $widget) {
                            return $model->orderTypeWithOrder->order_id;
                        },
                        //'width' => '1%',
                        'vAlign' => 'middle',
                        'hAlign' => 'center',
                        'group' => true,  // enable grouping,
                        //'subGroupOf' => 1 // supplier column index is the parent group
                        'groupHeader'=> [
                            'mergeColumns' =>     [
                                [0, 3],
                                [4, 6]
                            ],
                            //'content' => [5 =>GridView::F_SUM],
                            //'contentFormats' => [5 => ['format'=>'number', 'decimals'=>2, 'decPoint'=>'.', 'thousandSep'=>',']]
                        ],
                    ],
                    //'orderTypeWithOrder.orderWithApartment.apartment_id',
                    [
                        'attribute' => 'apartment_id',
                        'value' => function ($model, $key, $index, $widget) {
                            return '#' . $model->orderTypeWithOrder->order_id . ' ' . $model->orderTypeWithOrder->orderWithApartment->apartment->name;
                        },
                        'vAlign' => 'middle',
                        //'width' => '10%',
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(\common\models\Apartment::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Садиба'],
                        'group' => true,  // enable grouping,
                        //'groupedRow' => true,                    // move grouped column to a single grouped row
                        //'groupOddCssClass' => 'kv-grouped-row',  // configure odd group cell css class
                        //'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class

                    ],

                    //'orderTypeWithOrder.order_type',
                    [
                        'attribute' => 'order_type',
                        'value' => function ($model, $key, $index, $widget) {
                            return ArrayHelper::getValue(\common\models\FoodSet::rationType(), $model->orderTypeWithOrder->order_type);
                        },
                        'vAlign' => 'middle',
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \common\models\FoodOrderType::rationType(),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Трапеза'],
                        'group' => true,  // enable grouping
                        'subGroupOf' => 1, // supplier column index is the parent group

                    ],

                    //'orderTypeWithOrder.serve_at',
                    [
                        'attribute' => 'serve_at',
                        'value' => function ($model, $key, $index, $widget) {
                            $t = Yii::$app->formatter->asDatetime($model->orderTypeWithOrder->serve_at);
                            //return $model->orderTypeWithOrder->serve_at;
                            return $t;
                        },
                        'vAlign' => 'middle',
                        'group' => true,  // enable grouping
                        'subGroupOf' => 2, // supplier column index is the parent group
                    ],

                    'food.title',

                    //'quantity',
                    [
                        'attribute' => 'quantity',
                        'options' => ['style' => 'width: 5%'],
                        'filter' => false,
                        'pageSummary' => true
                    ],

                    //'order_id',

                    //+'orderType.order_type',

                    /*[
                        'attribute'=>'orderType.order_type',
                        'value' => function($model){
                            return $model->orderType->order_type;
                        }
                    ],*/

                    //orderTypeWithOrder.orderWithApartment.customer_id
                    [
                        'attribute' => 'customer_id',
                        'value' => function($model){
                            return ArrayHelper::getValue(\common\models\Customer::findOne($model->orderTypeWithOrder->orderWithApartment->customer_id), 'username');
                        },
                    ],
                    //[
                        //'class' => 'kartik\grid\EditableColumn',
                        //'attribute' => 'quantity',

                        /*'value' => function($model){
                            return ArrayHelper::getValue(\common\models\Customer::findOne($model->orderTypeWithOrder->orderWithApartment->customer_id), 'username');
                        },*/
                        /*'editableOptions' => [
                            'header' => 'Buy Amount',
                            'asPopover' => false,
                            'inputType' => \kartik\editable\Editable::INPUT_SWITCH,
                            'options' => [
                                //'pluginOptions' => ['min' => 0, 'max' => 5000, 'class'=>'form-control', 'placeholder'=>'Enter person name...']
                            ],
                            //'formOptions' => ['action' => ['/site/editbook']],
                        ],*/

                    //],
                    [
                        'attribute' => 'orderTypeWithOrder.status',
                        'format' => 'raw',
                        'value' => function($model, $key, $index, $widget){
                            return \kartik\switchinput\SwitchInput::widget(['name'=>'status_1', 'value'=>true]);
                        }
                    ],
                    /*[
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'food_id',
                        //'format' => 'raw',
                        'editableOptions'=> function ($model, $key, $index) {
                            return [
                                'header'=>'Name',
                                'size'=>'md',
                                'asPopover' => false,
                                'beforeInput' => function ($form, $widget) use ($model, $index) {
                                    echo '';
                                },
                                'afterInput' => function ($form, $widget) use ($model, $index) {
                                    echo $form->field($model, "food_id")->widget(\kartik\switchinput\SwitchInput::classname(), [
                                        'name'=>'status_1', 'value'=>true
                                    ]);
                                }
                            ];
                        }
                    ],*/

                    /*[
                        'class' => \common\widgets\ActionColumn::class,
                        'options' => ['style' => 'width: 140px'],
                        //'group' => true,
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'filterOptions' => ['class' => 'text-center'],
                        'filterContent' => Html::a(\rmrevin\yii\fontawesome\FAS::icon('filter'), ['/nutrition/orders'], ['class'=>'btn btn-block btn-default', 'data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Скинути фільтр']),
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                $url ='index.php?r=client-login/lead-view&id='.$model->orderTypeWithOrder->order_id;
                                return \yii\helpers\Url::to(['/nutrition/orders/'.$action, 'id' => $model->orderTypeWithOrder->order_id]);
                            }

                            if ($action === 'update') {
                                $url ='index.php?r=client-login/lead-update&id='.$model->orderTypeWithOrder->order_id;
                                return \yii\helpers\Url::to(['/nutrition/orders/'.$action, 'id' => $model->orderTypeWithOrder->order_id]);
                            }
                            if ($action === 'delete') {
                                $url ='index.php?r=client-login/lead-delete&id='.$model->orderTypeWithOrder->order_id;

                                return \yii\helpers\Url::to(['/nutrition/orders/'.$action, 'id' => $model->orderTypeWithOrder->order_id]);
                            }

                        }
                    ],*/
                    [
                        'class' => \common\widgets\KartikActionGroupColumn::class,
                        'group' => true,
                        'subGroupOf' => 1,
                        'noWrap' => true,
                        'mergeHeader' => false,
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'filterOptions' => ['class' => 'text-center'],
                        'filterContent' => Html::a(\rmrevin\yii\fontawesome\FAS::icon('filter'), ['/nutrition/orders'], ['class'=>'btn btn-block btn-default', 'data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Скинути фільтр']),
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                $url ='index.php?r=client-login/lead-view&id='.$model->orderTypeWithOrder->order_id;
                                return \yii\helpers\Url::to(['/nutrition/orders/'.$action, 'id' => $model->orderTypeWithOrder->order_id]);
                            }

                            if ($action === 'update') {
                                $url ='index.php?r=client-login/lead-update&id='.$model->orderTypeWithOrder->order_id;
                                return \yii\helpers\Url::to(['/nutrition/orders/'.$action, 'id' => $model->orderTypeWithOrder->order_id]);
                            }
                            if ($action === 'delete') {
                                $url ='index.php?r=client-login/lead-delete&id='.$model->orderTypeWithOrder->order_id;

                                return \yii\helpers\Url::to(['/nutrition/orders/'.$action, 'id' => $model->orderTypeWithOrder->order_id]);
                            }

                        },
                        'viewOptions' => ['label' => '<i class="fa-fw fas fa-eye"></i>', 'class' => 'btn btn-info btn-xs'],
                        'updateOptions' => ['label' => '<i class="fa-fw fas fa-edit"></i>', 'class' => 'btn btn-warning btn-xs'],
                        'deleteOptions' => ['label' => '<i class="fa-fw fas fa-trash"></i>', 'class' => 'btn btn-danger btn-xs']
                    ],

                ],
            ]);
            ?>
            <?/*= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax'=>true,
                'pjaxSettings'=>[
                    'neverTimeout'=>true,
                    //'beforeGrid'=>'My fancy content before.',
                    //'afterGrid'=>'My fancy content after.',
                ],
                'tableOptions' => [
                    'class' => ['table', 'table-striped', 'table-hover', 'mb-0'],
                ],
                'summaryOptions' => ['class' => 'summary p-3'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],


                    [
                        'attribute' => 'apartment_id',
                        'value' => function ($model, $key, $index, $widget) {
                            return $model->apartment->name;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(\common\models\Apartment::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Садиба'],
                        'group' => true,  // enable grouping,
                        //'groupedRow' => true,                    // move grouped column to a single grouped row
                        'groupOddCssClass' => 'kv-grouped-row',  // configure odd group cell css class
                        'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
                    ],
                    [
                        'attribute' => 'food_order_id',
                        'options' => ['style' => 'width: 5%'],
                    ],
                    [
                        'attribute' => 'order_type',
                        'value' => function ($model, $key, $index, $widget) {
                            $g = \yii\helpers\ArrayHelper::getColumn( $model->foodOrderTypes,'order_type');
                            $c = $model->getFoodOrderTypes();
                            return '1';//$model->foodOrderTypes->order_type;
                        },
                        'group' => true,  // enable grouping
                        'subGroupOf' => 1 // supplier column index is the parent group,
                    ],
                    [
                            'attribute' => 'foodOrderTypes.order_type',
                        'value' => function($model, $key, $index, $widget) {
                            return '';
                        },
                    ],

                    //'food_order_id',

                    //'customer_id',
//                    [
//                        'attribute' => 'customer_id',
//                        'value' => function($model){
//                            return $model->customer->username;
//                        }
//                    ],
                    //'customer.username',
                    //'apartment.name',
                    //'status',
                    //'created_at',
                    //'updated_at',

                    [
                        'class' => \common\widgets\ActionColumn::class,
                        'options' => ['style' => 'width: 140px'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'filterOptions' => ['class' => 'text-center'],
                        'filterContent' => Html::a(\rmrevin\yii\fontawesome\FAS::icon('filter'), ['/nutrition/food'], ['class'=>'btn btn-block btn-default', 'data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Скинути фільтр']),

                    ],
                ],
            ]); */?>

            <?php //Pjax::end(); ?>

        </div>
    </div>

</div>
