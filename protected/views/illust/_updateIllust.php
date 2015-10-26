<?php
/* @var $this IllustController */
/* @var $model Illust */
/* @var $form CActiveForm */
JSHelper::ApplyServersideValidationErrorToInputField();
?>
<ol class="breadcrumb">
        <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span>更新作品資料</li>
</ol>
		
    <div class="row">
    <div class="col-md-2" style="">
    </div>
    <div class="col-md-7" style="">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'illust-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableClientValidation'=>true,
        'htmlOptions' => array('class'=>'form col-md-12 center-block'),
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
                
                
            <?php $this->renderPartial('/site/_BSSubmitButtonWidget')?>
          <?php $this->endWidget(); ?>
  </div>
    
</div>

