<?php
/* @var $this EventController */
/* @var $data Event */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_date')); ?>:</b>
	<?php echo CHtml::encode($data->event_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_time_interval')); ?>:</b>
	<?php echo CHtml::encode($data->event_time_interval); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apply_date')); ?>:</b>
	<?php echo CHtml::encode($data->apply_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('place_rent')); ?>:</b>
	<?php echo CHtml::encode($data->place_rent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lat_lng')); ?>:</b>
	<?php echo CHtml::encode($data->lat_lng); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('event_place_title')); ?>:</b>
	<?php echo CHtml::encode($data->event_place_title); ?>
	<br />

	*/ ?>

</div>