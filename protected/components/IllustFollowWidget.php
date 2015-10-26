<?php
/**
 * This is used as a widget for Illust Follow button
 */
class IllustFollowWidget extends CWidget
{

	//remark:
	// this public variable is used as the parameter to accept a user_id
	// that used to get back the model
	//
	// to use this parameter in the view, we simply do something like
	// $this->widget('UserPortlet',array('user_id'=>'1234567');
    
        public $illust;
        
        public $notLogedIn;
        public $isBookmarkedAlready;
    public function init()
    {
        if($this->illust == null){
            throw new Exception("IllustFollowWidget cannot init if illust is null");
        }
        $currentLogedInUserId = Yii::app()->user->id;
        $this->notLogedIn = false;
        if($currentLogedInUserId == null){
            $this->notLogedIn=true;
        }

        $this->isBookmarkedAlready=$this->illust->isBookmarkedByUser($currentLogedInUserId);
        parent::init();
    }
 
    public function run()
    {
        $this->render('application.components.view._IllustFollowWidget',array(
            'illust'=>$this->illust,
            'notLogedIn'=>$this->notLogedIn,
            'isBookmarkedAlready'=>$this->isBookmarkedAlready
        ));
    }
}
?>