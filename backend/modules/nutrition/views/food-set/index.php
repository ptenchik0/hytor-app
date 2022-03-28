<?php

use common\models\Food;
use common\widgets\EnumColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FoodSetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сети';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-set-index">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><span class="sr-only"><?= Html::encode($this->title) ?></span> <?= Html::a('Додати сет', ['create'], ['class' => 'btn btn-success']) ?> </h3>


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
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
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
                    [
                        'attribute' => 'dish_ids',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $column) {
                            $result = \yii\helpers\ArrayHelper::getColumn($model->foods, function ($element) {
                                return $element['title'];
                            });
                            $str = '';
                            $dd = ArrayHelper::toArray($model->foods, [
                                'common\models\Food' => [
                                    'id',
                                    'title',
                                    // ключ в результирующем массиве => имя свойства
                                    //'createTime' => 'created_at',
                                    // ключ в результирующем массиве => анонимная функция
                                    'status' => function ($post) {
                                        return $post->status == 0 ? 'danger' : 'success';
                                    },
                                ],
                            ]);
                            if (!empty($dd)){
                                foreach ($dd as $key){
                                    $str .= '<span class="bg-'.$key['status'].' rounded mr-2 px-2 py-1">' . $key['title'] . '</span>';
                                }
                            }
                            return !empty($str) ? $str : 'sssss';

                            //return !empty($result) ? "<span class='bg-success rounded mr-2 px-2 py-1'>".implode('</span><span class=\'bg-success rounded px-2 py-1\'>', $result) . "</span>" : 'Страв нема';
                            //return "<span class='bg-success rounded mr-2 px-2 py-1'>".implode('</span><span class=\'bg-success rounded px-2 py-1\'>', $result) . "</span>";
                        },
                        'filter' => ArrayHelper::map(Food::find()->active()->asArray()->all(), 'id', 'title')
                        /*'value' => function($model){
                            return '';
                        }*/
                        //'value' => function($model){
                            /*$vv = $value->foods;
                            $vv2 = \yii\helpers\ArrayHelper::map($value->foods, 'id', 'title');
                            $result = \yii\helpers\ArrayHelper::getColumn($vv, function ($element) {
                                return $element['id'];
                            });*/

                            //return '';//\yii\helpers\ArrayHelper::map(, 'title', 'title');
                        //}
                    ],
                    [
                        'class' => EnumColumn::class,
                        'attribute' => 'type',
                        'options' => ['style' => 'width: 10%'],
                        //'contentOptions' => ['class' => 'text-center'],
                        'enum' => \common\models\FoodSet::rationType(),
                        'filter' => \common\models\FoodSet::rationType(),
                    ],
                    [
                        'class' => EnumColumn::class,
                        'attribute' => 'status',
                        'dataDisplayTyle' => 'icon',
                        'options' => ['style' => 'width: 10%'],
                        'contentOptions' => ['class' => 'text-center'],
                        'enum' => \common\models\FoodSet::statuses(),
                        'filter' => \common\models\FoodSet::statuses(),
                    ],
                    [
                        'class' => \common\widgets\ActionColumn::class,
                        'options' => ['style' => 'width: 140px'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'filterOptions' => ['class' => 'text-center'],
                        'filterContent' => Html::a(\rmrevin\yii\fontawesome\FAS::icon('filter'), ['/nutrition/food-set'], ['class'=>'btn btn-block btn-default', 'data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Скинути фільтр']),
                        //'header' => Html::a(\rmrevin\yii\fontawesome\FAS::icon('filter'), ['index'], ['class'=>'btn btn-xs btn-block btn-default py-0', 'data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Скинути фільтр'])
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>

</div>
