<?php
/* @var $this MemberCenterController */

$this->breadcrumbs=array(
	'Member Center',
);
$this->pageTitle = "會員中心 - ";
?>
<ol class="breadcrumb">
    <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span>個人資料</li>
</ol>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="row">
                <div class="col-xs-4 col-sm-5 col-md-4 col-lg-6">
    

                                        <img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $model->icon_src?>" alt="post image">

                
                </div><!-- right thumbnail col -->

                <div class="col-xs-8 col-sm-6 ">
                        <h4 class=" textOverflow forceInline" title="<?php echo $model->nickname ?>">
                                <?php echo $model->nickname ?>
                        </h4><!-- title -->

                        <p class="textOverflow forceInline">
                                <?php echo $model->id ?>
                        </p><!-- auther -->
                        
                        <p class="textOverflow forceInline">
                            <?php echo CHtml::link("更新個人資料", array('memberCenter/updateUser')); ?>
                        </p><!-- user Update -->
                        
                        <p class="textOverflow forceInline">
                            <?php echo CHtml::link("更新登入密碼", array('site/ChangePassword')); ?>
                        </p>
                </div><!-- left col-->
        </div>
</div>
</div>