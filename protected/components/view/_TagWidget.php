<div class="form-group" style="position: static;">
		<!-- tags example -->
			<?php echo $form->labelEx($model,$fieldName); ?><br>
			<!--<div id="<?php echo get_class($model)?>_<?php echo $fieldName?>-tag-list" class="tag-list"><div class="tags"></div></div>-->
                        <?php $tagFieldName = get_class($model).'_'.$fieldName; ?>
                        <?php echo $form->textField($model,$fieldName,array('id'=>$tagFieldName,'class'=>'form-control','placeholder'=>"",'data-role'=>'tagsinput')) ?>
                        
                <p class="help-block"><?php echo $explanationText ?></p>
                        <?php echo $form->error($model,$fieldName,array('class'=>'help-block')); ?>
			<script>
                            
                            /*
				$(function() {
                                        var hiddenTagField=$('#<?php echo get_class($model)?>_<?php echo $fieldName?>');
                                        var tagListDiv=$('#<?php echo get_class($model)?>_<?php echo $fieldName?>-tag-list');
					var tags = tagListDiv.tags({
                                                promptText:'<?php echo TagWidget::promptText?>',
						afterAddingTag: function( tag){
							var tag_arr = tags.getTags();
							if(tag_arr.length > 10){
								tags.removeLastTag();
								return;
							}				
							var tag_str = tags.getTags().join(", ");
							hiddenTagField.attr('value',tag_str);		
						},
						afterDeletingTag:function( tag){
							var tag_str = tags.getTags().join(", ");
							hiddenTagField.attr('value',tag_str);
							
						}
					});
				});
                                */
			</script>
		</div>