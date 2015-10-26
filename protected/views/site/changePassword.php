<?php



$this->pageTitle=Yii::app()->name . ' - 更新登入密碼';
CHtml::$afterRequiredLabel='';
JSHelper::ApplyServersideValidationErrorToInputField();
?>

<div class="row">
<div class="col col-xs-1 col-sm-2 col-md-3 col-lg-3"></div>
<div class="col col-xs-10 col-sm-8 col-md-6 col-lg-5">
<div class="panel panel-default">
<div class="panel-heading"><h3 class="text-center">更新登入密碼</h3></div>
  <div class="panel-body">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableClientValidation'=>true,
        'enableAjaxValidation'=>false,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
                'afterValidate' => 'js:function(form, data, hasError) { 
                  if(hasError) {
                      for(var i in data) $("#"+i).parent(".form-group").addClass("has-error");
                      return false;
                  }
                  else {
                      form.children().parent(".form-group").removeClass("has-error");
                      return true;
                  }
              }',
              'afterValidateAttribute' => 'js:function(form, attribute, data, hasError) {
               if(hasError) 
                    $("#"+attribute.id).parent(".form-group").addClass("has-error");
               else 
                    $("#"+attribute.id).parent(".form-group").removeClass("has-error"); 
              }',   
        ),    
        'htmlOptions'=>array(
            'class'=>'form col-md-12 center-block'
        ),
        'focus'=>array($model,'username'),
        'errorMessageCssClass'=>''
        )); ?>
            
      
            <div class="form-group">
                <?php echo $form->labelEx($model,'oldPassword'); ?>
                <?php echo $form->passwordField($model,'oldPassword',array('class'=>'form-control','placeholder'=>"舊密碼")) ?>
		<?php echo $form->error($model,'oldPassword',array('class'=>'help-block')); ?>
            </div>
      
            <div class="form-group">
                <?php echo $form->labelEx($model,'password'); ?>
                <?php echo $form->passwordField($model,'password',array('class'=>'form-control','placeholder'=>"新密碼")); ?>
		<?php echo $form->error($model,'password',array('class'=>'help-block')); ?>
            </div>
            <div class="form-group">
                <?php echo $form->passwordField($model,'password_repeat',array('class'=>'form-control ','placeholder'=>"新密碼確認")); ?>
		<?php echo $form->error($model,'password_repeat',array('class'=>'help-block')); ?>
            </div>
      
            <div class="form-group">
                <?php echo CHtml::submitButton('更改密碼',array('class'=>"btn btn-primary btn-lg btn-block")); ?>
              <!--<span class="pull-right"><a href="#">Register</a></span><span><a href="#">Need help?</a></span>-->
            </div>
          <?php $this->endWidget(); ?>
  </div>
  <div class="panel-footer">
  </div>
  </div>
</div>

</div>