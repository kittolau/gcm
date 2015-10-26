<?php
/**
 * See Event Controller for controller details
 */
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
                                'backColor'=>0xffffff,
                                'transparent'=>true,
                                'testLimit'=>1,
                                'foreColor'=>0xff8017,
                                'minLength' => 8, // min length of generated word
                                'maxLength' => 10, // max length of generated word
                                'width' => 170, // width of the CAPTCHA image
                                'height' => 50, // height of the CAPTCHA image
                                'offset' => -2, // space between characters
                                'padding' => 4 // padding around the text
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

        public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','error','contact','register','login','term','aboutUS','contactUS','updateLog','googleSearch'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('logout','changePassword'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('forgetPassword'),
				'expression'=>'Yii::app()->user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->render('index');
                $this->redirect(array('event/index'));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
            /*
                if(404==Yii::app()->errorHandler->error["code"])
		{
                    $this->render('error');
                    return;
		}
            */

		if($error=Yii::app()->errorHandler->error)
		{

			//if(Yii::app()->request->isAjaxRequest)
				//echo $error['message'];
			//else
				$this->render('error', array('error'=>$error));
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

        public function actionRegister()
        {
            $model=new User('register');
            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);

            if(isset($_POST['User'])){

                $model->setAttributes($_POST['User']);

                $model->birthday = DateTimeHelper::convertToDTStringFromPOSTForFieldName('birthday',$_POST);


                //captcha validating
                require_once(Yii::app()->basePath . '/vendor/recaptchalib.php');
                $privatekey = "6LfXBe8SAAAAAA7fOOWIfyfmvWbIjk-s15UFfGec";
                $resp = recaptcha_check_answer ($privatekey,
                                              $_SERVER["REMOTE_ADDR"],
                                              $_POST["recaptcha_challenge_field"],
                                              $_POST["recaptcha_response_field"]);

                if (!$resp->is_valid) {
                    $error = $resp->error;
                   if($resp->error == 'incorrect-captcha-sol'){
                       $error = '確認碼不正確';
                   }
                  $this->render('register',array(
                                'model'=>$model,
                                'captchaError'=>$error
                            ));
                  return ;
                } else {
                  // Your code here to handle a successful verification

                    /** store the password for the athentication user
                     *  Since the password will be hashed once it is saved
                     */
                    $rawPassword=$model->password;

                    if($model->validate()){
                        if($model->save()){

                            $identity=new UserIdentity($model->user_name,$rawPassword);
                            $duration=3600*24*30; // 30 days
                            $identity->authenticate();
                            if(Yii::app()->user->login($identity,$duration)){
                                Yii::app()->user->setFlash(FlashMsg::SUCCESS, "歡迎加入!");
                            }else{
                                Yii::app()->user->setFlash(FlashMsg::WARNING, "歡迎加入! 請在登入頁面登入");
                            }


                            $this->redirect(array('index'));
                        }else{
                            Yii::app()->user->setFlash(FlashMsg::ERROR, "創建使用者失敗");
                          }
                    }else{
                        $model->purgePassword();
                    }
                }

            }

            $this->render('register',array(
                'model'=>$model,
                'captchaError'=>''
            ));
        }

        public function actionGoogleSearch($keyword){
            $this->render('googleSearch');
        }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

        public function actionForgetPassword(){

            if(isset($_POST['username']))
            {
                $username = $_POST['username'];

                $users=User::findLoginUser($username);
                $isUserExist = $users != null;
		if(!$isUserExist){
                    Yii::app()->user->setFlash(FlashMsg::ERROR, "沒有".$username."");
                    $this->redirect(array('forgetPassword'));
                }

                $newPassword = RandomHelper::generateRandomString();
                $users->resetPasswordAs($newPassword);

                $userEmail = $users->email;

                if($users->save()){

                    //Yii::app()->user->setFlash(FlashMsg::SUCCESS, "".$username."的新密碼: ".$newPassword);
                    $this->render('resettedPassword',array('model'=>$newPassword));
                    //$this->redirect(Yii::app()->request->urlReferrer);
                }
            }

            $this->render('forgetPassword');

        }

        public function actionMd5Login()
	{
		$model=new LoginForm;


		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->md5login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
                Yii::app()->user->clearStates();
		$this->redirect(Yii::app()->homeUrl);
	}

        public function actionTerm()
	{
		$this->render('term');
	}

        public function actionAboutUS(){
            $this->render('aboutus');
        }

        public function actionGoogleAnalytic(){
            $this->render('googleAnalytic');
        }

        public function actionContactUS(){
            $this->render('contactus');
        }

        public function actionUpdateLog(){

            $this->render('updatelog');
        }

        public function actionChangePassword(){

            $model = new PasswordChangeForm();
            if(isset($_POST["PasswordChangeForm"])){
              $attributes = $_POST["PasswordChangeForm"];
              $currentUserId =  Yii::app()->user->id ;
              $model->user_id = $currentUserId;
              $model->setAttributes($attributes);

              if($model->validate()){

                $user = User::model()->findByPk($currentUserId);
                $user->password = $_POST["PasswordChangeForm"]["password"];
                $user->password_repeat = $_POST["PasswordChangeForm"]["password"];

                Yii::app()->user->setFlash("success", "登入密碼已更改");
                if($user->save())
                  $this->redirect("index");
              }
            }
            $this->render("changePassword", array("model" => $model));
          }

            /**
            * Returns the data model based on the primary key given in the GET variable.
            * If the data model is not found, an HTTP exception will be raised.
            * @param integer the ID of the model to be loaded
            */
           public function loadModel($id)
           {
               $model=User::model()->findByPk($id);
               if($model===null)
                   throw new CHttpException(404,'The requested page does not exist.');
               return $model;
           }

            protected function performAjaxValidation($model)
            {
                    if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
                    {
                            echo CActiveForm::validate($model);
                            Yii::app()->end();
                    }
            }


}
