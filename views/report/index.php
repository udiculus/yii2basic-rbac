<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Template Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">
    <div class="page-title"><?= Html::encode($this->title) ?></div> <?= Html::a('New Template Wizard', ['new'], ['class' => 'btn btn-success page-button']) ?>
    <ul class="template-reports">
        <?php foreach ($report as $rows) : ?>
            <li class="row">
                <div class="col-md-4">
                    <div class="">
                        <a href="#"><i class=""></i><?php echo $rows->report_name; ?></a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
