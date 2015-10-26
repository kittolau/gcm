
<?php
        if($model == null){
            throw new Exception("_BSTextFieldWidget cannot init if model is null");
        }
        if($fieldName == null){
            throw new Exception("_BSTextFieldWidget cannot init if fieldName is null");
        }
        if($form == null){
            throw new Exception("_BSTextFieldWidget cannot init if form is null");
        }
?>


<div class="form-group">
    <?php echo $form->labelEx($model,$fieldName); ?>
    <?php echo $form->textField($model,$fieldName,array('class'=>'form-control','placeholder'=>"")) ?>
    <div class='help-block'>
    <?php echo $explanationText ?>
    </div>
    <?php echo $form->error($model,$fieldName,array('class'=>'help-block')); ?>
</div>
