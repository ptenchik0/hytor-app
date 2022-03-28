<?php

namespace common\widgets;

use yii\grid\DataColumn;
use yii\helpers\ArrayHelper;

/**
 * Class EnumColumn
 * [
 *      'class' => 'common\grid\EnumColumn',
 *      'attribute' => 'role',
 *      'enum' => User::getRoles()
 * ]
 * @package common\components\grid
 */
class EnumColumn extends DataColumn
{
    public $dataDisplayTyle = 'text';

    /**
     * @var array List of value => name pairs
     */
    public $enum = [];
    /**
     * @var bool
     */
    public $loadFilterDefaultValues = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->loadFilterDefaultValues && $this->filter === null) {
            $this->filter = $this->enum;
        }
        if ($this->dataDisplayTyle == 'icon') {
            $this->format = 'html';
        }
    }

    /**
     * @param mixed $model
     * @param mixed $key
     * @param int $index
     * @return mixed
     */
    public function getDataCellValue($model, $key, $index)
    {
        $value = parent::getDataCellValue($model, $key, $index);

        if ($this->dataDisplayTyle == 'icon'){
            return $value !== 0 ? '<span class="badge badge-success"><i class="fas fa-check"></i></span> ' : '<span class="badge badge-danger"><i class="fas fa-times"></i></span> ' ;
        }else{
            return ArrayHelper::getValue($this->enum, $value, $value);
        }
    }
}
