<?php
/* @var $this GroupProductController */
/* @var $model GroupProduct */
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
		<?php echo $form->label($model,'group_id'); ?>
		<?php echo $form->textField($model,'group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_datetime'); ?>
		<?php echo $form->textField($model,'created_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_update_datetime'); ?>
		<?php echo $form->textField($model,'last_update_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'img_src'); ?>
		<?php echo $form->textField($model,'img_src',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'thumbnail_src'); ?>
		<?php echo $form->textField($model,'thumbnail_src',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_summary'); ?>
		<?php echo $form->textField($model,'product_summary',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tag'); ?>
		<?php echo $form->textField($model,'tag',array('size'=>60,'maxlength'=>600)); ?>
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
		<?php echo $form->label($model,'product_catagory_enum'); ?>
		<?php echo $form->textField($model,'product_catagory_enum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'book_number_of_page'); ?>
		<?php echo $form->textField($model,'book_number_of_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'book_inner_page_materia'); ?>
		<?php echo $form->textField($model,'book_inner_page_materia',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'book_outer_page_materia'); ?>
		<?php echo $form->textField($model,'book_outer_page_materia',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gift_material'); ?>
		<?php echo $form->textField($model,'gift_material',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'elect_demo_url'); ?>
		<?php echo $form->textField($model,'elect_demo_url',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'elect_is_selling'); ?>
		<?php echo $form->textField($model,'elect_is_selling'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'elect_selling_url'); ?>
		<?php echo $form->textField($model,'elect_selling_url',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'elect_size'); ?>
		<?php echo $form->textField($model,'elect_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'elect_format'); ?>
		<?php echo $form->textField($model,'elect_format',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->