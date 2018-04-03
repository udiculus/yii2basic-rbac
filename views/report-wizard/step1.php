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
    $mainTable = [
        [
            'label' => 'Customer Details',
            'content' => getSelects($customer, $model, $form),
            // open its content by default
            'contentOptions' => ['class' => 'in']
        ],
    ];

    echo Collapse::widget([
        'items' => $mainTable,
//        'items' => array_merge($mainTable, $relationItems),
        'autoCloseItems' => false
    ]);

    function getSelects($modelName, $model, yii\widgets\ActiveForm $form)
    {
//        $labels = $modelName::columnAlias();
        $labels = array();
        foreach ($modelName as $rows):
            $labels[$rows['id']] = $rows->label_name;
        endforeach;

        return $form->field($model, 'select')->checkboxList($labels, ['class' => 'select-column']);
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

    <ul class="sortable" id="field_order">
        <?php foreach ($customer as $rows): ?>
            <li><?php echo $rows->label_name ?></li>
        <?php endforeach;; ?>
    </ul>
</div>
<?php ActiveForm::end(); ?>
<?php
$script = <<< JS
$(document).ready(function(){
    console.log("hoho haha");
    
    $("#submit_select_column").bind("click", function(e) {
      e.preventDefault();
      var x = $(".select-column").find('input[type=checkbox]:checked');
      $.each(x, function(key, val) {
            console.log($(val).val());
            $("#field_order").append("<li>" + $(val).html() + "</li>");
      });
      sortable('.sortable');
      $("#step_select_column").addClass("hide");
      $("#step_field_order").removeClass("hide");
    })
});
JS;
$this->registerJs($script, View::POS_END);
?>
