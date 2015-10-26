<?php

$this->pageTitle=Yii::app()->name . ' - User Update';
CHtml::$afterRequiredLabel='<span class="required"> (必須)</span>';
?>
<?php
JSHelper::lockSubmitButtonOnSubmit();
JSHelper::preventEnterKeySubmit();
JSHelper::ApplyServersideValidationErrorToInputField();
?>

<ol class="breadcrumb">
        <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span>個人資料更新</li>
</ol>
		
    <div class="row">
    <div class="col-md-4 col-md-push-7" style="">
 
    </div>
    <div class="col-md-7 col-md-pull-4" style="">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'userUpdate-form',
	'enableClientValidation'=>true,
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('class'=>'form col-md-12 center-block','enctype' => 'multipart/form-data','multiple'=>'multiple'),
        'clientOptions'=>  JSHelper::CActiveFormClientOptionsForBSWidget(),    
        'focus'=>array($model,'illust_title'),
        'errorMessageCssClass'=>'has-error'
        )); ?>
        
            <div class="form-group ">
                <label >使用者名稱</label>    
                <input class="form-control" placeholder="" type="text" maxlength="50" value="<?php echo $model->user_name?>" disabled="disabled">        
            </div>
        
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'email',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'nickname',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'website_url',
                'model'=>$model,
                'explanationText'=>'需要加上 http:// 或 https://'
            ))?>
        
            <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'show_r18',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'show_bl',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'accept_job',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextAreaWidget',array(
                'form'=>$form,
                'fieldName'=>'summary',
                'model'=>$model,
                'rows'=>'5',
                'explanationText'=>''
            ))?>
        
    
            <?php $this->renderPartial('/site/_BSSubmitButtonWidget')?>
          <?php $this->endWidget(); ?>
    </div>
    
</div>

