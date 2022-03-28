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

$js = <<< JS
    function sendRequest(status, id){
        //console.log(status ? 1 : 0);
        $.ajax({
            url:'/controller/action',
            method:'post',
            data:{status:status,id:id},
            success:function(data){
                alert(data);
            },
            error:function(jqXhr,status,error){
                //$('tr#orderId'+id).fadeOut();
                console.log('#orderId'+id);
                console.log(jqXhr);
                console.log(status);
                console.log(error);
                //alert(error);
            }
        });
    }
JS;

$this->registerJs($js, \yii\web\View::POS_READY);

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
        <div class="card-body pt-0 pr-0 pb-0 pl-0">

            <?php //Pjax::begin(); ?>
            <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'rowOptions'=>function ($model, $key, $index, $grid){
                    $class=$index%2?'odd':'even';
                    return [
                        'key'=>$key,
                        'index'=>$index,
                        'id'=>'orderId'.$key,
                        'class'=>$class
                    ];
                },
                'showPageSummary' => true,
                'striped' => true,
                'hover' => true,
                'condensed' => true,
                'placeFooterAfterBody' => true,
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
                    [
                        'attribute' => 'id',
                        'label' => 'lll',
                        'options' => ['class'=>'text-center','style'=>'width:1%'],
                        'contentOptions' => ['class' => 'text-center'],     // настройка HTML атрибутов для тега, соответсвующего value
                        //'captionOptions' => ['tooltip' => 'Tooltip'],  // настройка HTML атрибутов для тега, соответсвующего label
                    ],
                    'apartment.name',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return \kartik\switchinput\SwitchInput::widget([
                                'name' => 'status',
                                'tristate' => true,
                                'indeterminateValue' => \common\models\FoodOrder::STATUS_DRAFT,
                                'indeterminateToggle' => false,
                                'containerOptions' => ['class'=>'mb-0'],
                                'pluginEvents' => [
                                    'switchChange.bootstrapSwitch' => "function(e, state){sendRequest(e.currentTarget.checked ? 1 : 0, $model->id); console.log(state); /*$(this).closest('tr').fadeOut();*/}",
                                    'switchReset.bootstrapSwitch' => "function(e, state){console.log(state); /*$(this).closest('tr').fadeOut();*/}"
                                ],
                                'value' => $model->status,
                                'pluginOptions' => [
                                    'labelText'=>'<i class="fas fa-archive"></i>',
                                    'size' => 'mini',
                                    'onColor' => 'info',
                                    'indeterminateColor' => 'success',
                                    'onText' => ArrayHelper::getValue(\common\models\FoodOrder::statuses(),\common\models\FoodOrder::STATUS_PUBLISHED),
                                    'offText' => 'off',
                                ],
                            ]);
                        }
                    ],
                    [
                        'class' => \common\widgets\KartikActionGroupColumn::class,
                        //'group' => true,
                        //'subGroupOf' => 1,
                        'noWrap' => true,
                        'mergeHeader' => false,
                        'template'=>'<div class="btn-group">{update}{delete}</div>',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'filterOptions' => ['class' => 'text-center'],
                        'filterContent' => Html::a(\rmrevin\yii\fontawesome\FAS::icon('filter'), ['/nutrition/orders'], ['class'=>'btn btn-block btn-default', 'data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Скинути фільтр']),
                        /*'urlCreator' => function ($action, $model, $key, $index) {
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

                        },*/
                        'viewOptions' => ['label' => '<i class="fa-fw fas fa-eye"></i>', 'class' => 'btn btn-info btn-xs'],
                        'updateOptions' => ['label' => '<i class="fa-fw fas fa-edit"></i>', 'class' => 'btn btn-warning btn-xs'],
                        'deleteOptions' => ['label' => '<i class="fa-fw fas fa-trash"></i>', 'class' => 'btn btn-danger btn-xs']
                    ],
                ],
            ]);
            ?>

            <?php //Pjax::end(); ?>

        </div>
    </div>

</div>
