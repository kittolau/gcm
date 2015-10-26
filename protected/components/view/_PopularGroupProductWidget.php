
<div class="list-group panel panel-default userBelongGroupPanel">
            <div class="panel-heading list-group-item text-center hidden-xs">
                    <h4>
                            <span class="pull-left">最受歡迎販賣品</span> 
                            <span class="clearfix"></span>
                    </h4>
            </div><!-- header -->

            <ul class="list-group">
                <?php $mostPopularIllust = $mostPopularNonR18GroupProduct; 
                    foreach($mostPopularIllust as $illust ){
                        
                        $illustURL = Yii::app()->createUrl('groupProduct/view',  SeoHelper::groupProductViewSEORouteArrayParam($illust));
                ?>
                <a href="<?php echo $illustURL?>" class="list-group-item">
                        <div class="media">
                                <div class="pull-left" rel="tooltip" title="<?php echo CHtml::encode($illust->title)?>" href="<?php echo $illustURL?>" data-original-title="<?php echo CHtml::encode($illust->title)?>">
                                        <div style="height:60px;width:60px;">
                                                <img class="img-responsive lazy" src="<?php echo Yii::app()->request->baseUrl; ?>/img/loader.gif" data-src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $illust->getFirstImgSrc() ?>" alt="post image">
                                        </div>
                                </div>
                                <div class="media-body">
                                        <p class="pull-left" rel="tooltip" title="<?php echo CHtml::encode($illust->title)?>" href="<?php echo $illustURL?>" data-original-title="<?php echo CHtml::encode($illust->title)?>">
                                                <h4 class=" textOverflow forceInline" title="<?php echo CHtml::encode($illust->title)?>">
                                                    <?php echo CHtml::encode($illust->title)?>
                                                </h4>
                                        </p>
                                </div>

                        </div>
                    </a>
                    <?php } ?>
                
                    
            </ul>

            <div class="panel-footer">
                    
            </div>
    </div>