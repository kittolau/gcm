<?php
/* @var $this IllustController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Illusts',
);
$this->pageTitle = CHtml::encode($tag)." - 個人作品 - ";
?>
<?php $dataProvider = $model->search() ?>
<ol class="breadcrumb">
    <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span> 作品列表</li>
</ol>
<blockquote>
      <h4>搜尋 <span class="label label-info"><?php echo CHtml::encode($tag)?></span> 結果 <span class="label label-default">共 <?php echo $dataProvider->itemCount?> 件作品</span></h4>
</blockquote>


        <?php $form=$this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        )); ?>
            <div class="row">
                    <input type="hidden" value="<?php echo CHtml::encode($tag)?>" name="tag">
                    <?php $this->renderPartial('/site/_BSFilterDropDownListWidget',array(
                        'form'=>$form,
                        'fieldName'=>'illust_category_enum',
                        'model'=>$model,
                    ))?>

                    <?php $this->renderPartial('/site/_BSSortDropDownListWidget',array(
                        'model'=>$model,
                        'form'=>$form,
                        'defaultDesc'=>false
                    ))?>
            </div>
<?php $this->endWidget(); ?>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
        'emptyText'=>'沒有相關作品',
        'enablePagination'=>true,
        'summaryText'=>'共 {count} 作品',
        'template'=>'<div class="pagination pull-right"><h6>{summary}</h6></div>{pager}<div class="clearfix"></div>{items}{pager}',
	'itemView'=>'_singleIllustItem',
        'ajaxUpdate' => true,  // This is it.
        'itemsCssClass'=>'row', //there will be a div wrapping all items
        'pagerCssClass'=>'',//there will be a div wrapping pager
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