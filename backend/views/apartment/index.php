<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ApartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Хатини';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><span class="sr-only"><?= Html::encode($this->title) ?></span> <?= Html::a('Додати хатину', ['create'], ['class' => 'btn btn-sm btn-success']) ?> </h3>


        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <!--<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>-->
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
            //'filterModel' => $searchModel,
            'layout' => "{items}\n{pager}",
            'options' => [
                'class' => ['gridview', 'table-responsive'],
            ],
            'tableOptions' => [
                'class' => ['table', 'table-striped', 'table-hover', 'mb-0'],
            ],
            'summaryOptions' => ['class' => 'summary p-3'],
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'options' => ['style' => 'width: 1%'],
                ],

                //'id',
                'name',
                //'description:ntext',
                //'image:ntext',
                //'price:ntext',
                [
                    'attribute' => 'display_order',
                    'options' => ['style' => 'width: 5%'],
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'status',
                    'label' => 'Статус',
                    'options' => ['style' => 'width: 5%'],
                    'contentOptions' => ['class' => 'text-center'],
                    'format' => 'raw',
                    //'filter' => ['Неактивна', 'Активна'],
                    'value' => function($model){
                        return $model->status !== 0 ? '<span class="badge badge-success"><i class="fas fa-check"></i></span> ' : '<span class="badge badge-danger"><i class="fas fa-times"></i></span> ';
                    }
                ],
                [
                    'class' => \common\widgets\ActionColumn::class,
                    'options' => ['style' => 'width: 140px'],
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center'],
                    'filterOptions' => ['class' => 'text-center'],
                    'filterContent' => Html::a(\rmrevin\yii\fontawesome\FAS::icon('filter'), ['index'], ['class'=>'btn btn-block btn-default', 'data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Скинути фільтр']),
                    'header' => Html::a(\rmrevin\yii\fontawesome\FAS::icon('filter'), ['index'], ['class'=>'btn btn-xs btn-block btn-default py-0', 'data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Скинути фільтр'])
                ],
            ],

        ]); ?>

        <?php Pjax::end(); ?>
    </div>
    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>