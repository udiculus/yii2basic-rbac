<?php

use yii\bootstrap\Button;
use yii\helpers\Html;
use kartik\grid\GridView;

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
        <button class="btn btn-default"><span class="glyphicon glyphicon-trash"></span> Delete</button>
        <button class="btn btn-default" data-toggle="modal" data-target="#filter_modal"><span class="glyphicon glyphicon-filter"></span> Filter</button>
    </div>
    <div class="btn-group-report btn-group right">
        <button class="btn btn-default"><span class="glyphicon glyphicon-duplicate"></span> Clone Report</button>
        <button class="btn btn-default"><span class="glyphicon glyphicon-calendar"></span> Scheduler</button>
        <button class="btn btn-default"><span class="glyphicon glyphicon-export"></span> Export</button>
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
        'pjax' => true, // pjax is set to always true for this demo
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
<!-- Modal -->
<div class="modal fade" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Filter Records</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Apply</button>
            </div>
        </div>
    </div>
</div>
