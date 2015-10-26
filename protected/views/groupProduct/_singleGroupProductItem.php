<?php
/* @var $this GroupProductController */
/* @var $data GroupProduct */
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 itemHover">
        <div class="row">

                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-6">
                        <a href="<?php echo $this->createUrl('groupProduct/view',SeoHelper::groupProductViewSEORouteArrayParam($data))?>" class="thumbnail">
                                <div class="groupProductThumbnail">
                                        <img class="img-responsive lazy" src="<?php echo Yii::app()->request->baseUrl; ?>/img/loader.gif" data-src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo  $data->getFirstImgSrc()?>" alt="post image">
                                </div>
                        </a>
                </div><!-- right thumbnail col -->

                <div class="col-xs-7 col-sm-6 ">
                        <h4 class="textOverflow forceInline" title="<?php echo CHtml::encode($data->title)?>">
                            <b><a href="<?php echo $this->createUrl('groupProduct/view',SeoHelper::groupProductViewSEORouteArrayParam($data))?>">
                                <?php echo CHtml::encode($data->title)?>
                            </a>
                            </b>
                        </h4><!-- title -->
                        <?php $ownedGroup = $data->getOwnedGroup() ?>
                        <p class="textOverflow forceInline">
                            By 組織 <?php echo CHtml::link(CHtml::encode($ownedGroup->group_name), SeoHelper::groupViewSEORouteArray($ownedGroup),array('title'=>CHtml::encode($ownedGroup->group_name)))?>
                        </p><!-- auther -->
                        <h6 class=" clearfix">
                                <small>
                                <?php echo CHtml::encode($data->getCatName()); ?>
                                |
                                <?php echo CHtml::encode($data->popularity); ?> views
                                |
                                <span class="timeago" title="<?php echo CHtml::encode(DTHelper::dtStrToISO8601($data->created_datetime)); ?>"></span> </small>
                        </h6>
                        <ul class="textOverflow tagContainer">
                                <?php $eventTags = $data->getEventLinks();
                                foreach ($eventTags as $tag){
                                    echo '<li>'.$tag.'</li>';
                                }
                                ?>
                        </ul><!-- tag -->

                </div><!-- left col-->

        </div>
</div>
