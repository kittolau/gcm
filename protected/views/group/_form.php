<?php
/* @var $this GroupController */
/* @var $model Group */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'group-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'approved'); ?>
		<?php echo $form->textField($model,'approved'); ?>
		<?php echo $form->error($model,'approved'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_name'); ?>
		<?php echo $form->textField($model,'group_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'group_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_summary'); ?>
		<?php echo $form->textField($model,'group_summary',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'group_summary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_datetime'); ?>
		<?php echo $form->textField($model,'created_datetime'); ?>
		<?php echo $form->error($model,'created_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'popularity'); ?>
		<?php echo $form->textField($model,'popularity'); ?>
		<?php echo $form->error($model,'popularity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_recuiting'); ?>
		<?php echo $form->textField($model,'is_recuiting'); ?>
		<?php echo $form->error($model,'is_recuiting'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website_url'); ?>
		<?php echo $form->textField($model,'website_url',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'website_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_email'); ?>
		<?php echo $form->textField($model,'contact_email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook_url'); ?>
		<?php echo $form->textField($model,'facebook_url',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'facebook_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_auto_approved'); ?>
		<?php echo $form->textField($model,'is_auto_approved'); ?>
		<?php echo $form->error($model,'is_auto_approved'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'icon_src'); ?>
		<?php echo $form->textField($model,'icon_src',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'icon_src'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->