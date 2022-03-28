<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Apartment */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-xl-9 col-md-8">
        <!-- Default box -->
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Основна інформація</h3>


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
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                <?/*= $form->field($model, 'image')->fileInput() */?>
            </div>
        </div>

    </div>
    <div class="col-xl-3 col-md-4">

        <!-- Default box -->
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

                <?= $form->field($model, 'status')->dropDownList(\common\models\Apartment::statuses()) ?>

                <?= $form->field($model, 'display_order')->textInput() ?>
            </div>
        </div>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ціни на проживання</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <?= $form->field($model, 'price[days2]')->input('number', ['value'=> $model->isNewRecord ? '' : $model->myPrice->days2])->label('за 2 дні') ?>
                <?= $form->field($model, 'price[days5]')->input('number', ['value'=> $model->isNewRecord ? '' : $model->myPrice->days5])->label('за 5 днів') ?>
                <?= $form->field($model, 'price[days10]')->input('number', ['value'=> $model->isNewRecord ? '' : $model->myPrice->days10])->label('за 10 днів') ?>
                <?= $form->field($model, 'price[days15]')->input('number', ['value'=> $model->isNewRecord ? '' : $model->myPrice->days15])->label('за 15 днів') ?>

                <?/*= $form->field($model, 'price')->textarea(['rows' => 6]) */?>
            </div>
        </div>

    </div>
</div>
<div class="form-group">

</div>
<?php ActiveForm::end(); ?>




