<?php
/**
 * This is used as a widget for GroupFollow button
 */
class GroupFollowWidget extends CWidget
{

	//remark:
	// this public variable is used as the parameter to accept a user_id
	// that used to get back the model
	//
	// to use this parameter in the view, we simply do something like
	// $this->widget('UserPortlet',array('user_id'=>'1234567');
    
        public $group;
        
        public $notLogedIn;
        public $isFollowedAlready;
    public function init()
    {
        if($this->group == null){
            throw new Exception("GroupFollowWidget cannot init if group is null");
        }
        $currentLogedInUserId = Yii::app()->user->id;
        $this->notLogedIn = false;
        if($currentLogedInUserId == null){
            $this->notLogedIn=true;
        }

        $this->isFollowedAlready=$this->group->isFollowedByUser($currentLogedInUserId);
        parent::init();
    }
 
    public function run()
    {
        $this->render('application.components.view._GroupFollowWidget',array(
            'group'=>$this->group,
            'notLogedIn'=>$this->notLogedIn,
            'isFollowedAlready'=>$this->isFollowedAlready
        ));
    }
}
?>