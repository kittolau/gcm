<?php
/**
 * This is used as a widget for Group Join button
 */
class JoinGroupWidget extends CWidget
{

	//remark:
	// this public variable is used as the parameter to accept a user_id
	// that used to get back the model
	//
	// to use this parameter in the view, we simply do something like
	// $this->widget('UserPortlet',array('user_id'=>'1234567');
    
        public $group;
        
        public $isJoined;
        public $isPendingApprove;
        public $notLogedIn;
    public function init()
    {
        if($this->group == null){
            throw new Exception("GroupFollowWidget cannot init if group is null");
        }
        $currentLogedInUserId = Yii::app()->user->id;
        
        if($currentLogedInUserId == null){
            $this->notLogedIn=true;
        }

        $this->isJoined = $this->group->isUserJoined($currentLogedInUserId);
        $this->isPendingApprove=$this->group->isUserPendingApprove($currentLogedInUserId);
        parent::init();
    }
 
    public function run()
    {
        $this->render('application.components.view._JoinGroupWidget',array(
            'group'=>$this->group,
            'notLogedIn'=>$this->notLogedIn,
            'isJoined'=>$this->isJoined,
            'isPendingApprove'=>$this->isPendingApprove,
        ));
    }
}
?>