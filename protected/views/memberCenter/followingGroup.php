<?php
$this->pageTitle = "喜愛的組織 - 會員中心 - ";
?>

<ol class="breadcrumb">
    <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span> 喜愛的組織列表</li>
</ol>
        <?php $form=$this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        )); ?>
						<div class="row">
							<?php $this->renderPartial('/site/_BSFilterDropDownListWidget',array(
                                                            'form'=>$form,
                                                            'fieldName'=>'product_catagory_enum',
                                                            'model'=>$model,
                                                        ))?>

                                                        <?php $this->renderPartial('/site/_BSFilterDropDownListWidget',array(
                                                            'form'=>$form,
                                                            'fieldName'=>'event_id',
                                                            'model'=>$model,
                                                        ))?>

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
	'dataProvider'=>$model->showOnlyFollowingGroup($user->getFollowingGroupsIdArr())->search(),
        'emptyText'=>'沒有相關作品',
        'enablePagination'=>true,
        'summaryText'=>'共 {count} 作品',
        'template'=>'<div class="pagination pull-right"><h6>{summary}</h6></div>{pager}<div class="clearfix"></div>{items}{pager}',
	'itemView'=>'application.views.groupProduct._singleGroupProductItem',
        'ajaxUpdate' => true,  // This is it.
        'afterAjaxUpdate'=>  JSHelper::ListViewAfterAjaxUpdate(),
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
