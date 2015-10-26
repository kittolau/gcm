<?php
        if($model == null){
            throw new Exception("_BSCheckBoxWidget cannot init if model is null");
        }
        if($fieldName == null){
            throw new Exception("_BSCheckBoxWidget cannot init if fieldName is null");
        }
        if($form == null){
            throw new Exception("_BSCheckBoxWidget cannot init if form is null");
        }
?>
<div class="form-group">
    <?php echo $form->labelEx($model,$fieldName); ?>
    </br>
    <label class="checkbox-inline">
    <?php echo $form->checkBox($model,$fieldName) ?>
    <?php echo $explanationText?>
    </label>
    <?php echo $form->error($model,$fieldName,array('class'=>'help-block')); ?>
</div>