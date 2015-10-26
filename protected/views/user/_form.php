<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->textField($model,'sex',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website_url'); ?>
		<?php echo $form->textField($model,'website_url',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'website_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'summary'); ?>
		<?php echo $form->textField($model,'summary',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'summary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_datetime'); ?>
		<?php echo $form->textField($model,'created_datetime'); ?>
		<?php echo $form->error($model,'created_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'icon_src'); ?>
		<?php echo $form->textField($model,'icon_src',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'icon_src'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'show_r18'); ?>
		<?php echo $form->textField($model,'show_r18'); ?>
		<?php echo $form->error($model,'show_r18'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'show_bl'); ?>
		<?php echo $form->textField($model,'show_bl'); ?>
		<?php echo $form->error($model,'show_bl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accept_job'); ?>
		<?php echo $form->textField($model,'accept_job'); ?>
		<?php echo $form->error($model,'accept_job'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->