<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'customerSID') ?>

    <?= $form->field($model, 'customerCode') ?>

    <?= $form->field($model, 'customerName') ?>

    <?= $form->field($model, 'customerAddress1') ?>

    <?= $form->field($model, 'customerAddress2') ?>

    <?php // echo $form->field($model, 'customerAddress3') ?>

    <?php // echo $form->field($model, 'customerAddressCountrySID') ?>

    <?php // echo $form->field($model, 'customerLocationSID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
