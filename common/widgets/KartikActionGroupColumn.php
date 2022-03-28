<?php


namespace common\widgets;


use yii\base\InvalidConfigException;
use yii\helpers\Html;

class KartikActionGroupColumn extends \kartik\grid\ActionColumn
{
    public $filterContent = 'asaa';

    /**
     * @var boolean whether to group grid data by this column. Defaults to `false`. Note that your query must sort the
     * data by this column for it to be effective.
     */
    public $group = false;

    /**
     * @var integer|Closure the column index of which this group is a sub group of. This is validated only if `group`
     * is set to `true`.  If setup as a Closure, the signature of the function should be: `function ($model, $key,
     * $index, $column)`, where `$model`, `$key`, and `$index` refer to the model, key and index of the row
     * currently being rendered, and `$column` is a reference to the [[DataColumn]] object.
     */
    public $subGroupOf;

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->initGrouping();
    }

    /**
     * {@inheritdoc}
     */
    protected function renderFilterCellContent()
    {
        return $this->filterContent;
    }

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function renderDataCell($model, $key, $index)
    {
        $options = $this->fetchContentOptions($model, $key, $index);
        $this->parseGrouping($options, $model, $key, $index);
        return Html::tag('td', $this->renderDataCellContent($model, $key, $index), $options);
    }
}