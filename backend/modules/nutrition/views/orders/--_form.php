<?php

use common\models\Food;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FoodOrder */
/* @var $form yii\widgets\ActiveForm */
/* @var $apartments \common\models\Apartment */
/* @var $dishes common\models\Food */
?>

<div class="food-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-xl-9 col-md-8">

            <?php
            $food = ArrayHelper::map(Food::find()->asArray()->all(), 'id', 'title');
            $order_type = ArrayHelper::index($model->foodOrderTypesWithItems, 'order_type');
            ?>

            <?php foreach (\common\models\FoodSet::rationType() as $key => $val): ?>
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?/*= ArrayHelper::getValue(\common\models\FoodSet::rationType(), $model->foodOrderTypesWithItems->order_type); */?>
                            <?= $val; ?>
                        </h3>

                        <div class="card-tools">
                            <?php if(array_key_exists($key, $order_type)): ?>
                                <span title="Час подання" class="badge bg-success">
                                    <?= Yii::$app->formatter->asDatetime($model->foodOrderTypesWithItems[$key]->serve_at, 'php:H:s d.m.Y'); ?>
                                </span>
                            <? endif; ?>

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                <i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(array_key_exists($key, $order_type)) : ?>

                            <?php foreach ($model->foodOrderTypesWithItems[$key]->foodOrderTypeItems as $dd): ?>
                            <?= $form->field($dd, "[{$dd->food_order_item_id}]quantity")->textInput(); ?>
                            <?php endforeach; ?>

                            <?php foreach ($model->foodOrderTypesWithItems as $key => $type): ?>

                                <?php /*foreach ($type->foodOrderTypeItems as $_key => $dish): */?><!--

                                    <?/*= $form->field($dish, 'quantity')->textInput([
                                     'id' => "foodOrderTypeItems{$dish->food_id}_quantity",
                                     'name' => "foodOrderTypeItems[$dish->food_id][quantity]",
                                 ])->label($food[$dish->food_id]) */?>

                                --><?php /*endforeach; */?>

                                <?/*= $form->field($dish, 'quantity')->textInput([
                                     'id' => "foodOrderTypeItems{$dish->food_id}_quantity",
                                     'name' => "foodOrderTypeItems[$dish->food_id][quantity]",
                                 ])->label($food[$dish->food_id]) */?>


                            <?php endforeach; ?>
                        <?php else: ?>

                        <?php endif; ?>

                        <?php
                        //$value = ArrayHelper::getValue($model->foodOrderTypesWithItems, 'order_type');


                        $type = ArrayHelper::map($dishes, 'id', function (){ return array('disabled'=>true); }, 'status');

                        ?>


                        <?/*= $form->field($model, 'dish_ids')->widget(Select2::class, [
                            'data' => ArrayHelper::map($dishes, 'id', 'title'),
                            'options' => [
                                'placeholder' => 'Оберіть страви',
                                'options' => ArrayHelper::remove($type, Food::STATUS_DRAFT),
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => true,
                                'tags' => true,
                            ],
                        ]);
                        */?>
                    </div>
                </div>
            <? endforeach; ?>

        </div>
        <div class="col-xl-3 col-md-4">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Налаштування</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-block btn-success text-uppercase mb-3']) ?>
                    </div>

                    <?= $form->field($model, 'apartment_id')->dropDownList($apartments, ['prompt'=>'- Оберіть садибу -']) ?>

                    <?= $form->field($model, 'customer_id')->textInput()->label() ?>

                    <?= $form->field($model, 'created_at')->textInput() ?>

                    <?= $form->field($model, 'updated_at')->textInput() ?>

                    <?= $form->field($model, 'status')->dropDownList(\common\models\FoodOrder::statuses()) ?>

                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
