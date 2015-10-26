<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode($data->sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website_url')); ?>:</b>
	<?php echo CHtml::encode($data->website_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('summary')); ?>:</b>
	<?php echo CHtml::encode($data->summary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_name')); ?>:</b>
	<?php echo CHtml::encode($data->user_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->created_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('icon_src')); ?>:</b>
	<?php echo CHtml::encode($data->icon_src); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('show_r18')); ?>:</b>
	<?php echo CHtml::encode($data->show_r18); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('show_bl')); ?>:</b>
	<?php echo CHtml::encode($data->show_bl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accept_job')); ?>:</b>
	<?php echo CHtml::encode($data->accept_job); ?>
	<br />

	*/ ?>

</div>