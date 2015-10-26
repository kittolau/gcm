<?php
/* @var $this GroupProductController */
/* @var $model GroupProduct */

$this->breadcrumbs=array(
	'Group Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GroupProduct', 'url'=>array('index')),
	array('label'=>'Manage GroupProduct', 'url'=>array('admin')),
);
$this->pageTitle = "創建販賣情報 - 販賣情報 - ";
?>

<h1>Create GroupProduct</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>