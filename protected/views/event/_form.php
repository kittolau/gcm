<?php

$this->pageTitle=Yii::app()->name . ' - Register';
CHtml::$afterRequiredLabel='<span class="required"> (必須)</span>';
?>
<?php
JSHelper::lockSubmitButtonOnSubmit();
JSHelper::preventEnterKeySubmit();
JSHelper::ApplyServersideValidationErrorToInputField();
?>

<ol class="breadcrumb">
        <li class="active"> <span class="glyphicon glyphicon-chevron-down">新增活動</span></li>
</ol>
		
    <div class="row">
    <div class="col-md-4 col-md-push-7" style="">
    </div>
    <div class="col-md-7 col-md-pull-4" style="">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
	'enableClientValidation'=>true,
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('class'=>'form col-md-12 center-block','enctype' => 'multipart/form-data','multiple'=>'multiple'),
        'clientOptions'=>  JSHelper::CActiveFormClientOptionsForBSWidget(),    
        'focus'=>array($model,'title'),
        'errorMessageCssClass'=>'has-error'
        )); ?>
        
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'title',
                'model'=>$model,
                'explanationText'=>''
            ))?>
            
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'event_date',
                'model'=>$model,
                'explanationText'=>'2012-03-24'
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextAreaWidget',array(
                'form'=>$form,
                'fieldName'=>'event_time_interval',
                'model'=>$model,
                'rows'=>'5',
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextAreaWidget',array(
                'form'=>$form,
                'fieldName'=>'apply_date',
                'model'=>$model,
                'rows'=>'5',
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextAreaWidget',array(
                'form'=>$form,
                'fieldName'=>'ticket_price',
                'model'=>$model,
                'rows'=>'5',
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextAreaWidget',array(
                'form'=>$form,
                'fieldName'=>'place_rent',
                'model'=>$model,
                'rows'=>'5',
                'explanationText'=>''
            ))?>

            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'lat_lng',
                'model'=>$model,
                'explanationText'=>'Example "-34.397, 150.644"'
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextAreaWidget',array(
                'form'=>$form,
                'fieldName'=>'event_place_title',
                'model'=>$model,
                'rows'=>'5',
                'explanationText'=>''
            ))?>
        
        <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'official_website_url',
                'model'=>$model,
                'explanationText'=>'必需加上 http:// 或 https://, 非必需輸入'
            ))?>
        
         <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'apply_form_url',
                'model'=>$model,
                'explanationText'=>'必需加上 http:// 或 https://, 非必需輸入'
            ))?>
        
        <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'is_doujin',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
        <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'is_stage',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
        <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'is_cosplay',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
        <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'is_product_upload_allowed',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
         <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'is_promotion_iframe_allowed',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
        
        <?php $this->renderPartial('/site/_BSFileUploadWidget',array(
                'form'=>$form,
                'model'=>$fileModel,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSSubmitButtonWidget')?>
          <?php $this->endWidget(); ?>
    </div>
    
</div>
