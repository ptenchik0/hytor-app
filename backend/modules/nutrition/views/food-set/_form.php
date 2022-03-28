<?php

use common\models\Food;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FoodSet */
/* @var $form yii\widgets\ActiveForm */
/* @var $dishes common\models\Food */
?>

<div class="food-set-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-xl-9 col-md-8">

            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Інформація</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'type')->dropDownList(\common\models\FoodSet::rationType()) ?>
                        </div>

                        <div class="col-12">
                            <?php $ggg = ArrayHelper::getColumn($dishes, function ($element){
                                if($element['status'] == 0){
                                    return $element['status'];
                                }
                            });

                            $type = ArrayHelper::map($dishes, 'id', function (){ return array('disabled'=>true); }, 'status');

                            ?>


                            <?= $form->field($model, 'dish_ids')->widget(Select2::class, [
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
                            ?>
                        </div>
                        <div class="col">
                            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>
                </div>
            </div>
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

                    <?= $form->field($model, 'status')->dropDownList(\common\models\FoodSet::statuses()) ?>
                </div>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
