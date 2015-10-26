<?php
/**
 * This is used as a widget for Follow User button
 */
class UserFollowWidget extends CWidget
{

	//remark:
	// this public variable is used as the parameter to accept a user_id
	// that used to get back the model
	//
	// to use this parameter in the view, we simply do something like
	// $this->widget('UserPortlet',array('user_id'=>'1234567');
    
        public $user;
        
        public $notLogedIn;
        public $isSelfViewing;
        public $isFollowedAlready;
    public function init()
    {
        if($this->user == null){
            throw new Exception("UserFollowWidget cannot init if user is null");
        }
        $currentLogedInUserId = Yii::app()->user->id;
        $this->notLogedIn = false;
        if($currentLogedInUserId == null){
            $this->notLogedIn=true;
        }
        
        
        $this->isSelfViewing=false;
        if($currentLogedInUserId == $this->user->id){
            $this->isSelfViewing=true;
        }
        
        $this->isFollowedAlready=$this->user->isFollowedByUser($currentLogedInUserId);
        parent::init();
    }
 
    public function run()
    {
        $this->render('application.components.view._UserFollowWidget',array(
            'user'=>$this->user,
            'notLogedIn'=>$this->notLogedIn,
            'isSelfViewing'=>$this->isSelfViewing,
            'isFollowedAlready'=>$this->isFollowedAlready
        ));
    }
}
?>