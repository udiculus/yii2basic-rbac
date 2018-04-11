<?php

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
    {panelFooter}
</div>',
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
