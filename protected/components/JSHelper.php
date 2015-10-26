<?php
/**
 * Used to render the specific JS function on demand
 */
    class JSHelper{
        
        const SUBMIT_BUTTON_TEXT='Submit';
        
        public static function preventEnterKeySubmit(){
$no_enter_submit=<<<EOD
        function stopRKey(evt) { 
            var evt = (evt) ? evt : ((event) ? event : null); 
            var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
            if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
          } 

          document.onkeypress = stopRKey; 

EOD;
        Yii::app()->clientScript->registerScript('no_enter_submit',$no_enter_submit);
        }
        
        public static function lockSubmitButtonOnSubmit($targetSubmitButtonCSSSelector='input[type=submit]'){
            $submitButtonText=  JSHelper::SUBMIT_BUTTON_TEXT;
            $no_dbl_click=<<<EOD

   $("the_button").click(function(event) {      
   //extra_js;
   var target= $(event.currentTarget);
  // console.dir(target);
    if(!target.attr('disabled')){
    target.attr('rel',target.val());  
    }      
    //custom code added by me
        /*
    var hasError=false;
    $('div.form-group',target.parents('form')).each(function(){
            if($(this).hasClass('has-error')){
                    hasError=true;
            }
    });
    if(hasError){
        return false;
    }
        */
    //end custom code
        
    target.attr("disabled",true)
         .prop('disabled',true)
         .attr("value", "$submitButtonText...");
      var the_expr="$('#" + target.attr('id') + "')";
      var the_statement=the_expr + '.attr("disabled",false).val(' + the_expr + '.attr("rel"))';      
      setTimeout(the_statement,2000);
     target.parents('form').submit(); 
     return true;
   });

EOD;
        $js=str_replace('the_button',$targetSubmitButtonCSSSelector,$no_dbl_click);
        Yii::app()->clientScript->registerScript('no_dbl_click',$js);
        }
        
        public static function CActiveFormClientOptionsForBSWidget($targetSubmitButtonCSSSelector='input[type=submit]'){
            return array(
                'validateOnSubmit'=>true,
                'afterValidate' => 'js:function(form, data, hasError) { 
                  if(hasError) {
                      $("'.$targetSubmitButtonCSSSelector.'").attr("disabled",false).attr("value", "'.JSHelper::SUBMIT_BUTTON_TEXT.'");
                      for(var i in data) $("#"+i).closest(".form-group").addClass("has-error");
                      return false;
                  }
                  else {
                      form.children().closest(".form-group").removeClass("has-error");
                      return true;
                  }
              }',
              'afterValidateAttribute' => 'js:function(form, attribute, data, hasError) {
               if(hasError) 
                    $("#"+attribute.id).closest(".form-group").addClass("has-error");
               else 
                    $("#"+attribute.id).closest(".form-group").removeClass("has-error"); 
              }',   
            );
        }
        
        public static function SubmitOnDropDownListChange($targetDropDownListCSSSelector){
            if($targetDropDownListCSSSelector==null || $targetDropDownListCSSSelector==""){
                throw new Exception("[JSHelper->SubmitOnDropDownListChange] targetDropDownListCSSSelector is not valid");
            }

            $js=<<<EOD
            $(function(){
                    $('$targetDropDownListCSSSelector').change(function(){
                    console.log("caleed");
                        $(this).parents('form').submit();
                    });
            });
EOD;
        Yii::app()->clientScript->registerScript('SubmitOnDropDownListChangeFor'.$targetDropDownListCSSSelector,$js);
    }
    
    public static function ListViewAfterAjaxUpdate(){
        return 'function(id,data){$("img.lazy").unveil(); $("span.timeago").timeago();}';
    }
    
    public static function AjaxUpdateListViewOnDropDownListChange($targetDropDownListCSSSelector,$ListViewId){
            if($targetDropDownListCSSSelector==null || $targetDropDownListCSSSelector==""){
                throw new Exception("[JSHelper->SubmitOnDropDownListChange] targetDropDownListCSSSelector is not valid");
            }

            $js=<<<EOD
            $(function(){
                    $('$targetDropDownListCSSSelector').change(function(){
                        $.fn.yiiListView.update('$ListViewId');
                    });
            });
EOD;
        Yii::app()->clientScript->registerScript('SubmitOnDropDownListChangeFor'.$targetDropDownListCSSSelector,$js);
    }
    
    public static function ApplyServersideValidationErrorToInputField(){
            $js=<<<EOD
            $(function(){
                    $('.form-control').each(function(){
                        var hasErrorClass = $(this).hasClass("error");
                        var hasHasErrorClass = $(this).hasClass("has-error");
                        console.log(hasErrorClass);
                    console.log(hasHasErrorClass);
                        var isError = hasErrorClass || hasHasErrorClass;
                        if(isError){
                            $(this).closest('.form-group').addClass('has-error');
                        }
                    });
            });
EOD;
        Yii::app()->clientScript->registerScript('ApplyServersideValidationErrorToInputField',$js);
    }
}
?>

