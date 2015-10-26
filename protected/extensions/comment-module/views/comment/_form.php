<?php //if (Yii::app()->user->isGuest) {
?><!--<div class="ext-comment-not-loggedin">
	對不起, 請登入以留下評論
</div> --><?php// } else { ?>
<div id="ext-comment-form-<?php echo $comment->isNewRecord ? 'new' : 'edit-'.$comment->id; ?>" class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'ext-comment-form',
    'action'=>array('/comment/comment/create'),
	'enableAjaxValidation'=>false
)); ?>
    <fieldset>
	<?php /** @var CActiveForm $form */
	//echo $form->errorSummary($comment); ?>

	<div class="form-group">
		<?php echo $form->labelEx($comment,'message'); ?>
		<?php echo $form->textArea($comment,'message',array('class'=>"form-control",'rows'=>5, 'cols'=>25)); ?>
		<?php echo $form->error($comment,'message'); ?>
	</div>

	<div class="form-group">
	    <?php if ($comment->isNewRecord) {

			echo $form->hiddenField($comment, 'type');
			echo $form->hiddenField($comment, 'key');

            /* echo CHtml::hiddenField('returnUrl', $this->createUrl(''));}
		    echo CHtml::submitButton('Save'); */
			echo CHtml::ajaxSubmitButton('Submit',
                array('/comment/comment/create'),
		        array(
                    'replace'=>'#ext-comment-form-new',
                    'error'=>"function(){
                        $('#Comment_message').css('border-color', 'red');
                        $('#Comment_message').css('background-color', '#fcc');
                    }"
		        ),
		        array('class'=>'btn btn-large btn-info','id'=>'ext-comment-submit' . (isset($ajaxId) ? $ajaxId : ''))
		    );
		} else {
			echo CHtml::ajaxSubmitButton('Update',
				array('/comment/comment/update', 'id'=>$comment->id),
				array(
					'replace'=>'#ext-comment-form-edit-'.$comment->id,
					'error'=>"function(){
						$('#Comment_message').css('border-color', 'red');
						$('#Comment_message').css('background-color', '#fcc');
					}"
		        ),
		        array('class'=>'btn btn-large btn-info','id'=>'ext-comment-submit' . (isset($ajaxId) ? $ajaxId : ''))
	        );
		}
		?>
	</div>
<fieldset>
<?php $this->endWidget() ?>

</div><!-- form -->
<?php// } ?>