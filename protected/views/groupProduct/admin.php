<?php
/* @var $this GroupProductController */
/* @var $model GroupProduct */

$this->breadcrumbs=array(
	'Group Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List GroupProduct', 'url'=>array('index')),
	array('label'=>'Create GroupProduct', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#group-product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->pageTitle = "admin - 販賣情報 - ";
?>

<h1>Manage Group Products</h1>

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
	'id'=>'group-product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'group_id',
		'price',
		'created_datetime',
		'last_update_datetime',
		'img_src',
		/*
		'thumbnail_src',
		'product_summary',
		'tag',
		'is_r18',
		'is_bl',
		'is_deleted',
		'product_catagory_enum',
		'book_number_of_page',
		'book_inner_page_materia',
		'book_outer_page_materia',
		'gift_material',
		'elect_demo_url',
		'elect_is_selling',
		'elect_selling_url',
		'elect_size',
		'elect_format',
		'title',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
