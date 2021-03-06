<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Event', 'url'=>array('index')),
	array('label'=>'Create Event', 'url'=>array('create')),
	array('label'=>'View Event', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Event', 'url'=>array('admin')),
);

$this->pageTitle = "update - 活動場次 - ";
?>

<h1>Update Event <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'fileModel'=>$fileModel)); ?>