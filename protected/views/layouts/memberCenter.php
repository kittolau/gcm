<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<!-- Example row of columns -->
<div class="row">

<!-- search bar -->
<div  class="col-xs-12 col-sm-4 col-md-3 col-lg-3"><!-- z-index:1020; - fix for .pull-right on xs widths-->
    <div class="row">
    <div  class="col-xs-12 col-sm-12 col-md-10  col-md-offset-2 col-lg-9 col-lg-offset-3">
        <div  class="list-group panel panel-primary menuPanel">
                <div class="panel-heading list-group-item text-center hidden-xs">
                        <h4>
                                <span class="pull-left">會員中心</span>
                                <span class="glyphicon glyphicon-user pull-right"></span>
                                <span class="clearfix"></span>
                        </h4>
                </div><!-- menu header -->

                <?php $this->widget('zii.widgets.CMenu',array(
                                        'encodeLabel'=>true,
                                        'items'=>array(
                                            array('label'=>'販賣情報 ', 'itemOptions'=>array('class'=>''),'url'=>array('memberCenter/createGroupProduct','mode'=>  GroupProduct::BOOK),'template'=>'{menu}','visible'=>!Yii::app()->user->isGuest),
                                            array('label'=>'創作投稿 ', 'itemOptions'=>array('class'=>''),'url'=>array('/memberCenter/createIllust','mode'=>  Illust::ILLUST),'template'=>'{menu}','visible'=>!Yii::app()->user->isGuest,'active'=>($this->action->id=='createIllust')),
                                            array('label'=>'作品管理 ', 'itemOptions'=>array('class'=>''),'url'=>array('memberCenter/manageIllust'),'template'=>'{menu}','visible'=>!Yii::app()->user->isGuest),
                                            array('label'=>'組織管理 ', 'itemOptions'=>array('class'=>''),'url'=>array('memberCenter/manageGroup'),'template'=>'{menu}','visible'=>!Yii::app()->user->isGuest),
                                            array('label'=>'查看喜愛作者 ', 'itemOptions'=>array('class'=>''),'url'=>array('memberCenter/followingAuthor'),'template'=>'{menu}','visible'=>!Yii::app()->user->isGuest),
                                            array('label'=>'查看喜愛組織 ', 'itemOptions'=>array('class'=>''),'url'=>array('memberCenter/followingGroup'),'template'=>'{menu}','visible'=>!Yii::app()->user->isGuest),
                                            array('label'=>'查看書籤 ', 'itemOptions'=>array('class'=>''),'url'=>array('memberCenter/bookmark'),'template'=>'{menu}','visible'=>!Yii::app()->user->isGuest),
                                        ),
                                        'htmlOptions'=>array('id'=>'cat-navi'), //the css class of the ul
                                        'itemCssClass'=>'',//the css class of the li
                                        'activeCssClass'=>'active'
                )); ?>
                <script type="text/javascript">
                <?php // workaround for the above html structure?>
                //$(function(){
                        var menuItemUL=$('#cat-navi');

                        var bsActiveClass = "active";
                        $('li',menuItemUL).each(function(){
                                var isContainActive = $(this).hasClass(bsActiveClass);
                                if(isContainActive){
                                        $('a',$(this)).addClass(bsActiveClass);
                                }
                        });

                        var linkClass="list-group-item hidden-xs";

                        $('li',menuItemUL).each(function(){
                            $('a',$(this)).addClass(linkClass);
                        });
                //});
                </script>

                <div class="panel-footer">
                    <!--
                        <div class="row">

                                <div class="col-xs-6 col-sm-12 col-md-6 col-lg-6 text-left">
                                        <a class="btn btn-link btn-sm btn-block" href="#"><i class="icon-list-alt"></i>  View all categories</a>
                                </div>

                                <div class="col-xs-6 col-sm-12 col-md-6 col-lg-6 text-left">
                                        <a class="btn btn-link btn-sm btn-block" href="#"><i class="icon-sitemap"></i> View sitemap</a>
                                </div>

                        </div>
                    -->
                </div><!-- menu footer -->
        </div><!-- menu panel-->
        </div>
        </div>
</div><!-- SIDE BAR END -->

<!-- CONTENT SIDE-->
<div class="col-sm-9 col-lg-8">
<?php echo $content; ?>

</div>
</div>

<?php $this->endContent(); ?>
