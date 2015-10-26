<?php
    /**
 * See Event Controller for controller details
 */
class MemberCenterController extends Controller
{

        public $layout='memberCenter';

        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

        public function accessRules()
	{
		return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
                                    'index',
                                    'UpdateUser',
                                    'CreateGroupProduct',
                                    'ManageIllust',
                                    'CreateIllust',
                                    'ManageGroup',
                                    'CreateGroup',
                                    'FollowingAuthor',
                                    'FollowingGroup',
                                    'BookMark'
                                    ),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'expression'=>'Yii::app()->user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
                $user = User::model()->findByPk(Yii::app()->user->id);
		$this->render('index',array(
                    'model'=>$user
                ));
	}

        public function actionUpdateUser(){
                $model=User::model()->findByPk(Yii::app()->user->id);
                $fileModel=new FileUploadFormModel();
                $fileModel->setScenario(FileUploadFormModel::FILE_UPLOAD_MODE_SINGLE);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
                        $model->setScenario('update');
			$model->setAttributes($_POST['User']);
                        $model->birthday = DateTimeHelper::convertToDTStringFromPOSTForFieldName('birthday',$_POST);
                        $test = $model->summary;
                        if($model->validate()){

                            $fileModel->LoadUploadedeImage();
                            if($fileModel->isUploadedFile()){

                                if($fileModel->validate()){

                                    $SavedFileRelativePaths = $fileModel->processImage(get_class($model),$model->user_name,  md5(DateTimeHelper::now()));
                                    $model->icon_src = ArrayHelper::array2string($SavedFileRelativePaths);

                                    if($model->save()){
                                        Yii::app()->user->setFlash(FlashMsg::SUCCESS, "個人資料已更新");
                                        $this->redirect(array('index'));
                                    }else{
                                        Yii::app()->user->setFlash(FlashMsg::ERROR, "更新個人資料失敗");
                                      }
                                }else{
                                    $this->render('updateUser',array(
                                            'model'=>$model,
                                            'fileModel'=>$fileModel
                                    ));
                                }
                            }

                            if($model->save()){
                                 Yii::app()->user->setFlash(FlashMsg::SUCCESS, "個人資料已更新");
                                $this->redirect(array('index'));
                            }

                        }

		}

		$this->render('updateUser',array(
			'model'=>$model,
                        'fileModel'=>$fileModel
		));
        }

        public function actionCreateGroupProduct($mode=GroupProduct::BOOK,$preselected_event_id=0)
	{
                $user = User::model()->findByPk(Yii::app()->user->id);
                $OwnedGroups = $user->OwnedGroup;
                if(count($OwnedGroups) == 0){
                    $this->render('noOwnedGroup');
                    return;
                }
                /* validate all query string param */
                $model=new GroupProduct('create');
                $model->categorize($mode);//this will throw new CHttpException(404,'test');
                /*define the required variable for the controller base on the query string param */

                $fileModel=new FileUploadFormModel();
                $view;
                $subValidationScen;
                if($model->product_catagory_enum == GroupProduct::BOOK){
                    $view='createBook';
                    $subValidationScen=GroupProduct::BOOK_CAT_TITLE;
                }else if($model->product_catagory_enum == GroupProduct::GIFT){
                    $view='createGift';
                    $subValidationScen=GroupProduct::GIFT_CAT_TITLE;
                }else{
                    $view='createElect';
                    $subValidationScen=GroupProduct::ELECT_CAT_TITLE;
                }

                if(isset($_POST['GroupProduct'])){

                    $model->setAttributes($_POST['GroupProduct']);
                    //$fileHandler->LoadUploadedeImageToModel();
                    //$model->photos = $fileHandler->photos;
                    //$model->photos = CUploadedFile::getInstancesByName(BSMultiFileUploadWidget::fieldName);

                    if($model->validate()){
                        $model->setScenario($subValidationScen);
                        $model->setAttributes($_POST['GroupProduct']);
                        if($model->validate()){
                            $fileModel->LoadUploadedeImage();
                            $fileModel->setScenario(FileUploadFormModel::FILE_UPLOAD_MODE_MULTI);
                            if($fileModel->validate()){
                                if($model->save()){

                                    $model->addJoinEvents($model->event_arr_id);
                                //$SavedFileRelativePaths = $fileModel->processImage(get_class($model),$model->group->id,$model->id);

                                $ips = new ImageProcessService($fileModel, get_class($model), $model->group->id, $model->id);
                                $ips->saveImage(150,150);

                                $SavedFileRelativePaths = $ips->getOriginalImageVirtualPath();
                                $SavedThumbnailFileRelativePaths = $ips->getThumbnailImageVirtualPath();

                                $model->save_img_src($SavedFileRelativePaths,$SavedThumbnailFileRelativePaths);

                                Yii::app()->user->setFlash(FlashMsg::SUCCESS, "投稿販賣情報成功");
                                $this->redirect(SeoHelper::groupProductViewSEORouteArray($model));
                            }else{
                                Yii::app()->user->setFlash(FlashMsg::ERROR, "投稿販賣情報失敗");
                              }
                            }
                        }
                    }
                }

                $this->render($view,array(
                    'model'=>$model,
                    'fileModel'=>$fileModel,
                    'preselected_event_id'=>$preselected_event_id
                ));
	}

        public function actionManageIllust(){
            $model = new Illust('search');
            $model->unsetAttributes();  // clear any default values
            $this->render('manageIllust',array(
                    'model'=>$model,
            ));
        }

        public function actionCreateIllust($mode)
	{
                /* validate all query string param */
                $model=new Illust('create');
                $model->categorize($mode);//this will throw new CHttpException(404,'test');

                /*define the required variable for the controller base on the query string param */
                $fileModel=new FileUploadFormModel();
                $view;
                $scen;
                if($model->Illust_cat_title == Illust::ILLUST_CAT_TITLE){
                    $scen=FileUploadFormModel::FILE_UPLOAD_MODE_SINGLE;
                    $view='createIllust';
                }else{
                    $scen=FileUploadFormModel::FILE_UPLOAD_MODE_MULTI;
                    $view='createManga';
                }
                if(isset($_POST['Illust'])){
                    $model->setAttributes($_POST['Illust']);
                    //$fileHandler->LoadUploadedeImageToModel();
                    //$model->photos = $fileHandler->photos;
                    //$model->photos = CUploadedFile::getInstancesByName(BSMultiFileUploadWidget::fieldName);

                    if($model->validate()){
                        $fileModel->LoadUploadedeImage();
                        $fileModel->setScenario($scen);
                        if($fileModel->validate()){
                            if($model->save()){
                                $ips = new ImageProcessService($fileModel, get_class($model), Yii::app()->user->user_name, $model->id);
                                $ips->saveImage(150,150);

                                $SavedFileRelativePaths = $ips->getOriginalImageVirtualPath();
                                $SavedThumbnailFileRelativePaths = $ips->getThumbnailImageVirtualPath();
                                //$SavedFileRelativePaths = $fileModel->processImage(get_class($model),Yii::app()->user->user_name,$model->id);
                                $model->save_img_src($SavedFileRelativePaths,$SavedThumbnailFileRelativePaths);

                                $model->addOwnerUserId(Yii::app()->user->id);

                                Yii::app()->user->setFlash(FlashMsg::SUCCESS, "投稿作品成功");
                                $this->redirect(SeoHelper::illustViewSEORouteArray($model));
                            }else{
                                Yii::app()->user->setFlash(FlashMsg::ERROR, "投稿作品失敗");
                            }
                        }
                    }
                }
                $this->render($view,array(
                    'model'=>$model,
                    'fileModel'=>$fileModel
                ));
	}

        public function actionManageGroup()
	{
                $OwnedGroupArray = User::getOwnedGroupArray(Yii::app()->user->id);
                if(count($OwnedGroupArray)==0){
                    $this->render('noOwnedGroup');
                    return;
                }

                $manageGroup = null;

                $isManageGroupIdSet = isset($_POST["manageGroupId"]);

                if($isManageGroupIdSet){
                    $manageGroupId = $_POST["manageGroupId"];
                    foreach ($OwnedGroupArray as $ownedGroup) {
                        if($ownedGroup->id == $manageGroupId){
                            $manageGroup = $ownedGroup;
                            break;
                        }
                    }
                    if($manageGroup == null){
                        throw new CHttpException(404,"cannot find group");
                    }

                }else{
                    $manageGroup = $OwnedGroupArray[0];
                }

                $this->render('manageGroup',array(
                    'ownedGroupArray'=>$OwnedGroupArray,
                    'manageGroup'=>$manageGroup
                    )
                 );

	}

        public function actionCreateGroup(){
                            /* validate all query string param */
                $model=new Group('create');
                $fileModel=new FileUploadFormModel();
                $fileModel->setScenario(FileUploadFormModel::FILE_UPLOAD_MODE_SINGLE);
                /*define the required variable for the controller base on the query string param */

                if(isset($_POST['Group'])){
                    $model->setAttributes($_POST['Group']);
                    //$fileHandler->LoadUploadedeImageToModel();
                    //$model->photos = $fileHandler->photos;
                    //$model->photos = CUploadedFile::getInstancesByName(BSMultiFileUploadWidget::fieldName);

                    if($model->validate()){
                        $fileModel->LoadUploadedeImage();
                        if($fileModel->isUploadedFile()){

                            if($fileModel->validate()){

                                $SavedFileRelativePaths = $fileModel->processImage(get_class($model),$model->group_name,  md5(DateTimeHelper::now()));
                                $model->apply_img = ArrayHelper::array2string($SavedFileRelativePaths);

                                if($model->save()){
                                $model->addOwnerUser(Yii::app()->user->id);
                                Yii::app()->user->setFlash(FlashMsg::SUCCESS, "已提交組織申請");
                                $this->redirect(array('index'));
                            }else{
                                Yii::app()->user->setFlash(FlashMsg::ERROR, "提交組織申請失敗");
                              }
                            }
                        }else{

                            if($model->save()){
                                $model->addOwnerUser(Yii::app()->user->id);
                                Yii::app()->user->setFlash(FlashMsg::SUCCESS, "已提交組織申請");
                                $this->redirect(array('index'));
                            }else{
                                Yii::app()->user->setFlash(FlashMsg::ERROR, "提交組織申請失敗");
                              }
                        }
                    }
                    }



                $this->render('createGroup',array(
                    'model'=>$model,
                    'fileModel'=>$fileModel
                ));
        }

        public function actionFollowingAuthor()
	{
                $user = User::model()->findByPk(Yii::app()->user->id);
                if($user == null){
                    throw new CHttpException(404,'The specified user cannot be found.');
                }

                $model = new Illust('search');
                $model->unsetAttributes();  // clear any default values
                if (isset($_GET['Illust'])) {
                    $model->attributes = $_GET['Illust'];
                }
                $this->render('followingAuthor', array(
                    'model' => $model,
                    'user' => $user
                ));
	}

        public function actionFollowingGroup()
	{
                $user = User::model()->findByPk(Yii::app()->user->id);
                if($user == null){
                    throw new CHttpException(404,'The specified user cannot be found.');
                }
                $model = new GroupProduct('search');
                $model->unsetAttributes();  // clear any default values
                if (isset($_GET['GroupProduct'])) {
                    $model->attributes = $_GET['GroupProduct'];
                }
		$this->render('followingGroup', array(
                    'model' => $model,
                    'user' => $user
                ));
	}

        public function actionBookmark()
	{
		$user = User::model()->findByPk(Yii::app()->user->id);
                if($user == null){
                    throw new CHttpException(404,'The specified user cannot be found.');
                }

                $model = new Illust('search');
                $model->unsetAttributes();  // clear any default values
                if (isset($_GET['Illust'])) {
                    $model->attributes = $_GET['Illust'];
                }
                $this->render('bookmark', array(
                    'model' => $model,
                    'user' => $user
                ));
	}



	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
