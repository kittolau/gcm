<?php
/* @var $this GroupProductController */
/* @var $model GroupProduct */

$this->breadcrumbs=array(
	'Group Products'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GroupProduct', 'url'=>array('index')),
	array('label'=>'Create GroupProduct', 'url'=>array('create')),
	array('label'=>'View GroupProduct', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GroupProduct', 'url'=>array('admin')),
);

$this->pageTitle = "更新販賣情報 - 販賣情報 - ";
?>

<?php $this->renderPartial('_updateGroupProduct', array('model'=>$model)); ?>