<?php
        if($model == null){
            throw new Exception("_BSTextAreaWidget cannot init if model is null");
        }
        if($fieldName == null){
            throw new Exception("_BSTextAreaWidget cannot init if fieldName is null");
        }
        if($form == null){
            throw new Exception("_BSTextAreaWidget cannot init if form is null");
        }
?>
<div class="form-group">
    <?php echo $form->labelEx($model,$fieldName); ?>
    <?php echo $form->textArea($model,$fieldName,array('class'=>'form-control','rows'=>$rows,'placeholder'=>"")); ?>
    <?php echo $form->error($model,$fieldName,array('class'=>'help-block')); ?>
</div>