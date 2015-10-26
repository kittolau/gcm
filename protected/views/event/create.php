<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Event', 'url'=>array('index')),
	array('label'=>'Manage Event', 'url'=>array('admin')),
);

$this->pageTitle = "create - 活動場次 - ";
?>
<?php $this->renderPartial('_form', array('model'=>$model,'fileModel'=>$fileModel)); ?>