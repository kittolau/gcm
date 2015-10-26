<?php
/* @var $this EventController */
/* @var $model Event */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event_date'); ?>
		<?php echo $form->textField($model,'event_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event_time_interval'); ?>
		<?php echo $form->textField($model,'event_time_interval',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'apply_date'); ?>
		<?php echo $form->textField($model,'apply_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'place_rent'); ?>
		<?php echo $form->textField($model,'place_rent',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lat_lng'); ?>
		<?php echo $form->textField($model,'lat_lng',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event_place_title'); ?>
		<?php echo $form->textField($model,'event_place_title',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->