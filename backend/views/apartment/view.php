<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Apartment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Хатини', 'url' => ['index'], 'class' => 'text-secondary'];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<!-- Default box -->
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
                //'id',
                'name',
                //'image:ntext',
                [
                    'attribute' => 'price',
                    'format' => 'raw',
                    'value' => function($model){
                        $item = '';
                        foreach ($model->myPrice as $key => $val){
                            if (!empty($val)):
                                $day = str_replace ('days', '', $key);
                                if (!next($model->myPrice)) $item .= '<h1>aaaaa</h1>';
                                $item .= '<li class="text-md-center"><span class="">за ' . Yii::$app->i18n->messageFormatter->format('{delta, plural, one{<strong>#</strong> день:} few{<strong>#</strong> дні:} many{<strong>#</strong> днів:} other{<strong>#</strong> дні:}}', ['delta' => $day], \Yii::$app->language) . '</span> <span class="badge badge-primary">' . $val . ' грн</span></li>';
                            endif;
                        }
                        return '<ul class="list-unstyled d-md-flex justify-content-between m-0">' . $item . '</ul>';
                    }
                ],
                //'price:ntext',
                'display_order',
                [
                    'attribute' => 'status',
                    'value' => function($model){
                        return \yii\helpers\ArrayHelper::getValue(\common\models\Apartment::statuses(), $model->status);
                    }
                ],
                'description:ntext',
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
