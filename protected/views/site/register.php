<?php



$this->pageTitle=Yii::app()->name . ' - Register';
CHtml::$afterRequiredLabel='';
JSHelper::ApplyServersideValidationErrorToInputField();
?>
<?php
$this->pageTitle = "新會員註冊 - ";
?>
<div class="row">
<div class="col col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-6 col-lg-offset-3">
<div class="panel panel-default">
<div class="panel-heading"><h3 class="text-center">新會員註冊</h3></div>
  <div class="panel-body">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableClientValidation'=>true,
        'enableAjaxValidation'=>false,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
                'afterValidate' => 'js:function(form, data, hasError) { 
                  if(hasError) {
                      for(var i in data) $("#"+i).closest(".form-group").addClass("has-error");
                      return false;
                  }
                  else {
                      form.children().closest(".form-group").removeClass("has-error");
                      return true;
                  }
              }',
              'afterValidateAttribute' => 'js:function(form, attribute, data, hasError) {
                  console.log("validating: "+attribute.id);
               if(hasError) 
                    $("#"+attribute.id).closest(".form-group").addClass("has-error");
               else 
                    $("#"+attribute.id).closest(".form-group").removeClass("has-error"); 
              }',   
        ),    
        'htmlOptions'=>array(
            'class'=>'form col-md-12 center-block'
        ),
        'focus'=>array($model,'username'),
        'errorMessageCssClass'=>''
        )); ?>
			
			<div id="regstep1body">
			<textarea id="term" class="form-control" rows="15" readonly style="background-color: #fff; cursor:auto;">
				<?php $this->renderPartial('/site/_term')?>
			</textarea>
			</div>
		
			<div id="regstep2body" style="display:none">
            <div class="form-group">
                <?php echo $form->labelEx($model,'nickname'); ?>
                <?php echo $form->textField($model,'nickname',array('class'=>'form-control','placeholder'=>"")) ?>
		<?php echo $form->error($model,'nickname',array('class'=>'help-block')); ?>
            </div>
      
            <div class="form-group">
                <?php echo $form->labelEx($model,'user_name'); ?>
                <?php echo $form->textField($model,'user_name',array('class'=>'form-control','placeholder'=>"")) ?>
		<?php echo $form->error($model,'user_name',array('class'=>'help-block')); ?>
            </div>
      
            <div class="form-group">
                <?php echo $form->labelEx($model,'password'); ?>
                <?php echo $form->passwordField($model,'password',array('class'=>'form-control','placeholder'=>"Password")); ?>
		<?php echo $form->error($model,'password',array('class'=>'help-block')); ?>
            </div>
            <div class="form-group">
                <?php echo $form->passwordField($model,'password_repeat',array('class'=>'form-control ','placeholder'=>"Password Confirm")); ?>
		<?php echo $form->error($model,'password_repeat',array('class'=>'help-block')); ?>
            </div>
      
            <div class="form-group">
                <?php echo $form->labelEx($model,'email'); ?>
                <?php echo $form->textField($model,'email',array('class'=>'form-control','placeholder'=>"")) ?>
		<?php echo $form->error($model,'email',array('class'=>'help-block')); ?>
            </div>
      
            <?php $this->renderPartial('/site/_BSDateDropDownList',array(
                'form'=>$form,
                'fieldName'=>'birthday',
                'model'=>$model,
                'explanationText'=>''
            ))?>
      <?php /*
            <label for="term">服務條款</label>
            <textarea id="term" class="form-control" rows="9" readonly style="background-color: #fff; cursor:auto;">
                <?php $this->renderPartial('/site/_term')?>
            </textarea>
       * *
       */?>

            <div class="form-group error <?php if($captchaError != '') echo 'has-error'?>">
             <?php
                require_once(Yii::app()->basePath . '/vendor/recaptchalib.php');
                $publickey = "6LfXBe8SAAAAAPh8CUxQAKGSihZLYMRKcTHOmlkU"; // you got this from the signup page
                echo recaptcha_get_html($publickey);
              ?>
                <div class="help-block" id="User_password_em_" style=""><?php echo $captchaError?></div>            
            </div>
            </div>	
            
            
            
        </div>
  <div class="panel-footer">
			<div id="regstep1footer" style="text-align:center">
				<?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'isTermAccepted',
                'model'=>$model,
                'explanationText'=>'我已清楚並同意上述服務條款'
				))?>
				<div>
				<?php echo CHTML::htmlButton('同意並繼續',array("id"=>"regtermcontinuebtn","class"=>"btn btn-success","style"=>"width:49%","disabled"=>"disabled")); ?>
				<?php echo CHTML::htmlButton('不同意',array("onclick"=>"javscript:history.back(-1)","class"=>"btn btn-danger","style"=>"width:49%")); ?>
				</div>
			</div>
			<div id="regstep2footer" style="display:none">
                <?php echo CHtml::submitButton('建立帳戶',array('class'=>"btn btn-primary btn-lg btn-block")); ?>
              <!--<span class="pull-right"><a href="#">Register</a></span><span><a href="#">Need help?</a></span>-->
			</div>

  </div>
          <?php $this->endWidget(); ?>

  </div>
</div>

</div>
<script type="text/javascript">
jQuery(function() {
	jQuery('#User_isTermAccepted').change(function() {
		if (jQuery('#User_isTermAccepted').prop('checked')) {
			jQuery('#regtermcontinuebtn').prop('disabled',false);
		} else {
			jQuery('#regtermcontinuebtn').prop('disabled',true);
		}
	});
	jQuery("#regtermcontinuebtn").click(function() {
		jQuery("#regstep1body, #regstep1footer").hide();
		jQuery("#regstep2body, #regstep2footer").show();
	});
        var isCheckedForFirstTime = jQuery('#User_isTermAccepted').prop('checked');
        if(isCheckedForFirstTime){
            jQuery("#regstep1body, #regstep1footer").hide();
            jQuery("#regstep2body, #regstep2footer").show();
        }
});
</script>