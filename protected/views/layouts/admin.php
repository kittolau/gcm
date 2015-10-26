<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<!-- Example row of columns -->
<div class="row">

<!-- search bar -->
<div  class="col-xs-12 col-sm-4 col-md-3 col-lg-3"><!-- z-index:1020; - fix for .pull-right on xs widths-->
<?php $this->widget('zii.widgets.CMenu',array(
                                        'encodeLabel'=>false,
                                        'items'=>array(
                                            array('label'=>'<i class="glyphicon glyphicon-info-sign"></i> 活動 ', 'itemOptions'=>array('title'=>'活動'),'url'=>array('event/admin'),'template'=>'{menu}'),
                                            array('label'=>'<i class="glyphicon glyphicon-info-sign"></i> 新活動 ', 'itemOptions'=>array('title'=>'新活動'),'url'=>array('event/create'),'template'=>'{menu}'),
                                            array('label'=>'<i class="glyphicon glyphicon-tower"></i> 組織 ', 'itemOptions'=>array('title'=>'組織'),'url'=>array('group/admin'),'template'=>'{menu}'),
                                            array('label'=>'<i class="glyphicon glyphicon-usd"></i> 販賣情報', 'itemOptions'=>array('title'=>'販賣情報'),'url'=>array('groupProduct/admin'),'template'=>'{menu}'),
                                            array('label'=>'<i class="glyphicon glyphicon-star"></i> 個人作品', 'itemOptions'=>array('title'=>'個人作品'),'url'=>array('illust/admin'),'template'=>'{menu}'),
                                            array('label'=>'<i class="glyphicon glyphicon-user"></i> 使用者', 'itemOptions'=>array('title'=>'使用者'),'url'=>array('user/admin'),'template'=>'{menu}'),
                                            array('label'=>'<i class="glyphicon glyphicon-user"></i> 重置使用者登入密碼', 'itemOptions'=>array('title'=>'重置使用者登入密碼'),'url'=>array('site/forgetPassword'),'template'=>'{menu}')
                                        ),
                                        'htmlOptions'=>array('class'=>'nav nav-pills nav-stacked'), //the css class of the ul
                                        'itemCssClass'=>'',//the css class of the li
                                        'activeCssClass'=>''
                        )); ?>
</div><!-- SIDE BAR END -->
	  
<!-- CONTENT SIDE-->
<div class="col-sm-9 col-lg-8">
 
<?php echo $content; ?>

</div>
</div>

<?php $this->endContent(); ?>