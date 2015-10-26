<?php

/**
 * This is class used to handle all the commonly used method by the datetime
 */
class DTHelper{
    public static function dtStrToISO8601($DT_string){
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $DT_string); 
        return $date->format(DateTime::ISO8601);
    }
}
?>