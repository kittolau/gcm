<?php
CHtml::$errorCss='has-error';
$this->pageTitle=Yii::app()->name . ' - Register';
CHtml::$afterRequiredLabel='<span class="required"> (必須)</span>';
?>
<?php
JSHelper::lockSubmitButtonOnSubmit();
JSHelper::preventEnterKeySubmit();
JSHelper::ApplyServersideValidationErrorToInputField();
?>
    <?php
$this->pageTitle = "創作".$model->Illust_cat_title." - 會員中心 - ";
?>
<?php $this->renderPartial('_createIllustSharedNav')?>
    
<ol class="breadcrumb">
    <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span>投稿<?php echo $model->Illust_cat_title?></li>
</ol>
    
<div class="row">
    <div class="col-md-2" style="">
    </div>
    <div class="col-md-7" style="">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'illust-form',
	'enableClientValidation'=>true,
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('class'=>'form col-md-12 center-block','enctype' => 'multipart/form-data','multiple'=>'multiple'),
        'clientOptions'=>  JSHelper::CActiveFormClientOptionsForBSWidget(),    
        'focus'=>array($model,'illust_title'),
        'errorMessageCssClass'=>'has-error'
        )); ?>
            
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'illust_title',
                'model'=>$model,
                'explanationText'=>''
            ))?>
                
            <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'is_r18',
                'model'=>$model,
                'explanationText'=>''
            ))?>
                
            <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'is_bl',
                'model'=>$model,
                'explanationText'=>''
            ))?>
                
            <?php $this->Widget('TagWidget',array(
                'form'=>$form,
                'fieldName'=>'tag',
                'model'=>$model,
                'explanationText'=>''
            ))?>
                
            <?php $this->renderPartial('/site/_BSTextAreaWidget',array(
                'form'=>$form,
                'fieldName'=>'illust_summary',
                'model'=>$model,
                'rows'=>'5',
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
    <div class="col-md-6" style="">
        
    </div>
</div>
    
    
    
    