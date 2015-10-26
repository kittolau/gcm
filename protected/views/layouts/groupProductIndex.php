<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<!-- Example row of columns -->
<div class="row">

<!-- search bar -->
<div  class="col-xs-12 col-sm-4 col-md-3 col-lg-3"><!-- z-index:1020; - fix for .pull-right on xs widths-->
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo CHtml::link(CHtml::encode("投稿販賣情報"), array('memberCenter/createGroupProduct','mode'=>  GroupProduct::BOOK),array("class"=>'btn btn-primary btn-block')); ?>
        </div>
    </div>
    
<?php $this->Widget('PopularGroupProductWidget',array())?>

</div><!-- SIDE BAR END -->
	  
<!-- CONTENT SIDE-->
<div class="col-sm-9 col-lg-8">
 
<?php echo $content; ?>

</div>
</div>

<?php $this->endContent(); ?>