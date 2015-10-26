<?php
class FBLikeBoxWidget extends CWidget
{

    public function init()
    {
        parent::init();
    }
 
    public function run()
    {
        $this->render('application.components.view._FBLikeBoxWidget',array());
    }
}
?>