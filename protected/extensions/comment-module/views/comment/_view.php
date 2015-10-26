<?php
	Yii::app()->clientScript->registerCss('ext-comment', "
	div.ext-comment {
		width: 100%;
		margin: 25px auto;
		min-height: 100px;
	}
	div.ext-comment p {
		padding-left: 125px;
	}
	div.ext-comment hr {
		margin: 0;
		padding: 0;
		border: none;
		border-bottom: solid 1px #aaa;
	}
	div.ext-comment img {
		float: left;
		width: 80px;
		height: 80px;
	}
	span.ext-comment-name {
		font-weight: bold;
	}
	span.ext-comment-head {
		color: #aaa;
	}
	span.ext-comment-options {
		float: right;
		color: #aaa;
	}
	");
?>
<?php $user = User::model()->findByPk($data->userId);
        ?>
<div class="media" id="ext-comment-<?php echo $data->id; ?>">
    <a rel="tooltip" title="<?php echo CHtml::encode($user->nickname)?>" class="pull-left thumbnail" href="<?php echo Yii::app()->createUrl('user/view', SeoHelper::userViewSEORouteArrayParam($user)); ?>">
     <div style="height:64px;width:64px;overflow: hidden" class="horizontalCenter">
            <img class="img-responsive" src=" <?php echo Yii::app()->request->baseUrl; ?>/<?php echo $user->icon_src?>"/>
    </div>
        
    </a>
    <div class="media-body">
        <h4 class="media-heading"><?php echo CHtml::link(CHtml::encode($user->nickname), SeoHelper::userViewSEORouteArray($user)); ?> 
            <span>
                <small>
                <?php echo Yii::app()->format->formatDateTime(
				is_numeric($data->createDate) ? $data->createDate : strtotime($data->createDate)
			); ?>
                </small>
            </span>
        </h4>
      <?php echo nl2br(CHtml::encode($data->message)); ?>
        <span class="ext-comment-options">
	<?php if (!Yii::app()->user->isGuest && (Yii::app()->user->id == $data->userId)) {
	    echo CHtml::ajaxLink('移除', array('/comment/comment/delete', 'id'=>$data->id), array(
			'success'=>'function(){ $("#ext-comment-'.$data->id.'").remove(); }',
		    'type'=>'POST',
	    ), array(
		    'id'=>'delete-comment-'.$data->id,
		    'confirm'=>'你確定要移除評論?',
	    ));
		echo " | ";
		echo CHtml::ajaxLink('編輯', array('/comment/comment/update', 'id'=>$data->id), array(
			'replace'=>'#ext-comment-'.$data->id,
			'type'=>'GET',
		), array(
			'id'=>'ext-comment-edit-'.$data->id,
		));
	} ?>
	</span>
    </div>
</div>
