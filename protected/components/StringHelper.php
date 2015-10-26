<?php

/**
 * Helper method to simplify some commonly used string function
 */
class StringHelper{
    public static function ConvertNewlineToBRwithHTMLEncode($inputString){

        $sentances = explode("\n", $inputString);
        $concatString="";
        foreach ($sentances as $sentance) {
            $concatString = $concatString.CHtml::encode($sentance).'<br/>';
        }
        return $concatString;

    }
    
    public static function isNullOrEmpty($stringToCheck){
        return (!isset($stringToCheck) || trim($stringToCheck) === '');
    }
}
?>