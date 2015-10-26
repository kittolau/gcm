<?php
        if($model == null){
            throw new Exception("_BSMultiFileUploadWidget cannot init if model is null");
        }
        if(!($model instanceof FileUploadFormModel)){
            throw new Exception("_BSMultiFileUploadWidget must be used with FileUploadFormModel");
        }
        if($form == null){
            throw new Exception("_BSMultiFileUploadWidget cannot init if form is null");
        }
        $accept=$model->getClientSideAcceptFormat();
        $maxFile=$model->getClientSideMaxFile();
?>

<div class="form-group">
    <?php echo $form->labelEx($model,FileUploadFormModel::MULTI_FILE_FIELD_NAME); ?> 
     <?php
    $this->widget('CMultiFileUpload', array(
        //populate to model somehow not working properly
       'model'=>$model,
        
       'attribute'=>FileUploadFormModel::MULTI_FILE_FIELD_NAME,
        //'name'=>BSMultiFileUploadWidget::fieldName,
       'accept'=>$accept,
       'htmlOptions'=>array('class'=>'btn btn-default '),
       'options'=>array(
          //'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
          // 'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
          // 'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
          // 'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
          // 'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
          // 'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
       ),
       'denied'=>'File is not allowed',
       'max'=>$maxFile, // max 10 files
        'remove'=>'<button type="button" class="btn btn-primary btn-sm" value=""><span class="glyphicon glyphicon-remove-sign"></span> Remove</button>',
        'duplicate'=>'Already Selected',
    ));
  ?>
    <div class="help-block"><?php echo $explanationText?></div>
    <?php echo $form->error($model,FileUploadFormModel::MULTI_FILE_FIELD_NAME,array('class'=>'help-block')); ?>
</div>