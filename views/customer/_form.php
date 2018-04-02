<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customerCode')->textInput() ?>

    <?= $form->field($model, 'customerName')->textInput() ?>

    <?= $form->field($model, 'customerAddress1')->textInput() ?>

    <?= $form->field($model, 'customerAddress2')->textInput() ?>

    <?= $form->field($model, 'customerAddress3')->textInput() ?>

    <?= $form->field($model, 'customerAddressCountrySID')->textInput() ?>

    <?= $form->field($model, 'customerLocationSID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
