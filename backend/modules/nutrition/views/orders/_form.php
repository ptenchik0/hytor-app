<?php

use common\models\Apartment;
use common\models\Food;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $modelOrder common\models\FoodOrder */
/* @var $form yii\widgets\ActiveForm */
/* @var $apartments \common\models\Apartment */
/* @var $dishes common\models\Food */
?>

<?php $js = '
$(document).on("click", ".add-layer", function(){
$(this).closest(".card").find(".add-room").click();
$(this).closest(".card.collapsed-card").find(".addcollapse").click();
});
';
$this->registerJs($js);
?>

<div class="food-order-form">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-xl-9 col-md-8">
            <?php //$order_type = ArrayHelper::index($modelsType, 'order_type'); //foreach (\common\models\FoodSet::rationType() as $key => $val): ?>


            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',
                'widgetBody' => '.type-body-items',
                'widgetItem' => '.type-item',
                'limit' => 10,
                'min' => 1,
                'insertButton' => '.add-house',
                'deleteButton' => '.remove-house',
                'model' => $modelsType[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'order_type',
                ],
            ]); ?>
            <!--<div class="type-body-items">-->
                <?php //$c = ArrayHelper::toArray(ArrayHelper::index($modelsType, 'order_type')); ?>

                <?php foreach (\common\models\FoodSet::rationType() as $indexType => $modelNme): ?>
                    <div class="card card-outline card-success type-item <?= empty($modelsType[$indexType]->foodOrderTypeItems) ? 'collapsed-card' : ''; ?>" data-order-type="<?= $modelsType[$indexType]->order_type ?>">
                        <div class="card-header">
                            <h3 class="card-title">
                                <?= ArrayHelper::getValue(\common\models\FoodSet::rationType(), $modelsType[$indexType]->order_type); ?>
                            </h3>

                            <?php if (! $modelsType[$indexType]->isNewRecord) { echo Html::activeHiddenInput($modelsType[$indexType], "[{$indexType}]id"); } ?>
                            <?= $form->field($modelsType[$indexType], "[{$indexType}]order_type", ['options' => ['tag' => false,]])->label(false)->hiddenInput(); ?>

                            <div class="card-tools">

                                <?php
                                echo $form->field($modelsType[$indexType], "[{$indexType}]serve_at", ['options' => [ 'class'=>'d-inline-block'] ])->widget(\kartik\datetime\DateTimePicker::className(), [
                                    //'name' => 'dp_5',
                                    'type' => \kartik\datetime\DateTimePicker::TYPE_BUTTON,
                                    'layout' => '{input} {picker}',
                                    //'convertFormat' => true,
                                    'options' => [
                                        'type' => 'text',
                                        'readonly' => true,
                                        'class' => 'text-muted small text-right',
                                        'style' => 'border:none;background:none',
                                        //'value' => Yii::$app->formatter->asDatetime($modelsType[$indexType]->serve_at, 'Y-m-d H:i'),
                                    ],
                                    'pickerButton' => ['class'=>'btn btn-tool'],
                                    'pluginOptions' => [
                                        'format' => 'dd/mm/yyyy hh:ii',
                                        'startDate' => date("Y-m-d"),
                                        'autoclose' => true
                                    ],
                                    'pluginEvents' => [
                                        //"show" => "function(e) {   console.log(e); }",
                                        //"hide" => "function(e) {   `e` here contains the extra attributes }",
                                        "changeDate" => "function(e) {
                                            let d = e.date;                                            
                                            console.log(e.date.valueOf()); 
                                            
                                            //var datestring = (\"0\" + d.getDate()).slice(-2) + \"-\" + (\"0\"+(d.getMonth()+1)).slice(-2) + \"-\" +
                                            //d.getFullYear() + \" \" + (\"0\" + d.getHours()).slice(-2) + \":\" + (\"0\" + d.getMinutes()).slice(-2);

                                            
                                            console.log( (\"0\" + d.getHours()).slice(-2) + \":\" + (\"0\" + d.getMinutes()).slice(-2) ); 
                                            //console.log(e); 
                                        }",
                                        //"changeYear" => "function(e) {   `e` here contains the extra attributes }",
                                        //"changeMonth" => "function(e) {   `e` here contains the extra attributes }",
                                    ]
                                ])->label(false);
                                ?>

                                <button type="button" class="add-layer btn btn-sm btn-success" title="Додати страву"><span class="fas fa-utensils"></span></button>
                                <span class="btn btn-tool mr-2 pl-0 border-right">&nbsp;</span>
                                <button type="button" class="btn btn-tool addcollapse" data-card-widget="collapse" title="Collapse">
                                    <i class="fas <?= empty($modelsType[$indexType]->foodOrderTypeItems) ? 'fa-plus' : 'fa-minus'; ?>"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="<?= empty($modelsType[$indexType]->foodOrderTypeItems) ? 'display:none;' : ''; ?>">
                            <div  class="house-item">
                                <?php
                                 ?>
                                <?= $this->render('_form-rooms', [
                                    'form' => $form,
                                    'indexType' => $indexType,
                                    'modelsItem' => $modelsItem[$indexType],
                                    'dishes' => $dishes,
                                    //'foods' => $sets[$indexType]->foods,
                                ]) ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            <!--</div>-->

            <?php DynamicFormWidget::end(); ?>
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

                    <?= $form->field($modelOrder, 'status')->dropDownList(\common\models\FoodOrder::statuses()) ?>

                    <div class="form-group">
                        <?= Html::submitButton($modelOrder->isNewRecord ? 'Створити' : 'Оновити', ['class' => 'btn btn-block btn-success text-uppercase mb-3']) ?>
                    </div>

                    <?php if ($modelOrder->isNewRecord) : ?>

                        <?= $form->field($modelOrder, 'apartment_id')->dropDownList(ArrayHelper::map(Apartment::findAll(['status' => Apartment::STATUS_PUBLISHED]), 'id', 'name'), ['prompt'=>'- Оберіть садибу -']) ?>

                        <?/*= $form->field($modelOrder, 'customer_id')->textInput()->label() */?>
                        <?php
                        $url = \yii\helpers\Url::to(['customer-list']);

                        $dataList = \common\models\Customer::find()->andWhere(['id' => $modelOrder->customer_id])->all();
                        $data = ArrayHelper::map($dataList, 'id', 'fio');

                        echo $form->field($modelOrder, 'customer_id')->widget(Select2::classname(), [
                            'data' => $data,
                            'options' => ['multiple'=>false, 'placeholder' => 'Search for a city ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 3,
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                ],
                                'ajax' => [
                                    'url' => $url,
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(city) { return city.text; }'),
                                'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                            ],
                        ]);
                        ?>

                        <?= $form->field($modelOrder, 'created_at')->textInput() ?>

                        <?= $form->field($modelOrder, 'updated_at')->textInput() ?>
                    <?php else: ?>
                    <dl>
                        <dt><?= $modelOrder->getAttributeLabel('apartment_id');  ?>:</dt>
                        <dd><?= ArrayHelper::getValue(Apartment::findOne(['id' => $modelOrder->apartment_id]), 'name') ?></dd>
                        <dt><?= $modelOrder->getAttributeLabel('customer_id');  ?>:</dt>
                        <dd>
                            <?php $customer = \common\models\Customer::findOne(['id' => $modelOrder->customer_id]); ?>
                            <?php if (!empty($customer->fio)): ?><?= ArrayHelper::getValue( $customer, 'fio') ?> <?php endif; ?>
                            <span class="d-block"><i class="fas fa-phone" style="font-size: .75rem"></i> <?= ArrayHelper::getValue( $customer, 'phone') ?></span>
                            <?php if (!empty($customer->email)): ?><span class="d-block"><i class="fas fa-envelope" style="font-size: .75rem"></i> <?= ArrayHelper::getValue( $customer, 'email') ?></span> <?php endif; ?>
                        </dd>
                    </dl>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs('
$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
    console.log(item);
});
');