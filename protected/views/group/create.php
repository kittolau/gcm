<?php
/* @var $this GroupController */
/* @var $model Group */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Group', 'url'=>array('index')),
	array('label'=>'Manage Group', 'url'=>array('admin')),
);
$this->pageTitle = "組織創建 - 組織 - ";

?>

<h1>Create Group</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
