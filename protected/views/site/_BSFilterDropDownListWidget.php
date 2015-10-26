<?php
        if($model == null){
            throw new Exception("_BSFilterDropDownListWidget cannot init if model is null");
        }
        if($form == null){
            throw new Exception("_BSFilterDropDownListWidget cannot init if form is null");
        }
        if($fieldName == null){
            throw new Exception("_BSFilterDropDownListWidget cannot init if fieldName is null");
        }

        $isMethodExist = method_exists($model, 'getFilterableOptions');
        if(!$isMethodExist){
            throw new Exception(sprintf("[_BSFilterDropDownListWidget]%s does not have getFilterableOptions(), missing implementation?",  get_class($model)));
        }
        $option = $model->getFilterableOptions($fieldName);
        
        $attributeLabelArray = $model->attributeLabels();
        $isExist = array_key_exists($fieldName, $attributeLabelArray);
        if(!$isExist){
            throw new Exception(sprintf("[_BSFilterDropDownListWidget]%s does not have the attribute label for %s, missing fill in attributeLabels()?",  get_class($model),$fieldName));
        }
        $attributeLabel = $attributeLabelArray[$fieldName];
        $dropdownlistId = $fieldName.'filterOptions';
        
        
        JSHelper::SubmitOnDropDownListChange('#'.$dropdownlistId);
?>


<div class="input-group input-group-sm col-xs-12 col-sm-4 col-md-3 col-lg-3">
        <span class="input-group-addon"><?php echo $attributeLabel?></span>

                    <?php echo $form->dropDownList($model, $fieldName,$option, array('class'=>'form-control','id'=>$dropdownlistId)); ?> 

</div><!-- filter item 1 -->