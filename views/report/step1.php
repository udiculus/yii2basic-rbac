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
    <div class="page-title" style="margin-bottom: 15px;">Step 1: Select Column</div>
    <div class="clearfix"></div>
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

        return $form->field($model, 'select_field', [
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
    <div class="page-title" style="margin-bottom: 15px;">Step 2: Field Order</div>
    <div class="clearfix"></div>

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
    <div class="page-title" style="margin-bottom: 15px;">Step 3: Report Criteria</div>
    <div class="clearfix"></div>

    <div class="panel-group" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="advanced_filter">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#advancedFilter"
                       aria-expanded="true" aria-controls="collapseOne">
                        Advanced Filter
                    </a>
                </h4>
            </div>
            <div id="advancedFilter" class="panel-collapse collapse in" role="tabpanel"
                 aria-labelledby="advanced_filter">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4"><span class="filter-label">Field</span></div>
                        <div class="col-md-2"><span class="filter-label">Operator</span></div>
                        <div class="col-md-3"><span class="filter-label">Value</span></div>
                        <div class="col-md-2"></div>
                    </div>
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <div class="row adv-filter">
                            <div class="col-md-1">
                                <span class="and-label">AND</span>
                            </div>
                            <div class="col-md-4">
                                <?php
                                $labels = array(
                                    '' => '--None--'
                                );
                                foreach ($advancedFilter as $rows):
                                    $labels[$rows['id']] = $rows->label_name;
                                endforeach;

                                echo $form->field($model, 'filter_field', [
                                    'enableLabel' => false
                                ])->dropDownList($labels);
                                ?>
                            </div>
                            <div class="col-md-2">
                                <?php echo Html::dropDownList('ReportWizardForm[filter_operator]', null, [
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
                                <?= Html::input('text', 'ReportWizardForm[filter_value]', '', ['class' => 'form-control']) ?>
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
            <div class="panel-heading" role="tab" id="limit_rows">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#limitRows"
                       aria-expanded="true" aria-controls="collapseOne">
                        Limit Row Count
                    </a>
                </h4>
            </div>
            <div id="limitRows" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="limit_rows">
                <div class="panel-body pd-left">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="limit_row" class="single-lable">Rows to display</label>
                            <?php echo Html::dropDownList('limit_row', null, [
                                '0' => 'All',
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
            <div class="panel-heading" role="tab" id="sorting_order">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#sortingOrder"
                       aria-expanded="true" aria-controls="collapseOne">
                        Sorting Order
                    </a>
                </h4>
            </div>
            <div id="sortingOrder" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="sorting_order">
                <div class="panel-body pd-left">
                    <div class="row">
                        <div class="col-md-4"><span class="filter-label">Field</span></div>
                        <div class="col-md-3"><span class="filter-label">Order By</span></div>
                    </div>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <div class="row sorting-order">
                            <div class="col-md-4">
                                <?php
                                $labels = array(
                                    '' => '--None--'
                                );
                                foreach ($sortingOrder as $rows):
                                    $labels[$rows['id']] = $rows->label_name;
                                endforeach;

                                echo $form->field($model, 'order_field', [
                                    'enableLabel' => false
                                ])->dropDownList($labels);
                                ?>
                            </div>
                            <div class="col-md-3">
                                <?php echo Html::dropDownList('ReportWizardForm[order_type]', null, [
                                    'asc' => 'Ascending',
                                    'desc' => 'Descending'
                                ], [
                                    'class' => 'form-control',
                                    'id' => 'order_type'
                                ]);
                                ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-group" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="client_filter">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#clientFilter"
                       aria-expanded="true" aria-controls="collapseOne">
                        Show Filters on Web
                    </a>
                </h4>
            </div>
            <div id="clientFilter" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="client_filter">
                <div class="panel-body pd-left">
                    <div class="row">
                        <div class="col-md-4"><span class="filter-label">Field</span></div>
                        <div class="col-md-3"><span class="filter-label">Operator (eg <,>,=)</span></div>
                    </div>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <div class="row client-filter">
                            <div class="col-md-4">
                                <?php
                                $labels = array(
                                    '' => '--None--'
                                );
                                foreach ($clientFilter as $rows):
                                    $labels[$rows['id']] = $rows->label_name;
                                endforeach;

                                echo $form->field($model, 'client_filter_field', [
                                    'enableLabel' => false
                                ])->dropDownList($labels);
                                ?>
                            </div>
                            <div class="col-md-3">
                                <?= Html::input('text', 'ReportWizardForm[client_filter_operator]', '', ['class' => 'form-control']) ?>
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
<div id="step_report_info" class="hide">
    <div class="page-title" style="margin-bottom: 15px;">Step 4: Save Report Template</div>
    <div class="clearfix"></div>

    <div class="panel-group" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="advanced_filter">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#advancedFilter"
                       aria-expanded="true" aria-controls="collapseOne">
                        Report Information
                    </a>
                </h4>
            </div>
            <div id="advancedFilter" class="panel-collapse collapse in" role="tabpanel"
                 aria-labelledby="advanced_filter">
                <div class="panel-body pd-left">
                    <div class="row form-group">
                        <div class="col-md-3"><label class="single-lable" for="ReportWizardForm[report_name]">Report
                                Name</label></div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'report_name', ['enableLabel' => false])->textInput(); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3"><label class="single-lable" for="ReportWizardForm[report_description]">Report
                                Description</label></div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'report_description', ['enableLabel' => false])->textarea(['rows' => '6']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo Button::widget([
            'id' => 'submit_report_template',
            'label' => 'Save',
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
      var or = new Array();
      $.each(x, function(key, val){
        or.push(parseInt($(val).val()));
      });
      $("#step_field_order").addClass("hide");
      $("#step_report_criteria").removeClass("hide");
      
      console.log(or);
    });
    
    $("#submit_report_criteria").bind("click", function(e){
        e.preventDefault();
                
        $("#step_report_criteria").addClass("hide");
        $("#step_report_info").removeClass("hide");
    });
    
    $("#submit_report_template").bind("click", function(e) {
        e.preventDefault();
        
        // populate advanced filter
        var adv_filter = new Array();
        $.each($(".adv-filter"), function(key, elm) {
            if ($(elm).find("select[name='ReportWizardForm[filter_field]']").val()){
                var json = {
                    "id" : $(elm).find("select[name='ReportWizardForm[filter_field]']").val(),
                    "op" : $(elm).find("select[name='ReportWizardForm[filter_operator]']").val(),
                    "value" : $(elm).find("input[name='ReportWizardForm[filter_value]']").val()
                };
                adv_filter.push(json);
            } 
        });
        console.log(adv_filter);
        
        // populate limit row count
        var limit_row = $("#limit_row").val();
        
        // populate sorting order
        var sorting_order = new Array();
        $.each($(".sorting-order"), function(key, elm){
            if ($(elm).find("select[name='ReportWizardForm[order_field]']").val()) {
                var json = {
                    "id" : $(elm).find("select[name='ReportWizardForm[order_field]']").val(),
                    "type" : $(elm).find("select[name='ReportWizardForm[order_type]']").val()
                };
                sorting_order.push(json);
            }
        });
        console.log(sorting_order);
        
        // populate client filter
        var client_filter = new Array();
        $.each($(".client-filter"), function(key, elm){
            if ($(elm).find("select[name='ReportWizardForm[client_filter_field]']").val()) {
                var json = {
                    "id" : $(elm).find("select[name='ReportWizardForm[client_filter_field]']").val(),
                    "op" : $(elm).find("input[name='ReportWizardForm[client_filter_operator]']").val()
                };
                client_filter.push(json);
            }  
        });
        console.log(client_filter);
        
        // populate order field
        var elm = $("#step_field_order").find('input[type=hidden].selected-field');
        var field_order = new Array();
        $.each(elm, function(key, val){
            field_order.push(parseInt($(val).val()));
        });
        
        var post_json = {
            report_name: $("input[name='ReportWizardForm[report_name]']").val(),
            report_description: $("textarea[name='ReportWizardForm[report_description]']").val(),
            field_order: field_order,
            limit_per_page: limit_row,
            filter: adv_filter,
            client_filter: client_filter,
            sorting_order: sorting_order
        };
        console.log(post_json);
        
        $.ajax({
            url: '/report/save',
            data: post_json,
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
            }
        });
    });
});
JS;
$this->registerJs($script, View::POS_END);
?>
<script type="text/x-tmpl" id="tmpl-selected-field">
    <li class="">{%= o.label %} <input type="hidden" class="selected-field" value="{%= o.id %}"/></li>
</script>
