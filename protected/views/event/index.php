<?php
/* @var $this IllustController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Illusts',
);

$this->pageTitle = "活動場次 - ";
?>

<ol class="breadcrumb">
    <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span> 活動列表</li>
</ol>

        <?php $form=$this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        )); ?>
                <div class="row">
                        <?php $this->renderPartial('/site/_BSSortDropDownListWidget',array(
                            'model'=>$model,
                            'form'=>$form,
                            'defaultDesc'=>false
                        ))?>

                        <?php $this->renderPartial('/site/_BSSortRevertWidget',array(
                            'model'=>$model,
                            'defaultDesc'=>false
                        ))?>
                </div>                               
        <?php $this->endWidget(); ?>


<?php $this->widget('zii.widgets.CListView', array(

	'dataProvider'=>$indexData,
	//'dataProvider'=>$model->search(),
        'emptyText'=>'沒有相關活動',
        'enablePagination'=>true,
        'summaryText'=>'共 {count} 活動',
        'template'=>'<div class="pagination pull-right"><h6>{summary}</h6></div>{pager}<div class="clearfix"></div>{items}{pager}',
	'itemView'=>'_singleEventItem',
        'ajaxUpdate' => true,  // This is it.
        'itemsCssClass'=>'row', //there will be a div wrapping all items
        'pagerCssClass'=>'whatever',//there will be a div wrapping pager
        'afterAjaxUpdate'=>  JSHelper::ListViewAfterAjaxUpdate(),
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