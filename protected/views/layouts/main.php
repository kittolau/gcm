<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- google map api -->
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.ico">

    <!-- css -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-switch.min.css" rel="stylesheet">
    <!--<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-tags.css" rel="stylesheet">-->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.pnotify.default.css" media="all" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.pnotify.default.icons.css" media="all" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/magic-bootstrap-min.css" media="all" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" media="all" rel="stylesheet">
      <!-- Le styles -->
    <!-- GOOGLE FONT-->
    <!--<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700italic,700,500&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- /GOOGLE FONT-->
    <!--<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">

    <!-- JS -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.10.1.min.js"></script>

    <title>

        <?php
    //yii will also render the jquery used by the form validation which may collide with the included jquery, so i placed this here
    echo CHtml::encode($this->pageTitle);

    ?></title>

    <meta property="og:title" content="<?php echo CHtml::encode($this->openGraphTitle); ?>">
    <meta property="og:description" content="<?php echo CHtml::encode($this->openGraphDescription); ?>">
    <meta property="og:type" content="<?php echo CHtml::encode($this->openGraphType); ?>">
    <meta property="og:url" content="<?php echo CHtml::encode($this->openGraphURL); ?>">
    <meta property="fb:app_id" content="1402899746652982"/>
    <?php
    /*
     * article:publisher
     *
     * This property links to the publisher of the article. The target of this property must be a Facebook Page. When displayed in the News Feed, Facebook may offer the ability to like the publisher.
     */
    ?>
    <?php
    /*
     * article:publisher
     *
     * This property links to the publisher of the article. The target of this property must be a Facebook Page. When displayed in the News Feed, Facebook may offer the ability to like the publisher.
     */
    ?>
    <!--<meta property="og:locale" content="en_US">-->
    <meta property="og:site_name" content="<?php echo CHtml::encode($this->openGraphSiteName); ?>">
    <?php if($this->openGraphType =='article'){?>

        <?php foreach($this->openGraphImageArray as $img_src){ ?>
          <meta property="og:image" content="<?php echo CHtml::encode($img_src); ?>">
        <?php } ?>
        <meta property="article:published_time" content="<?php echo CHtml::encode($this->openGraphArticlePublishedTime); ?>">
        <?php //<meta property="article:author" content=" echo CHtml::encode($this->openGraphArticleAuthor); ">    ?>
        <meta property="article:section" content="<?php echo CHtml::encode($this->openGraphArticleSection); ?>">
            <?php foreach($this->openGraphArticleTagArray as $tag_){ ?>
          <meta property="article:tag" content="<?php echo CHtml::encode($tag_); ?>">
        <?php } ?>
    <?php }else{ ?>
        <meta property="og:image" content="<?php echo CHtml::encode($this->openGraphImage); ?>">
    <?php } ?>

</head>

<body>
    <div id="fb-root"></div>
    <script>

    window.fbAsyncInit = function() {
        FB.init({appId: '1402899746652982', status: true, cookie: true,
                 xfbml: true});
  };

    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<!-- header -->
<header>

	  <div class="container">
		<div class="row">
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo/mainlogo.png" class="mainLogo">
			</div>

			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<?php $this->widget('zii.widgets.CMenu',array(
                                        'encodeLabel'=>false,
                                        'items'=>array(
                                            array('label'=>'<i class="glyphicon glyphicon-registration-mark"></i> 建立新帳戶 ', 'itemOptions'=>array('title'=>'建立新帳戶'),'url'=>array('site/register'),'template'=>'{menu}','visible'=>Yii::app()->user->isGuest),
                                            array('label'=>'<i class="glyphicon glyphicon-log-in"></i> 登入 ', 'itemOptions'=>array('title'=>'登入'),'url'=>array('/site/login'),'template'=>'{menu}','visible'=>Yii::app()->user->isGuest),
                                            array('label'=>'<i class="glyphicon glyphicon-user"></i> '.Yii::app()->user->name, 'itemOptions'=>array('title'=>'檢視自己的主頁'),'url'=>array('user/view','id'=>Yii::app()->user->id),'template'=>'{menu}','visible'=>!Yii::app()->user->isGuest),
                                            array('label'=>'<i class="glyphicon glyphicon-log-out"></i> Logout</a>', 'itemOptions'=>array('title'=>'登出'),'url'=>array('/site/logout'),'template'=>'{menu}','visible'=>!Yii::app()->user->isGuest)
                                        ),
                                        'htmlOptions'=>array('class'=>'nav navbar-nav loginWidget navbar-right'), //the css class of the ul
                                        'itemCssClass'=>'',//the css class of the li
                                        'activeCssClass'=>''
                        )); ?>
			</div>
		</div>

	  </div>


	<nav class="navbar navbar-default mainNavbar" role="navigation">
		<div class="container">
	  <!-- Brand and toggle get grouped for better mobile display -->
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
	  </div>

	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse navbar-ex1-collapse">
              <?php
              $this->widget('zii.widgets.CMenu',array(
				'encodeLabel'=>false,
				'items'=>array(
                                    array('label'=>'<span class="glyphicon glyphicon-home"></span>首頁', 'itemOptions'=>array('class'=>''),'url'=>array('site/index'),'template'=>'{menu}'),
                                    array('label'=>'<span class="glyphicon glyphicon-user"></span> 會員中心', 'itemOptions'=>array('class'=>''),'url'=>array('memberCenter/index'),'template'=>'{menu}','active'=>($this->id=='memberCenter'),'visible'=>!Yii::app()->user->isGuest),
                                    array('label'=>'<span class="glyphicon glyphicon-info-sign"></span> 場次', 'itemOptions'=>array('class'=>''),'url'=>array('event/index'),'template'=>'{menu}'),
                                    array('label'=>'<span class="glyphicon glyphicon-usd"></span> 販賣情報', 'itemOptions'=>array('class'=>''),'url'=>array('groupProduct/index'),'template'=>'{menu}'),
                                    array('label'=>'<span class="glyphicon glyphicon-star"></span> 個人作品', 'itemOptions'=>array('class'=>''),'url'=>array('illust/index'),'template'=>'{menu}'),
                                    array('label'=>'<span class="glyphicon glyphicon-tower"></span> 組織', 'itemOptions'=>array('class'=>''),'url'=>array('group/index'),'template'=>'{menu}'),
                                ),
				'htmlOptions'=>array('class'=>'nav navbar-nav'), //the css class of the ul
				'itemCssClass'=>'',//the css class of the li
                                'activeCssClass'=>'active'
				));
              ?>
		<ul class="nav navbar-nav pull-right" style="width: 400px; padding-top: 6px;">
                    <li>
                        <form id="searchTag" role="search" action="groupProduct/search"">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">搜尋<span id="searchForName">販品tag</span> <span class="caret"></span></button>

                                <ul class="dropdown-menu">

                                  <li><a href="#" data-action="groupProduct" >販品tag</a></li>
                                  <li><a href="#" data-action="groupProduct" >誌tag</a></li>
                                  <li><a href="#" data-action="groupProduct" >精品tag</a></li>
                                  <!--<li class="divider"></li>-->
                                  <li><a href="#" data-action="illust" >創作tag</a></li>
                                  <li><a href="#" data-action="illust" >插畫tag</a></li>
                                  <li><a href="#" data-action="illust" >網漫tag</a></li>
                                </ul>
                              </div><!-- /btn-group -->
                              <script>

                                  $(function(){
                                    var curentSearchBtn = $('#searchForName');

                                    $('.dropdown-menu li a').click(function(){
                                        var action = $(this).data("action");
                                        var actionName = $(this).text();

                                        curentSearchBtn.text(actionName);
                                        $("#searchTag").attr("action", ""+action+"/search");
                                    });

                                  });

                              </script>
                            <input type="text" class="form-control" placeholder="" name="tag" id="srch-term">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search" style="font-size: 20px"></i></button>
                            </div>
                        </div>
                        </form>
                    </li>


                </ul>

	</div><!-- /.navbar-collapse -->
	</div>
</nav>
</header>
<!-- /header -->

<div class="container  min-height">
	<?php echo $content; ?>
</div>

<!-- FOOTER-->
<footer>
<div class="container">
 <div class="row">

     <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
        <?php $this->Widget('FBLikeBoxWidget',array())?>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
        <h4 class="line3 center standart-h4title"><span>站內連結</span></h4>
        <ul class="footer-links">
          <li><a href="site/index">首頁</a></li>
          <li><a href="event/index">場次</a></li>
          <li><a href="groupProduct/index">販賣情報</a></li>
          <li><a href="illust/index">最新作品</a></li>
          <li><a href="group/index">組織</a></li>
        </ul>
      </div>

    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
        <h4 class="line3 center standart-h4title"><span>相關資訊</span></h4>
        <ul class="footer-links">
         <li><?php echo CHtml::link(CHtml::encode('關於我們'),array('site/aboutus')) ?></li>
          <li><?php echo CHtml::link(CHtml::encode('更新及維護紀錄'),array('site/UpdateLog')) ?></li>
          <li><?php echo CHtml::link(CHtml::encode('服務條款'),array('site/Term')) ?></li>
         <li><?php echo CHtml::link(CHtml::encode('連絡我們'),array('site/ContactUS')) ?></li>
        </ul>
    </div>

 <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
        <h4 class="line3 center standart-h4title"><span>協力機構/組織</span></h4>
        <ul class="footer-links">
         <li>活動提供 <a href="http://play.google.com/store/apps/details?id=com.kkk.doujinshi&hl=zh-HK">情報App</a></li>
        </ul>
    </div>




</div>
 <hr>

  </div><!-- CONTAINER FOOTER-->
</footer>
  </body>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.pnotify.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-switch.min.js"></script>
    <script src="<?php echo  /* put here becase there may be some collision with yii jquery*/Yii::app()->request->baseUrl; ?>/js/bootstrap-tagsinput.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.timeago.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.unveil.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
    <script>
/***************************************************
responsive menu
***************************************************/

jQuery(function (jQuery) {
    jQuery("#cat-navi").append("<select/>");
	jQuery("#cat-navi select").addClass("form-control");
    jQuery("<option />", {
        "selected": "selected",
        "value": "",
        "text": "Choose category"
    }).appendTo("#cat-navi select");
    //new dropdown menu
    jQuery("#cat-navi a").each(function () {
        var el = jQuery(this);
        var perfix = '';
        switch (el.parents().length) {
            case (11):
                perfix = '-';
                break;
            case (13):
                perfix = '--';
                break;
            default:
                perfix = '';
                break;

        }

        jQuery("<option />", {
            "value": el.attr("href"),
            "text": perfix + el.text()
        }).appendTo("#cat-navi select");
    });

    jQuery('#cat-navi select').change(function () {

        window.location.href = this.value;

    });
});

</script>

<script>
//hide menu after click on mobile
jQuery('.navbar .nav > li > a').click(function(){
		jQuery('.navbar-collapse.navbar-ex1-collapse.in').removeClass('in').addClass('collapse').css('height', '0');

		});
</script>
<script>
//hide menu after click on mobile
$(function() {
  $("span.timeago").timeago();
});
</script>
<script>
    $(function(){
    $('[rel="tooltip"]').tooltip();
	});
</script>
<script>
$(document).ready(function() {
  $("img.lazy").unveil();
});
</script>
<script>
$('.confirm-on-click').each(function (index, element) {
            $(element).click(function (e) {
                var r = confirm("確定要繼續?");
                if (r == false) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
        });
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49351713-1', 'graphic_site.net');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>
    <script type="text/javascript">
function show_stack_topleft(type,Title,Text) {


    var opts = {
        //title: Title,
        text: Text,
        addclass: "stack-topleft",
        //addclass: 'custom-flash-msg',
        styling: "bootstrap",
        history: false,
        opacity: .8,
        nonblock: true,
        nonblock_opacity: .2
    };




    switch (type) {
    case 'error':
        opts.type = "error";
        break;
    case 'info':
        opts.type = "info";
        break;
    case 'success':
        opts.type = "success";
        break;
    case 'notice':
        opts.type = "notice";
        break;
    }

    $.pnotify(opts);
}

$(function(){
     <?php

     function getFlash($name){
         return Yii::app()->user->getFlash($name);
     }

     $jsFunc = "show_stack_topleft('%s','%s' ,'%s' );";
     if(Yii::app()->user->hasFlash(FlashMsg::SUCCESS)){
            echo sprintf ($jsFunc,'success',FlashMsg::SUCCESS_TITLE,getFlash(FlashMsg::SUCCESS));
    }
    if(Yii::app()->user->hasFlash(FlashMsg::ERROR)){
            echo sprintf ($jsFunc,'error',FlashMsg::ERROR_TITLE,getFlash(FlashMsg::ERROR));
    }
    if(Yii::app()->user->hasFlash(FlashMsg::WARNING)){
            echo sprintf ($jsFunc,'notice',FlashMsg::WARNING_TITLE,getFlash(FlashMsg::WARNING));
    }
    if(Yii::app()->user->hasFlash(FlashMsg::INFO)){
            echo sprintf ($jsFunc,'info',FlashMsg::INFO_TITLE,getFlash(FlashMsg::INFO));
    }
    ?>
});
</script>
</html>
