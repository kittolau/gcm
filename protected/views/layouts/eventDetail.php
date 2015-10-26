<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php $this->beginContent('//layouts/main'); ?>
<?php $model = $this->eventDetail_model; ?>
<div  class="col-xs-12 col-sm-4 col-md-3 col-lg-3"><!-- z-index:1020; - fix for .pull-right on xs widths-->
    <img class="img-responsive lazy horizontalCenter" src="/img/loader.gif" data-src="/<?php echo CHtml::encode($model->icon_thumbnail_src); ?>" alt="post image">
    <br>
    
    <div class="side-menu-wrapper horizontalCenter">
        <?php echo CHtml::link(CHtml::encode("返回活動頁面"), array('/event/view','id'=>$model->id),array("class"=>'btn btn-primary btn-block')); ?>
        <br>
        <strong>日期： </strong> <?php echo CHtml::encode($model->event_date); ?>
        <br>
        <strong>時間： </strong> <?php echo CHtml::encode($model->event_time_interval); ?>
        <br>
        <strong>制品： </strong> <?php echo CHtml::encode($model->GroupProductsCount); ?> 件
        <br>
        <strong>組織： </strong> <?php echo count($model->JoinedGroups); ?> 檔
    </div>

</div><!-- SIDE BAR END -->


	  
<!-- CONTENT SIDE-->
<div class="col-sm-9 col-lg-8">
    <?php echo $content; ?>
</div>

<?php $this->endContent(); ?>