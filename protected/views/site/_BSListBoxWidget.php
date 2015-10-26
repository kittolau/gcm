
<?php
        if($model == null){
            throw new Exception("_BSListBoxWidget cannot init if model is null");
        }
        if($fieldName == null){
            throw new Exception("_BSListBoxWidget cannot init if fieldName is null");
        }
        if($form == null){
            throw new Exception("_BSListBoxWidget cannot init if form is null");
        }
        /*
        if($option == null){
            throw new Exception("_BSListBoxWidget Need to be populated with data");
        }
         */
?>


<div class="form-group">
    <?php echo $form->labelEx($model,$fieldName); ?>
    <?php echo $form->listBox($model,$fieldName,$option,array('class'=>'form-control','placeholder'=>"","multiple"=>'true','options'=>array($preselected_id=>array('selected'=>'selected')))) ?>
    <?php echo $explanationText ?>
    <?php echo $form->error($model,$fieldName,array('class'=>'help-block')); ?>
</div>
