<?php
/* @var $this IllustController */
/* @var $model Illust */

$this->breadcrumbs=array(
	'Illusts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Illust', 'url'=>array('index')),
	array('label'=>'Create Illust', 'url'=>array('create')),
	array('label'=>'View Illust', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Illust', 'url'=>array('admin')),
);
$this->pageTitle = "更新個人作品 - 個人作品 - ";
?>

<?php $this->renderPartial('_updateIllust', array('model'=>$model)); ?>