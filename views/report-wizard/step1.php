<?php

use yii\bootstrap\Button;
use yii\bootstrap\Collapse;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

?>
<?php
$form = ActiveForm::begin([
    'id' => 'form_select_column'
]);
?>
<div id="step_select_column">
    <h3 style="margin-bottom: 15px;">Step 1: Select Column</h3>
    <?php
    $customerDetails = [
        [
            'label' => 'Customer Details',
            'content' => getSelects($customer, $model, $form),
            'contentOptions' => ['class' => 'in']
        ],
    ];

    echo Collapse::widget([
        'items' => $customerDetails,
        'autoCloseItems' => false
    ]);

    $shipmentDetails = [
        [
            'label' => 'Shipment Details',
            'content' => getSelects($shipment, $model, $form),
            'contentOptions' => ['class' => 'in']
        ],
    ];

    echo Collapse::widget([
        'items' => $shipmentDetails,
        'autoCloseItems' => false
    ]);

    function getSelects($modelName, $model, yii\widgets\ActiveForm $form)
    {
//        $labels = $modelName::columnAlias();
        $labels = array();
        foreach ($modelName as $rows):
            $labels[$rows['id']] = $rows->label_name;
        endforeach;

        return $form->field($model, 'select', [
            'template' => "{input}\n{hint}\n{error}",
        ])->checkboxList($labels, [
            'item' => function ($index, $label, $name, $checked, $value) {
                return Html::checkbox($name, $checked, [
                    'value' => $value,
                    'label' => '<label for="' . $value . '">' . $label . '</label>',
                    'labelOptions' => [
                        'class' => 'ckbox ckbox-primary col-md-4'
                    ],
                    'id' => $value,
                    'data-label' => $label
                ]);
            }
        ]);
    }

    ?>
    <div class="form-group">
        <?php
        echo Button::widget([
            'id' => 'submit_select_column',
            'label' => 'Next',
            'options' => ['class' => 'btn-primary', 'type' => 'button'],
        ]);
        ?>
    </div>
</div>
<div id="step_field_order" class="hide">
    <h3 style="margin-bottom: 15px;">Step 2: Field Order</h3>

    <ol class="sortable" id="field_order">
    </ol>
    <div class="form-group">
        <?php
        echo Button::widget([
            'id' => 'submit_field_order',
            'label' => 'Next',
            'options' => ['class' => 'btn-primary', 'type' => 'button'],
        ]);
        ?>
    </div>
</div>
<div id="step_report_criteria" class="hide">
    <h3 style="margin-bottom: 15px;">Step 3: Report Criteria</h3>

    <div class="panel-group" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="advanced_filter">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                       aria-expanded="true" aria-controls="collapseOne">
                        Advanced Filter
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="advanced_filter">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4"><span class="filter-label">Field</span></div>
                        <div class="col-md-2"><span class="filter-label">Operator</span></div>
                        <div class="col-md-3"><span class="filter-label">Value</span></div>
                        <div class="col-md-2"></div>
                    </div>
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <div class="row">
                            <div class="col-md-1">
                                <span class="and-label">AND</span>
                            </div>
                            <div class="col-md-4">
                                <?php
                                $labels = array(
                                    'prompt' => 'Select criteria...'
                                );
                                foreach ($permanentClause as $rows):
                                    $labels[$rows['id']] = $rows->label_name;
                                endforeach;

                                echo $form->field($model, 'filter', [
                                    'enableLabel' => false
                                ])->dropDownList($labels);
                                ?>
                            </div>
                            <div class="col-md-2">
                                <?php echo Html::dropDownList('operator', null, [
                                    'eq' => 'equals',
                                    'nq' => 'not equal to',
                                    'lt' => 'less than',
                                    'gt' => 'greater than',
                                    'le' => 'less or equal',
                                    'ge' => 'greater or equal',
                                    'sw' => 'starts with',
                                    'ns' => 'not starts with',
                                    'in' => 'includes',
                                    'ex' => 'excludes'
                                ], [
                                    'class' => 'form-control',
                                    'id' => 'mdlreport-operator'
                                ]);
                                ?>
                            </div>
                            <div class="col-md-3">
                                <?= Html::input('text', 'username', '', ['class' => 'form-control']) ?>
                            </div>
                            <div class="col-md-2">
                                <button class="add-option" type="button">Add Options</button>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-group" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="advanced_filter">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#limitRows"
                       aria-expanded="true" aria-controls="collapseOne">
                        Limit Row Count
                    </a>
                </h4>
            </div>
            <div id="limitRows" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="advanced_filter">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2"><label for="limit_row" style="text-align: right;display: block;line-height: 35px;">Rows to display</label></div>
                        <div class="col-md-2">
                            <?php echo Html::dropDownList('limit_row', null, [
                                'all' => 'All',
                                '10' => 10,
                                '50' => 50,
                                '100' => 100
                            ], [
                                'class' => 'form-control',
                                'id' => 'limit_row'
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-group" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="advanced_filter">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#sortingOrder"
                       aria-expanded="true" aria-controls="collapseOne">
                        Sorting Order
                    </a>
                </h4>
            </div>
            <div id="sortingOrder" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="advanced_filter">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4"><span class="filter-label">Field</span></div>
                        <div class="col-md-3"><span class="filter-label">Order By</span></div>
                    </div>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <?php
                            $labels = array(
                                'prompt' => 'Select criteria...'
                            );
                            foreach ($sortingOrder as $rows):
                                $labels[$rows['id']] = $rows->label_name;
                            endforeach;

                            echo $form->field($model, 'filter', [
                                'enableLabel' => false
                            ])->dropDownList($labels);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo Html::dropDownList('sort', null, [
                                'asc' => 'Ascending',
                                'desc' => 'Descending'
                            ], [
                                'class' => 'form-control',
                                'id' => 'sort'
                            ]);
                            ?>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo Button::widget([
            'id' => 'submit_report_criteria',
            'label' => 'Next',
            'options' => ['class' => 'btn-primary', 'type' => 'button'],
        ]);
        ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$script = <<< JS
$(document).ready(function(){
    $("#submit_select_column").bind("click", function(e) {
      e.preventDefault();
      var x = $("#step_select_column").find('input[type=checkbox]:checked');
      $.each(x, function(key, val) {
            console.log($(val).val());
            // $("#field_order").append("<li>" + $(val).attr('data-label') + "</li>");
            $("#field_order").append(tmpl('tmpl-selected-field', {label: $(val).attr('data-label'), id: $(val).val()}));
      });
      sortable('.sortable');
      $("#step_select_column").addClass("hide");
      $("#step_field_order").removeClass("hide");
    });
    $("#submit_field_order").bind("click", function(e) {
      e.preventDefault();
      var x = $("#step_field_order").find('input[type=hidden].selected-field');
      console.log(x.length);
      var or = new Array();
      $.each(x, function(key, val){
        or.push(parseInt($(val).val()));
      });
      $("#step_field_order").addClass("hide");
      $("#step_report_criteria").removeClass("hide");
      
      console.log(or);
    });
});
JS;
$this->registerJs($script, View::POS_END);
?>
<script type="text/x-tmpl" id="tmpl-selected-field">
    <li class="">{%= o.label %} <input type="hidden" class="selected-field" value="{%= o.id %}"/></li>
</script>
