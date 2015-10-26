
<?php
/**
 * This is class used to handle all the commonly used method by the datetime
 */
    class DateTimeHelper{
        public static function now(){
            return date('Y-m-d H:i:s');
        }
        
        public static function today(){
            return date('Y-m-d');
        }
        
        public static function convertToDTStringFromPOSTForFieldName($fieldName,$POST){
             $yearFieldName = $fieldName.'_year';
            $monthFieldName = $fieldName.'_month';
            $dayFieldName = $fieldName.'_day';
            
            $year = $POST[$yearFieldName];
            $month = $POST[$monthFieldName];
            $day = $POST[$dayFieldName];
            return $year.'-'.$month.'-'.$day;
        }
    }
?>

