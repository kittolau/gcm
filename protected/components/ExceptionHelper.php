<?php
    class ExceptionHelper{
        public static function throw404($className,$methodName,$Reason){
            $errMsg = sprintf("[%s->%s] %s",$className,$methodName,$Reason);
            throw new CHttpException(404,$errMsg);
        }
    }
?>
