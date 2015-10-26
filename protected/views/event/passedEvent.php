<?php
/* @var $this IllustController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Illusts',
);

$this->pageTitle = "活動場次 - 查看過去活動";
?>

<!-- Example row of columns -->
<div class="row">

<!-- search bar -->

<div  class="col-xs-12 col-sm-4 col-md-3 col-lg-3"><!-- z-index:1020; - fix for .pull-right on xs widths-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo CHtml::link(CHtml::encode("返回活動列表"), array('/event/index'),array("class"=>'btn btn-primary btn-block')); ?>
        </div>
    </div>
    <?php /*$this->Widget('PastEventWidget',array())*/?>
</div><!-- SIDE BAR END -->


	  
<!-- CONTENT SIDE-->
<div class="col-sm-9 col-lg-8">
 
<ul>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$passedEventData,
	//'dataProvider'=>$model->search(),
        'emptyText'=>'沒有相關活動',
        'enablePagination'=>true,
        'summaryText'=>'共 {count} 活動',
        'template'=>'<div class="pagination pull-right"><h6>{summary}</h6></div>{pager}<div class="clearfix"></div>{items}{pager}',
	'itemView'=>'_singlePassedEventItem',
        'ajaxUpdate' => true,  // This is it.
        'itemsCssClass'=>'row', //there will be a div wrapping all items
        'pagerCssClass'=>'whatever',//there will be a div wrapping pager
        //'updateSelector'=>'.pagination li a',
        'pager'=>array(
							'maxButtonCount'=>5,
							'cssFile'=>null,
							'pageSize' => 6,
							//'class'=>'customLinkPager',
							'header'=>'',

							'firstPageLabel' => '|&lt;',
							'prevPageLabel' => '&lt;',
							'nextPageLabel' => '&gt;',
							'lastPageLabel' => '&gt;|',

							'hiddenPageCssClass'=>'disabled',
							'internalPageCssClass'=>'', //for 1 , 2 , 3 ,4
							'nextPageCssClass'=>'',
							'previousPageCssClass'=>'',
							'lastPageCssClass'=>'',
							'firstPageCssClass'=>'',
							'selectedPageCssClass'=>'active', //for selected li
							'htmlOptions'=>array('class'=>'pagination'), //for ul
							),
)); ?>
</ul>

</div>
</div>


