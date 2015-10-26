<?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>Yii::app()->createUrl('group/followGroup'),
                'method'=>'post'
            )); ?>
     
    <div class="col-xs-12 btn-group-vertical btn-group-sm">
        <?php if($notLogedIn){?>
            <a class="btn btn-primary btn-block" href="#"><i class="glyphicon glyphicon-thumbs-up"></i>人氣<span class="badge"><?php echo $group->getFollowedCount() ?></span></a>
        <?php }else{ ?>
            
            <?php if($isFollowedAlready){?>
                <a onclick="$(this).parents('form').submit();$(this).prop('onclick',null);" class="btn btn-default">
                  <i class="glyphicon glyphicon-minus"></i> Unfollow
                </a><!-- user button group-->
            <?php }else{ ?>
                <a onclick="$(this).parents('form').submit();$(this).prop('onclick',null);" class="btn btn-primary btn-block">
                      <i class="glyphicon glyphicon-plus"></i> Follow
                    </a><!-- user button group-->

                
                <?php } ?>
                    <input type="hidden" name="id" value="<?php echo $group->id?>">
                <a class="btn btn-primary btn-block" href="#"><i class="glyphicon glyphicon-thumbs-up"></i>人氣<span class="badge"><?php echo $group->getFollowedCount() ?></span></a>

            <?php } ?>
        
    </div>
<?php $this->endWidget(); ?>
