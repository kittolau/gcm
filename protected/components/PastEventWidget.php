<?php
/**
 * This is used as a widget to show limited number of past even on the left column
 */
class PastEventWidget extends CWidget
{
    public $allPastEvents;
    public function init()
    {
        $this->allPastEvents = Event::getPastEvent();
        parent::init();
    }
 
    public function run()
    {
        $this->render('application.components.view._PastEventWidget',array(
            'allPastEvents'=>$this->allPastEvents,
        ));
    }
}
?>