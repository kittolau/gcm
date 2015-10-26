<?php
/* @var $this IllustController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Illusts',
);
$this->pageTitle = "組織 - ";
?>

<ol class="breadcrumb">
    <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span> 組織列表</li>
</ol>

        <?php $form=$this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        )); ?>
						<div class="row">
							<?php $this->renderPartial('/site/_BSSortDropDownListWidget',array(
                                                            'model'=>$model,
                                                            'form'=>$form,
                                                            'defaultDesc'=>true
                                                        ))?>

                                                        <?php $this->renderPartial('/site/_BSSortRevertWidget',array(
                                                            'model'=>$model,
                                                            'defaultDesc'=>true
                                                        ))?>
						</div>


<?php $this->endWidget(); ?>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->ShowOnlyApprovedGroup()->search(),
        'emptyText'=>'沒有相關組織',
        'enablePagination'=>true,
        'summaryText'=>'共 {count} 組織',
        'template'=>'<div class="pagination pull-right"><h6>{summary}</h6></div>{pager}<div class="clearfix"></div>{items}{pager}',
	'itemView'=>'_singleGroupItem',
        'ajaxUpdate' => true,  // This is it.
        'afterAjaxUpdate'=>JSHelper::ListViewAfterAjaxUpdate(),
        'id'=>'mainlistview',
        'itemsCssClass'=>'row', //there will be a div wrapping all items
        //NOTICE!!, you MUST have a pager css class !='' , if you want ajax update, since it will generate a jquery select of something like #yw1 .<pageCssClass>, it class is empty, then it will have error
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
