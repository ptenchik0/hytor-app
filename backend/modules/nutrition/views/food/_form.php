<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Food */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="food-form">

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
                        <div class="col-8">
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'autofocus' => 'autofocus']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'price')->input('number', ['step' => '0.05']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'outlet_amount')->textInput() ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'outlet')->dropDownList(\common\models\Food::outletTypes()) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'dish_type')->dropDownList(\common\models\Food::dishItemTypes()) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'type')->dropDownList(\common\models\Food::rationTypes()) ?>
                        </div>
                        <div class="col-12">
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

                    <?= $form->field($model, 'status')->dropDownList(\common\models\Food::statuses()) ?>


                    <?= $form->field($model, 'sort_order')->textInput() ?>
                </div>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
