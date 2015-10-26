<?php
    /** get the default sort order for the first time */
    $defaultSortOrderUseDESC=true;
    if($defaultDesc ==null){
        $defaultSortOrderUseDESC = $defaultDesc;
    }
    
    /** validate for the input model*/
    if($model == null){
        throw new Exception("_BSSortRevertWidget cannot init if model is null");
    }

    /** prepare for the id and variable name */
    $modelClassName = get_class($model);
    $name = $modelClassName.'_sort'; //this is used for clistview to sort
   
     /** determine whether GET param contain ".desc" suffix */
    $isContainDescThisTime=false;
    if(isset($_GET[$name]) && !empty($_GET[$name])){
        $selectedVal = $_GET[$name];
        if(strpos($selectedVal,'.desc') !== false){
            $isContainDescThisTime=true;
        }
    }
    
    /** determine whether next time should be desc, */
    $isNextTimeWillBeDesc=$isContainDescThisTime;
    if(!isset($_GET[$name])){
        //enter the page for the first time
        $isNextTimeWillBeDesc = $defaultSortOrderUseDESC;
    }
    
    $dropdownlistId = $modelClassName.'sortOptions';
    $sortButtonId = $dropdownlistId.'RevertButton';
?>
<div class="input-group input-group-sm col-xs-12 col-sm-1 col-md-1 col-lg-1">
    <?php if($isNextTimeWillBeDesc){?>
        <button id="<?php echo $sortButtonId?>" type="submit" class="btn btn-default" ><span class="glyphicon glyphicon-chevron-down"></span></button>
    <?php }else{ ?>
        <button id="<?php echo $sortButtonId?>" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-chevron-up"></span></button>
    <?php } ?>
</div>
    <script>
        <?php /** javascript used to reverse the sort order base on the current sort order of sortable dropdownlist */?>
        $('#<?php echo $sortButtonId?>').click(function(){
            $('#<?php echo $dropdownlistId?> option').each(function(){
                var value = $(this).val();
                if(value.indexOf('.desc') !=-1){
                    var reversed = value.replace('.desc','');
                    $(this).val(reversed);
                }else{
                    $(this).val(value+'.desc');
                }
            });
            return true; //cont. submit
        });
    </script>