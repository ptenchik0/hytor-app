<?php

use common\models\Food;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $modelsItem common\models\FoodOrderTypeItem */
/* @var $dishes common\models\Food */
?>


<?php DynamicFormWidget::begin([
   'widgetContainer' => 'dynamicform_inner',
   'widgetBody' => '.container-rooms',
   'widgetItem' => '.room-item',
   'limit' => 4,
   'min' => 0,
   'insertButton' => '.add-room',
   'deleteButton' => '.remove-room',
    'insertPosition' => 'top',
   'model' => $modelsItem[0],
   'formId' => 'dynamic-form',
   'formFields' => [
       'food_id',
       'quantity'
   ],
]); ?>



    <table class="table table-bordered mb-0">
        <thead class="d-none">
        <tr>
            <th></th>
            <th class="text-center">
                <button type="button" class="add-room btn btn-success btn-xs"><span class="fas fa-plus"></span></button>
            </th>
        </tr>
        </thead>
        <tbody class="container-rooms">
        <?php foreach ($modelsItem as $indexItem => $modelItem): ?>
            <tr class="room-item">
                <td class="vcenter">
                    <?php
                    // necessary for update action.
                    if (! $modelItem->isNewRecord) {
                        echo Html::activeHiddenInput($modelItem, "[{$indexType}][{$indexItem}]id");
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-6">

                            <?= $form->field($modelItem, "[{$indexType}][{$indexItem}]food_id")->label(false)->dropDownList(ArrayHelper::map(ArrayHelper::toArray($dishes), 'id', 'title'), ['prompt'=>' - Оберіть страву - ']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($modelItem, "[{$indexType}][{$indexItem}]quantity")->label(false)->textInput(['maxlength' => true, 'placeholder' => $modelItem->getAttributeLabel('quantity')]) ?>
                        </div>
                    </div>
                </td>
                <td class="text-center vcenter" style="width: 85px; vertical-align: middle; padding: 0">
                    <button type="button" class="remove-room btn btn-danger btn-xs"><span class="fas fa-minus"></span></button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php DynamicFormWidget::end(); ?>