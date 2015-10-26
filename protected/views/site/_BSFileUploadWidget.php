<?php
        if($model == null){
            throw new Exception("_BSFileUploadWidget cannot init if model is null");
        }
        if(!($model instanceof FileUploadFormModel)){
            throw new Exception("_BSFileUploadWidget must be used with FileUploadFormModel");
        }
        if($form == null){
            throw new Exception("_BSFileUploadWidget cannot init if form is null");
        }
?>
<div class="form-group">
    <?php echo $form->labelEx($model,FileUploadFormModel::SINGLE_FILE_FIELD_NAME); ?> 
    <?php echo $form->fileField($model, FileUploadFormModel::SINGLE_FILE_FIELD_NAME, array('class'=>'btn btn-default ')); ?> 
    <div class="help-block"><?php echo $explanationText?></div>
    <?php echo $form->error($model,FileUploadFormModel::SINGLE_FILE_FIELD_NAME,array('class'=>'help-block')); ?>
</div>