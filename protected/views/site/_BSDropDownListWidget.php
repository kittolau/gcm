<?php
        if($model == null){
            throw new Exception("_BSDropDownListWidget cannot init if model is null");
        }
        if($form == null){
            throw new Exception("_BSDropDownListWidget cannot init if form is null");
        }
        if($option == null){
            $default = array();
            $option = CHtml::listData($default,'','');;
        }
?>
<div class="form-group">
    <?php echo $form->labelEx($model,$fieldName); ?> 
    <?php echo $form->dropDownList($model, $fieldName,$option, array('class'=>'form-control')); ?> 
    <div class="help-block"><?php echo $explanationText?></div>
    <?php echo $form->error($model,$fieldName,array('class'=>'help-block')); ?>
</div>