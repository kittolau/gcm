<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
JSHelper::ApplyServersideValidationErrorToInputField();
?>
<?php
$this->pageTitle = "登入 - ";
?>
<div class="row">
<div class="col col-xs-1 col-sm-2 col-md-3 col-lg-4"></div>
<div class="col col-xs-10 col-sm-8 col-md-6 col-lg-4">
<div class="panel panel-default">
<div class="panel-heading"><h3 class="text-center">登入</h3></div>
  <div class="panel-body">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
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
                <?php echo $form->textField($model,'username',array('class'=>'form-control','placeholder'=>"Username")) ?>
		<?php echo $form->error($model,'username',array('class'=>'help-block')); ?>
            </div>
            <div class="form-group">
                <?php echo $form->passwordField($model,'password',array('class'=>'form-control','placeholder'=>"Password")); ?>
		<?php echo $form->error($model,'password',array('class'=>'help-block')); ?>
            </div>
			<div class="checkbox">
			<label>
			<?php echo $form->checkBox($model,'rememberMe'); ?> 記住我
			</label>
			</div>
            <div class="form-group">
                <?php echo CHtml::submitButton('登入',array('class'=>"btn btn-primary btn-lg btn-block")); ?>
              <span class="pull-right"><?php echo CHtml::link(CHtml::encode('建立新帳戶'),array('site/register')) ?></span><span><?php echo CHtml::link(CHtml::encode('需要幫助?'),array('site/ContactUS')) ?></span>
            </div>
          <?php $this->endWidget(); ?>
  </div>
  <div class="panel-footer">
  </div>
  </div>
</div>

</div>