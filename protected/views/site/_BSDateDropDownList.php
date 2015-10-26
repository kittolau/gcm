
<?php
        if($model == null){
            throw new Exception("_BSDateDropDownList cannot init if model is null");
        }
        if($fieldName == null){
            throw new Exception("_BSDateDropDownList cannot init if fieldName is null");
        }
        if($form == null){
            throw new Exception("_BSDateDropDownList cannot init if form is null");
        }
        
        $currentYear = null;
        $currentMonth = null;
        $currentDay = null;
        
        $modelValue = $model->$fieldName;
        if($modelValue != null){
            $time = strtotime($modelValue);
            $currentYear=date("Y",$time);
            $currentMonth=date("m",$time);
            $currentDay=date("d",$time);
        }
?>
<?php
    $yearFieldName = $fieldName.'_year';
    $monthFieldName = $fieldName.'_month';
    $dayFieldName = $fieldName.'_day';
?>

<div class="form-group">
    <?php echo $form->labelEx($model,$fieldName); ?>
    <div class="row">
        <div class="col-xs-6">
            <select class="form-control" id="<?php echo $yearFieldName ?>" name="<?php echo $yearFieldName ?>">
            </select> 
        </div>
        <div class="col-xs-3">
            <select class="form-control" id="<?php echo $monthFieldName ?>" name="<?php echo $monthFieldName ?>">
            </select> 
        </div>
        <div class="col-xs-3">
            <select class="form-control" id="<?php echo $dayFieldName ?>" name="<?php echo $dayFieldName ?>">
            </select>
        </div>
    </div>
    
    <?php echo $form->error($model,$fieldName,array('class'=>'help-block')); ?>
</div>

<script type="text/javascript">

/***********************************************
* Drop Down Date select script- by JavaScriptKit.com
* This notice MUST stay intact for use
* Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
***********************************************/

var monthtext=['1','2','3','4','5','6','7','8','9','10','11','12'];

function populatedropdown(dayfield, monthfield, yearfield){
    var today=new Date()
    var dayfield=document.getElementById(dayfield)
    var monthfield=document.getElementById(monthfield)
    var yearfield=document.getElementById(yearfield)
    for (var i=0; i<31; i++)
    dayfield.options[i]=new Option(i, i+1)
    dayfield.options[today.getDate()]=new Option(today.getDate(), today.getDate(), true, true) //select today's day
    for (var m=0; m<12; m++)
    monthfield.options[m]=new Option(monthtext[m], monthtext[m])
    monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], monthtext[today.getMonth()], true, true) //select today's month
    var minYear=1950;
    var currentYear =today.getFullYear();
    var arrCount = 0;
    while(minYear != currentYear){
        yearfield.options[arrCount]=new Option(minYear, minYear);
        minYear+=1;
        arrCount+=1;
    }
    <?php if($currentYear !=null){?>
    for(var i =0 ; i<yearfield.length ; i++){
        console.log(yearfield[i].text);
        if(yearfield[i].text == <?php echo CHtml::encode($currentYear) ?>){
            yearfield[i].selected = true;
        }
    }
    <?php } ?>
    <?php if($currentMonth !=null){?>
    for(var i =0 ; i<monthfield.length ; i++){
        if(monthfield[i].text == <?php echo CHtml::encode($currentMonth) ?>){
            monthfield[i].selected = true;
        }
    }
    <?php } ?>
    <?php if($currentDay !=null){?>
    for(var i =0 ; i<dayfield.length ; i++){
        if(dayfield[i].text == <?php echo CHtml::encode($currentDay) ?>){
            dayfield[i].selected = true;
        }
    }
    <?php } ?>
}



</script>
<script type="text/javascript">

//populatedropdown(id_of_day_select, id_of_month_select, id_of_year_select)
window.onload=function(){
populatedropdown("<?php echo $dayFieldName ?>", "<?php echo $monthFieldName ?>", "<?php echo $yearFieldName ?>")
}
</script>