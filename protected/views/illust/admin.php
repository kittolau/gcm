<?php
/* @var $this IllustController */
/* @var $model Illust */

$this->breadcrumbs=array(
	'Illusts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Illust', 'url'=>array('index')),
	array('label'=>'Create Illust', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#illust-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->pageTitle = "admin - 個人作品 - ";
?>

<h1>Manage Illusts</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'illust-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'created_datetime',
		'update_datetime',
		'popularity',
		'illust_summary',
		'tag',
		/*
		'img_src',
		'is_r18',
		'is_bl',
		'is_deleted',
		'illust_category_enum',
		'illust_title',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
