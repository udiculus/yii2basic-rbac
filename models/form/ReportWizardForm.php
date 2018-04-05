<?php

namespace app\models\form;

use Yii;
use yii\base\Model;

class ReportWizardForm extends Model
{

    var $report_name, $report_description, $select_field, $filter_field, $filter_operator, $filter_value, $limit_row, $order_field, $order_type, $client_filter_field, $client_filter_operator;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_name', 'report_description', 'field_order', 'filter', 'sorting_order', 'client_filter', 'select_field', 'filter_field', 'filter_operator', 'filter_value', 'limit_row', 'order_field', 'order_type', 'client_filter_field', 'client_filter_operator'], 'string'],
            [['limit_per_page'], 'required'],
            [['limit_per_page'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'report_name' => 'Report Name',
            'report_description' => 'Report Description',
            'field_order' => 'Field Order',
            'filter' => 'Filter',
            'limit_per_page' => 'Limit Per Page',
            'sorting_order' => 'Sorting Order',
            'client_filter' => 'Client Filter',
            'select_field' => 'Select Field',
            'filter_field' => 'Filter Field',
            'filter_operator' => 'Filter Operator',
            'filter_value' => 'Filter Value',
            'limit_row' => 'Limit Row',
            'order_field' => 'Order Field',
            'order_type' => 'Order Type',
            'client_filter_field' => 'Client Filter Field',
            'client_filter_operator' => 'Client Filter Operator',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}