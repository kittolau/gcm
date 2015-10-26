<?php
/**
 * This is the login logic being used now
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    
         private $_id;
    
	public function authenticate()
	{
		$users=User::findLoginUser($this->username);
                $isUserExist = $users != null;
		if(!$isUserExist){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
                }else if(!$users->isValidPassword($this->password)){
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
                }else{
                    /* authentication success! */
                    
                    //override the original id property
                    $this->_id=$users->id;
                    
                    //set other information to store in persistent storage
                    
                    // remark:
                    // if we want to add more properties, 
                    // we should use $this->setState('lastLoginTime', $user->lastLoginTime);
                    // such that we can get the value with something like:
                    // $lastLoginTime=Yii::app()->user->lastLoginTime;

                    $this->setState('user_name', $users->user_name);
                    $this->setState('show_r18', $users->show_r18);
                    $this->setState('show_bl', $users->show_bl);
                    $this->setState('icon_src', $users->icon_src);
                    
                    $this->errorCode=self::ERROR_NONE;
                }
		return !$this->errorCode;
	}
        
        // remark:
	// id is a pre-defined property so we need to override this property
	// in order to use $id=Yii::app()->user->id;
	public function getId(){
		return $this->_id;
	}
}