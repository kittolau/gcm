<?php
/* @var $this EventController */
/* @var $model Event */
$this->pageTitle = CHtml::encode($model->title)." - 活動場次 - ";
?>

<!-- Example row of columns -->
<!-- search bar -->
<div class="row">
    <div  class="col-xs-1"><!-- z-index:1020; - fix for .pull-right on xs widths-->
    </div><!-- SIDE BAR END -->
    <div  class="col-xs-6 col-xs-offset-2"><!-- z-index:1020; - fix for .pull-right on xs widths-->
        <h1><span class="label label-warning"><?php echo CHtml::encode($model->title)?></span></h1>
    </div><!-- SIDE BAR END -->
</div>
<br>

<div class="row">



<div  class="col-xs-12 col-sm-4 col-md-3 col-lg-3"><!-- z-index:1020; - fix for .pull-right on xs widths-->
    <img class="img-responsive lazy horizontalCenter" src="/img/loader.gif" data-src="/<?php echo CHtml::encode($model->icon_thumbnail_src); ?>" alt="post image">
    <br>

    <div class="side-menu-wrapper horizontalCenter">
        <?php echo CHtml::link(CHtml::encode("活動制品一覽"), array('/event/EventGroupProduct','id'=>$model->id),array("class"=>'btn btn-primary btn-block')); ?>
        <?php echo CHtml::link(CHtml::encode("活動參與組織"), array('/event/EventGroup','id'=>$model->id),array("class"=>'btn btn-primary btn-block')); ?>

        <?php if($model->is_product_upload_allowed){ ?>
        <H5><b>首發作品至本場次<b></H5>
        <?php echo CHtml::link(CHtml::encode("上傳誌情報"), array('/memberCenter/createGroupProduct','mode'=>'1','preselected_event_id'=>$model->id),array("class"=>'btn btn-primary btn-block')); ?>
        <?php echo CHtml::link(CHtml::encode("上傳精品情報"), array('/memberCenter/createGroupProduct','mode'=>'2','preselected_event_id'=>$model->id),array("class"=>'btn btn-primary btn-block')); ?>

        <?php } ?>
    </div>

</div><!-- SIDE BAR END -->



<!-- CONTENT SIDE-->
<div class="col-sm-9 col-lg-8">

    <div class="row" style="position:relative;">
        <div style="position:absolute; bottom: 15px; right: 15px; width: 150px;">
            <?php if(!(empty($model->apply_form_url) || trim($model->apply_form_url)==='')){?>
                <a class="btn btn-primary btn-block" href="<?php echo CHtml::encode($model->apply_form_url) ?>">申請表格</a>
            <?php }?>
            <?php if(!(empty($model->official_website_url) || trim($model->official_website_url)==='')){?>
                <a class="btn btn-primary btn-block" href="<?php echo CHtml::encode($model->official_website_url) ?>">官方網站</a>
            <?php }?>
        </div>
    <div class="col-xs-12">
		<?php if($model->lat_lng !=""){?>
		<!-- google map api -->

		 <style type="text/css">
		  #map-canvas { height: 300px;
                    width:100%;
		  }
		</style>
		<script type="text/javascript"
		  src="https://maps.googleapis.com/maps/api/js?&sensor=true">
		</script>
		<script type="text/javascript">
		  function initialize() {
			var mapOptions = {
			  center: new google.maps.LatLng(<?php echo CHtml::encode($model->lat_lng)?>),
			  zoom: 16
			};
			var map = new google.maps.Map(document.getElementById("map-canvas"),
				mapOptions);

			var myCenter=new google.maps.LatLng(<?php echo CHtml::encode($model->lat_lng)?>);

			  marker=new google.maps.Marker({
					  position:myCenter,
					  animation:google.maps.Animation.DROP
					  //icon:'pinkball.png'
					  });

			  marker.setMap(map);

			google.maps.event.addListener(marker, 'click', toggleBounce);

			function toggleBounce() {

			  var infowindow = new google.maps.InfoWindow({
				content: ''
			  });
			  infowindow.open(map,marker);
			  }

		  }



		  google.maps.event.addDomListener(window, 'load', initialize);
		</script>

		<div id="map-canvas"> </div>
		<br>
		<!--/ google map api -->
                <?php }?>
    </div>
    <div class="col-xs-12">
        <h3>
        <?php if($model->is_doujin){?>
            <span class="label label-warning">誌</span>
        <?php }?>
        <?php if($model->is_cosplay){?>
            <span class="label label-warning">Cosplay</span>
        <?php }?>
        <?php if($model->is_stage){?>
            <span class="label label-warning">舞台表演</span>
        <?php }?>
            </h3>
    </div>

    <div class="col-xs-6 text-size-small">
        <table class="table table-hover">
                    <tr>
                        <td>制品</td>
                        <td><?php echo CHtml::encode($model->GroupProductsCount); ?> 件</td>
                    </tr>
                    <tr>
                        <td>活動日期</td>
                        <td><?php echo CHtml::encode($model->event_date)?></td>
                    </tr>
                    <tr >
                        <td>門票</td>
                        <td><?php echo StringHelper::ConvertNewlineToBRwithHTMLEncode($model->ticket_price)?></td>
                    </tr>
                    <tr >
                        <td>申請期</td>
                        <td><?php echo StringHelper::ConvertNewlineToBRwithHTMLEncode($model->apply_date)?></td>
                    </tr>
                    <tr >
                        <td>場租</td>
                        <td><?php echo StringHelper::ConvertNewlineToBRwithHTMLEncode($model->place_rent)?></td>
                    </tr>
                    <tr >
                        <td>活動地點</td>
                        <td><?php echo StringHelper::ConvertNewlineToBRwithHTMLEncode($model->event_place_title)?></td>
                    </tr>
            </table>
    </div>

    <div class="col-xs-6 text-size-small">
                <table class="table table-hover">
                    <tr>
                        <td>組織</td>

                        <td><?php echo count($model->JoinedGroups); ?> 檔</td>
                    </tr>
                    <tr>
                        <td>活動開放時間</td>

                        <td><?php echo StringHelper::ConvertNewlineToBRwithHTMLEncode($model->event_time_interval)?></td>
                    </tr>
                </table>

    </div>

</div>



<ol class="breadcrumb">
        <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span> 參展組織及其制品宣傳</li>
</ol>
       <?php $form=$this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        )); ?>
						<div class="row">
                                                        <input type="hidden" name="id" value="<?php echo CHtml::encode($model->id)?>">
                                                        <input type="hidden" name="event_id" value="<?php echo CHtml::encode($model->id)?>">
							<?php $this->renderPartial('/site/_BSFilterDropDownListWidget',array(
                                                            'form'=>$form,
                                                            'fieldName'=>'product_catagory_enum',
                                                            'model'=>$GroupProductModel,
                                                        ))?>

							<?php $this->renderPartial('/site/_BSSortDropDownListWidget',array(
                                                            'model'=>$model,
                                                            'form'=>$GroupProductModel,
                                                            'defaultDesc'=>false
                                                        ))?>
						</div>
<?php $this->endWidget(); ?>

<?php $GroupProductModel->event_id = $model->id ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$viewData,
        'emptyText'=>'沒有相關作品',
        'enablePagination'=>true,
        'summaryText'=>'共 {count} 作品',
        'template'=>'<div class="pagination pull-right"><h6>{summary}</h6></div>{pager}<div class="clearfix"></div>{items}{pager}',
	'itemView'=>'application.views.groupProduct._singleGroupProductItem',
        'afterAjaxUpdate'=>  JSHelper::ListViewAfterAjaxUpdate(),
        'ajaxUpdate' => true,  // This is it.
        'itemsCssClass'=>'row', //there will be a div wrapping all items
        'pagerCssClass'=>'whatever',//there will be a div wrapping pager
        //'updateSelector'=>'.pagination li a',
        'pager'=>array(
							'maxButtonCount'=>5,
							'cssFile'=>null,
							'pageSize' => 10,
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


</div>
</div>


