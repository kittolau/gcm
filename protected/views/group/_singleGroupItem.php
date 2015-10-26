<?php
/* @var $this GroupController */
/* @var $data Group */
?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 itemHover">
        <div class="row">

                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-6">
                    <a href="<?php echo Yii::app()->createUrl('group/view', SeoHelper::groupViewSEORouteArrayParam($data))?>" class="thumbnail">
                                <div class="groupThumbnail">
                                        <img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $data->icon_src?>" alt="post image">
                                </div>
                        </a>
                </div><!-- right thumbnail col -->

                <div class="col-xs-7 col-sm-6 ">
                        <h4 class="textOverflow forceInline" title="<?php echo CHtml::encode($data->group_name) ?>">
                            <b><?php echo CHtml::link(CHtml::encode($data->group_name), SeoHelper::groupViewSEORouteArray($data)); ?></b>
                        </h4><!-- title -->

                        <p class="clearfix textOverflow forceInline">
                        成立日期：<?php echo CHtml::encode($data->created_datetime) ?><br>
                        <?php $latestGroupProduct = $data->getLatestGroupProduct() ?>
                        
                        最新作品： <?php echo CHtml::link(CHtml::encode($latestGroupProduct->title), SeoHelper::groupProductViewSEORouteArray($latestGroupProduct)); ?><br>
                        <?php $leaders = $data->getLeaders()?>
                        主要成員： 
                        <?php 
                        foreach($leaders as $uesr){
                            echo CHtml::link(CHtml::encode($uesr->nickname), SeoHelper::userViewSEORouteArray($uesr));
                        }
                        ?>
                        <br>
                        公式網站： <a href="<?php echo CHtml::encode($data->website_url)?>" title="<?php echo CHtml::encode($data->website_url)?>"> <?php echo CHtml::encode($data->website_url)?></a><br>
                        </p><!-- group info -->

                        <!-- max 3 tag -->
                        <p class="textOverflow">
     
                        </p><!-- event tag -->
                </div><!-- left col-->

        </div>
</div>