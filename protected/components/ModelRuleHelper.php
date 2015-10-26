<?php
/**
 * Used to centrolize all the commonly used validation rule
 */
    class ModelRuleHelper{
        public static function booleanValidateRule($String_fieldNameList,$String_on= NULL){
            if($String_on != NULL){
                return array($String_fieldNameList, 'numerical','integerOnly'=>true,'min'=>0,'max'=>1,'on'=>$String_on);
            }else{
                return array($String_fieldNameList, 'numerical','integerOnly'=>true,'min'=>0,'max'=>1);
            }
        }
    }
?>
