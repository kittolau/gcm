<?php

/**

 */
class PasswordChangeForm extends CFormModel
{
   
    
        public $password_repeat = null ;
        public $oldPassword = null;
        public $password = null;

        public $user_id = null;

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        //Register case
                        array('oldPassword,password_repeat,password', 'required'),
                        array('password,oldPassword,password_repeat', 'length', 'min'=>8, 'max'=>20),
                        array('password_repeat','compare','compareAttribute'=>'password'),
                        array('oldPassword','isValidPassword'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                        'oldPassword' => '舊密碼',
			'password' => '新密碼',
                        'password_repeat'=> '新密碼確認'
		);
	}

          public function isValidPassword($passwordToBeValidate){
              $user = User::model()->findByPk($this->user_id);
              $isPasswordValid = $user->isValidPassword($this->$passwordToBeValidate);
              if(!$isPasswordValid){
                  $this->addError($passwordToBeValidate,"舊密碼不正確");
              }
                  
          }

          
          public function purgePassword(){
              $this->password ="";
              $this->password_repeat = "";
          }
}
