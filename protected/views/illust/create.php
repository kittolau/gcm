<?php
/* @var $this IllustController */
/* @var $model Illust */

$this->breadcrumbs=array(
	'Illusts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Illust', 'url'=>array('index')),
	array('label'=>'Manage Illust', 'url'=>array('admin')),
);
$this->pageTitle = "創建個人作品 - 個人作品 - ";
?>

<h1>Create Illust</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>