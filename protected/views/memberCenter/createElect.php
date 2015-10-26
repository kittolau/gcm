<?php

$this->pageTitle=Yii::app()->name . ' - Register';
CHtml::$afterRequiredLabel='<span class="required"> (必須)</span>';
?>
<?php
JSHelper::lockSubmitButtonOnSubmit();
JSHelper::preventEnterKeySubmit();
JSHelper::ApplyServersideValidationErrorToInputField();
?>
<?php
$this->pageTitle = "販賣".$model->GroupProduct_cat_title." - 會員中心 - ";
?>
<?php $this->renderPartial('_createBookSharedNav')?>

<ol class="breadcrumb">
        <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span>販賣<?php echo $model->GroupProduct_cat_title?></li>
</ol>
		
    <div class="row">
    <div class="col-md-2" style="">
    </div>
    <div class="col-md-7" style="">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groupProduct-form',
	'enableClientValidation'=>true,
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('class'=>'form col-md-12 center-block','enctype' => 'multipart/form-data','multiple'=>'multiple'),
        'clientOptions'=>  JSHelper::CActiveFormClientOptionsForBSWidget(),    
        'focus'=>array($model,'title'),
        'errorMessageCssClass'=>'has-error'
        )); ?>
        
            <?php $this->renderPartial('_createBookSharedForm',array(
                'form'=>$form,
                'model'=>$model,
                'fileModel'=>$fileModel
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'elect_demo_url',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'elect_demo_url',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'elect_format',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
    
            <?php $this->renderPartial('/site/_BSSubmitButtonWidget')?>
          <?php $this->endWidget(); ?>
    </div>
    <div class="col-md-6" style="">

    </div>
</div>
