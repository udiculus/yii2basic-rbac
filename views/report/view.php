<?php

use yii\bootstrap\Button;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $report->report_name;
$this->params['breadcrumbs'][] = ['label' => 'Report', 'url' => ['/report']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="article-index">
        <div class="page-title"><?php echo $report->report_name ?></div>
        <div class="clearfix"></div>
        <div class="page-desc"><?php echo $report->report_description ?>.</div>
        <div class="btn-group-report btn-group">
            <button class="btn btn-default"><span class="glyphicon glyphicon-wrench"></span> Customize</button>
            <button class="btn btn-default" data-toggle="modal" data-target="#delete_modal"><span
                        class="glyphicon glyphicon-trash"></span> Delete
            </button>
            <button class="btn btn-default" data-toggle="modal" data-target="#filter_modal"><span
                        class="glyphicon glyphicon-filter"></span> Filter
            </button>
        </div>
        <div class="btn-group-report btn-group right">
            <button class="btn btn-default" data-toggle="modal" data-target="#clone_modal"><span
                        class="glyphicon glyphicon-duplicate"></span> Clone Report
            </button>
            <button class="btn btn-default"><span class="glyphicon glyphicon-calendar"></span> Scheduler</button>
            <button class="btn btn-default" data-toggle="modal" data-target="#export_modal"><span
                        class="glyphicon glyphicon-export"></span> Export
            </button>
        </div>
        <?php echo GridView::widget([
            'id' => 'kv-grid-demo',
            'dataProvider' => $dataProvider,
            'columns' => $gridColumn, // check the configuration for grid columns by clicking button above
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'panelTemplate' => '<div class="panel panel-grey">
    {panelHeading}
    {items}
</div>
    {pager}
    {summary}',
            'resizableColumns' => false,
            'panelFooterTemplate' => false,
            'pjax' => false, // pjax is set to always true for this demo
            // set your toolbar
            'toolbar' => false,
            // set export properties
            'export' => [
                'fontAwesome' => true
            ],
            // parameters from the demo form
            'bordered' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'hover' => true,
            'showPageSummary' => false,
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading' => false,
            ],
            'persistResize' => true,
            'toggleDataOptions' => ['minCount' => 10],
            'exportConfig' => true,
            'itemLabelSingle' => 'record',
            'itemLabelPlural' => 'records',
            // custom
//        'beforeHeader' => 'LMAO',
            'floatHeader' => false
        ]);
        ?>
    </div>
    <!-- Modal Filter -->
    <div class="modal fade" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="filterModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="filter_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="filterModal">Filter Records</h4>
                    </div>
                    <div class="modal-body">
                        <?php foreach ($clientFilter as $filter): ?>
                            <div class="row filter-form">
                                <div class="col-md-5">
                                    <label class="label-name"
                                           for="filter-<?php echo $filter['id'] ?>"><?php echo $filter['label'] ?></label>
                                </div>
                                <div class="col-md-1">
                                    <span class="label-op"><?php echo $filter['op'] ?></span>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" value=""
                                           id="filter-<?php echo $filter['id'] ?>"
                                           name="<?php echo $filter['id'] ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Delete -->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="delete_form">
                    <input type="hidden" name="report_template_id" value="<?php echo $report->id ?>"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="deleteModal">Delete Report</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to remove this report?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes, Remove</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Clone -->
    <div class="modal fade" id="clone_modal" tabindex="-1" role="dialog" aria-labelledby="cloneModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="clone_form">
                    <input type="hidden" name="report_template_id" value="<?php echo $report->id ?>"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="deleteModal">Clone Report</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-8">
                                <div class="label-top">Enter the name for a new report</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"><label for="report_name" class="label-name">Report Name</label></div>
                            <div class="col-lg-5"><input type="text" class="form-control required" name="report_name"
                                                         id="report_name"/></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Clone Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Export -->
    <div class="modal fade" id="export_modal" tabindex="-1" role="dialog" aria-labelledby="exportModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="export_form">
                    <input type="hidden" name="report_template_id" value="<?php echo $report->id ?>"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="deleteModal">Export Report</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">

                            </div>
                            <div class="col-md-6">
                                <div class="label-top">Select the option and press Export Now to begin exporting the
                                    report.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"><label for="format" class="label-name">Select Format</label></div>
                            <div class="col-lg-5">
                                <?php echo Html::dropDownList('format', null, [
                                    'excel' => 'Excel',
                                    'csv' => 'CSV',
                                ], [
                                    'class' => 'form-control',
                                    'id' => 'format'
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Export Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
$script = <<< JS
$(document).ready(function () {
    $("#filter_form").bind('submit', function(e){
        e.preventDefault();
        var newQuery = $.query;
        $.each($(this).serializeArray(), function(key, val){
            if (val.value) 
                newQuery = newQuery.set(val.name, val.value);
        });
        window.location.search = newQuery.toString();
    });
    $("#delete_form").bind('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/report/remove',
            type: 'POST',
            dataType: 'JSON',
            data: {id: $(this).find("input[name=report_template_id]").val()},
            success: function(data) {
                window.location.href = '/report';
            }
        })
    });
    $("#clone_form").bind('submit', function(e) {
        e.preventDefault();
        $("#clone_form").find('.input-error').remove();
        var json_data = {
            id: $(this).find("input[name=report_template_id]").val(),
            name: $(this).find("input[name=report_name]").val()
        };
        
        $.each($("#clone_form").find('input.required, select.required, textarea.required'), function (key, elm) {
           if (!$(elm).val()) {
               $(elm).parent().append('<span class="input-error mt-5">This field is required</span>');
           }
        });
        
        if($("#clone_form").find('.input-error').length > 0){
           
        } else {
            $.ajax({
                url: '/report/clone',
                type: 'POST',
                dataType: 'JSON',
                data: json_data,
                success: function(data) {
                    window.location.href = '/report';
                }
            });
        }
    });
    $("#export_form").bind('submit', function(e) {
        e.preventDefault();
        $("#export_form").find('.input-error').remove();
        var id = $(this).find("input[name=report_template_id]").val();
        window.open('/report/export/' + id);
        $("#export_modal").modal('hide');
    });
});
JS;
$this->registerJs($script, View::POS_END);
?>