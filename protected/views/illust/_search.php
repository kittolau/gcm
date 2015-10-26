<?php
/* @var $this IllustController */
/* @var $model Illust */
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
		<?php echo $form->label($model,'created_datetime'); ?>
		<?php echo $form->textField($model,'created_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_datetime'); ?>
		<?php echo $form->textField($model,'update_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'popularity'); ?>
		<?php echo $form->textField($model,'popularity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'illust_summary'); ?>
		<?php echo $form->textField($model,'illust_summary',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tag'); ?>
		<?php echo $form->textField($model,'tag',array('size'=>60,'maxlength'=>600)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'img_src'); ?>
		<?php echo $form->textField($model,'img_src',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_r18'); ?>
		<?php echo $form->textField($model,'is_r18'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_bl'); ?>
		<?php echo $form->textField($model,'is_bl'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_deleted'); ?>
		<?php echo $form->textField($model,'is_deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'illust_category_enum'); ?>
		<?php echo $form->textField($model,'illust_category_enum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'illust_title'); ?>
		<?php echo $form->textField($model,'illust_title',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->