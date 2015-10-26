<?php
        /** get the default sort order for the first time */
        $defaultSortOrderUseDESC=true;
        if($defaultDesc == null){
            $defaultSortOrderUseDESC = $defaultDesc;
        }
        /** validate for the input model, check if the model has getSortableOptions implemented */
        if($model == null){
            throw new Exception("_BSSortDropDownListWidget cannot init if model is null");
        }
        $isMethodExist = method_exists($model, 'getSortableOptions');
        if(!$isMethodExist){
            throw new Exception(sprintf("[_BSSortDropDownListWidget]%s does not have getSortableOptions(), missing implementation?",  get_class($model)));
        }
        
        /** get the list of sortable Options */
        $options = $model->getSortableOptions();

        /** prepare for the id and variable name */
        $modelClassName = get_class($model);
        $dropdownlistId = $modelClassName.'sortOptions';
        $name = $modelClassName.'_sort'; //this is a GET param used for clistview to sort for you

        /** determine whether GET param contain ".desc" suffix */
        $isContainDescThisTime=false;
        if(isset($_GET[$name]) && !empty($_GET[$name])){
            $selectedVal = $_GET[$name];
            if(strpos($selectedVal,'.desc') !== false){
                $isContainDescThisTime=true;
            }
        }
        
        /** determine whether next time should be desc, 
         *  for sortable option, it should remain the sort order state 
         *  so if this time contain desc, next time it should also contain desc
         */
        $isNextTimeWillBeDesc=$isContainDescThisTime;
        if(!isset($_GET[$name])){
            //enter the page for the first time
            $isNextTimeWillBeDesc = $defaultSortOrderUseDESC;
        }
        
        /** append ".desc" if next time will be Desc */
        if($isNextTimeWillBeDesc){
            //if current state is asscending ,then prepare for the descending option
            $AppendOptions=array();
            foreach($options as $dropdownlistValue=>$dropdownlistText){
                $AppendOptions[$dropdownlistValue.'.desc']=$dropdownlistText;
            }
            $options=$AppendOptions;
        }
        
        /** remain the selected sort option */
        $selectedVal=""; //default unselected
        if(isset($_GET[$name]) && !empty($_GET[$name])){
            $selectedVal = $_GET[$name];
            //replace .desc no matter it exist or not
            $selectedVal = str_replace('.desc', '', $selectedVal);
            foreach($options as $dropdownlistValue=>$dropdownlistText){
                if(strpos($dropdownlistValue,$selectedVal) !== false){
                    $selectedVal=$dropdownlistValue;
                }
            }

        }
        
        JSHelper::SubmitOnDropDownListChange('#'.$dropdownlistId);
?>

<div class="input-group input-group-sm col-xs-12 col-sm-4 col-md-3 col-lg-3">
        <span class="input-group-addon">Sort</span>
                    <?php echo CHtml::dropDownList($name, $selectedVal,$options, array('class'=>'form-control','id'=>$dropdownlistId)); ?> 
</div><!-- filter item 1 -->