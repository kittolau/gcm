
<li>
    
    <span class=" textOverflow forceInline" title="<?php echo CHtml::encode($data->title); ?>">

                <a href="<?php echo $this->createUrl('event/view',SeoHelper::eventViewSEORouteArrayParam($data))?>">
                    <?php echo CHtml::encode($data->title); ?>
            </a>
        </span><!-- title -->
        <span class="pull-right"><?php echo CHtml::encode($data->event_date); ?></span>
        <span class="clearfix"></span>
        
</li>
<hr class="list-item-hr">