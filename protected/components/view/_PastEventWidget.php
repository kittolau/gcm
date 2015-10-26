
<div class="list-group panel panel-default userBelongGroupPanel">
            <div class="panel-heading list-group-item text-center hidden-xs">
                    <h4>
                            <span class="pull-left">過去活動</span> 
                            <span class="clearfix"></span>
                    </h4>
            </div><!-- header -->

            <ul class="list-group">
                <?php 
                    foreach($allPastEvents as $event ){
                        
                        $illustURL = Yii::app()->createUrl('event/view',  SeoHelper::eventViewSEORouteArrayParam($event));
                ?>
                <a href="<?php echo $illustURL?>" class="list-group-item">
                        <div class="media">
                                <div class="media-body">
                                        <p class="pull-left" rel="tooltip" title="<?php echo CHtml::encode($event->title)?>" href="<?php echo $illustURL?>" data-original-title="<?php echo CHtml::encode($event->title)?>">
                                            
                                                <h3 class="" title="<?php echo CHtml::encode($event->title)?>">

                                                    <?php echo CHtml::encode($event->title)?>
                                                        </span>
                                                </h3>
                                                
                                        </p>
                                        <small class="pull-left">地點：<?php echo CHtml::encode($event->event_place_title)?></small>
                                         <small class="pull-right"><?php echo CHtml::encode($event->event_date)?></small>
                                </div>

                        </div>
                    </a>
                    <?php } ?>
                
                    
            </ul>

            <div class="panel-footer">
                    
            </div>
    </div>