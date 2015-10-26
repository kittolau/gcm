<?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>Yii::app()->createUrl('illust/bookmark'),
                'method'=>'post'
            )); ?>
     
<div>    
    <div class="bubble "> <i class="glyphicon glyphicon glyphicon-heart"></i> <?php echo $illust->getBookmarkedUsersCount() ?></div>
        <?php if($notLogedIn){?>
            <a href="<?php echo Yii::app()->createUrl('site/login')?>" class="btn btn-primary btn-xs">
                   bookmark
            </a><!-- user button group-->
        <?php }else{ ?>
            

            
            <?php if($isBookmarkedAlready){?>
                <a onclick="$(this).parents('form').submit();$(this).prop('onclick',null);" class="btn btn-default btn-xs">
                   Unbookmark
                </a><!-- user button group-->
            <?php }else{ ?>
                <a onclick="$(this).parents('form').submit();$(this).prop('onclick',null);" class="btn btn-primary btn-xs">
                      bookmark
                    </a><!-- user button group-->

                
                <?php } ?>
                    <input type="hidden" name="id" value="<?php echo $illust->id?>">

            <?php } ?>
        
</div>
<?php $this->endWidget(); ?>
