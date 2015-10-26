<?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>Yii::app()->createUrl('group/JoinGroup'),
                'method'=>'post'
            )); ?>
     
    <div class="col-xs-12 btn-group-vertical btn-group-sm">
        <input type="hidden" name="id" value="<?php echo $group->id?>">
        <?php if($notLogedIn){?>
        
        <?php }elseif(!$isJoined){?>
            <a onclick="$(this).parents('form').submit();$(this).prop('onclick',null);" class="btn btn-primary">
                加入組織
            </a><!-- user button group-->
        <?php }elseif($isPendingApprove){ ?>
            <!--<a onclick="$(this).parents('form').submit();$(this).prop('onclick',null);" class="btn btn-primary btn-block">-->
             <a class="btn btn-default btn-block" href="#">等待確認</a>
               
        <?php }else{ ?>
            <a class="btn btn-default btn-block" href="#">已加入</a>
        <?php } ?>
    </div>
<?php $this->endWidget(); ?>
