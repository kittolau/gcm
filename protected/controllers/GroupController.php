<?php
/**
 * See Event Controller for controller details
 */
class GroupController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';
        public $group;
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + FollowGroup, delete, joinGroup,approveUser,disapproveUser', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','FollowGroup','joinGroup','GroupMemberList','ApproveUser','DisapproveUser'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','approve','unapprove'),
				'expression'=>'Yii::app()->user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

        public function actionFollowGroup()
	{
            $groupIdToFollow = $_POST["id"];
            $groupToFollow = Group::model()->with('followingUsers')->findByPk($groupIdToFollow);
            if($groupToFollow == null){
                Yii::app()->user->setFlash(FlashMsg::ERROR,"找不到相關組織");
                throw new CHttpException(404,'找不到相關組織');
            }
            
            $current_user_id = Yii::app()->user->id;
            $currentUser = User::model()->findByPk(Yii::app()->user->id);
            
            if($groupToFollow->isFollowedByUser($currentUser->id)){
                $currentUser->unfollowGroup($groupIdToFollow);
                Yii::app()->user->setFlash(FlashMsg::WARNING,"你已取消關注 ".$groupToFollow->group_name);
                $this->redirect(Yii::app()->request->urlReferrer);
            }else{
                $currentUser->followGroup($groupIdToFollow);
                Yii::app()->user->setFlash(FlashMsg::SUCCESS,"你關注了 ".$groupToFollow->group_name);
                $this->redirect(Yii::app()->request->urlReferrer);
            }
	}
        
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            
            //find the group
            $this->layout='//layouts/group';
            $group=Group::model()->findByPk($id);
            $this->group = $group;
            
            //find all groupProduct that belong to that group
            $model = new GroupProduct('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['GroupProduct'])) {
                $model->attributes = $_GET['GroupProduct'];
            }
            $this->render('view', array(
                'model' => $model,
                'group'=>$group
            ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Group;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Group']))
		{
			$model->attributes=$_POST['Group'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            
                
            
		 $model=Group::model()->findByPk($id);
                 $currentUesrId = Yii::App()->user->id;
                 if(!$model->isGroupOwners($currentUesrId)){
                     throw new CHttpException(404,"You are not the owner");
                 }
                 
                $fileModel=new FileUploadFormModel();
                $fileModel->setScenario(FileUploadFormModel::FILE_UPLOAD_MODE_SINGLE);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
		if(isset($_POST['Group']))
		{
                        $model->setScenario('update'); 
			$model->setAttributes($_POST['Group']);
                        if($model->validate()){
                            
                            $fileModel->LoadUploadedeImage();
                            if($fileModel->isUploadedFile()){
                                
                                if($fileModel->validate()){
                                    
                                    $SavedFileRelativePaths = $fileModel->processImage(get_class($model),$model->group_name,  md5(DateTimeHelper::now()));
                                    $model->icon_src = ArrayHelper::array2string($SavedFileRelativePaths);
                                        
                                    if($model->save()){
                                        Yii::app()->user->setFlash(FlashMsg::SUCCESS, "組織資料已更新");
                                        $this->redirect(array('index'));
                                    }else{
                                        Yii::app()->user->setFlash(FlashMsg::ERROR, "更新組織資料失敗");
                                      }
                                }else{
                                    $this->render('updateUser',array(
                                            'model'=>$model,
                                            'fileModel'=>$fileModel
                                    ));
                                }
                            }
                                
                            if($model->save()){
                                 Yii::app()->user->setFlash(FlashMsg::SUCCESS, "組織資料已更新");
                                $this->redirect(array('index'));
                            }
				
                        }
                            
		}
                    
		$this->render('update',array(
			'model'=>$model,
                        'fileModel'=>$fileModel
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            $this->loadModel($id)->deepDelete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
        
        public function actionJoinGroup(){
            if(!isset($_POST['id'])){
                throw new CHttpException(404,'The requested page does not exist.');
            }
            $groupIdToJoin = $_POST['id'];
            $model=$this->loadModel($groupIdToJoin);
            
            if($model->isUserJoined(Yii::app()->user->id)){
                /** unexpected that user can call this action if it is either joined or pending*/
                throw new CHttpException(404,'The requested page does not exist.');
            }
            $relation = new UserMemberGroup;
            $relation->user_id=Yii::app()->user->id;
            $relation->group_id = $model->id;
            $relation->joinded_datetime =  DateTimeHelper::now();
            $relation->is_leader=0; // remember to use 1 for boolean, using true will not make this record saving
            $relation->is_approved=$model->isAutoApprove();
             if($relation->save())
                $this->redirect(Yii::app()->request->urlReferrer);
            
        }
        
        public function actionApproveUser($id,$groupId){
            $model=Group::model()->findByPk($groupId);
            $currentUesrId = Yii::App()->user->id;
            if(!$model->isGroupOwners($currentUesrId)){
                throw new CHttpException(404,"You are not the owner");
            }
            
            $relation = UserMemberGroup::model()->findByPk(array('user_id' => $id, 'group_id' => $groupId));
            $relation->is_approved = 1;
             if($relation->save())
                $this->redirect(Yii::app()->request->urlReferrer);
        }
        
        public function actionDisapproveUser($id,$groupId){
            
            $model=Group::model()->findByPk($groupId);
            $currentUesrId = Yii::App()->user->id;
            if(!$model->isGroupOwners($currentUesrId)){
                throw new CHttpException(404,"You are not the owner");
            }
            
            $relation = UserMemberGroup::model()->findByPk(array('user_id' => $id, 'group_id' => $groupId));
            $relation->is_approved = 0;
             if($relation->save())
                $this->redirect(Yii::app()->request->urlReferrer);
        }
        
        public function actionGroupMemberList($id){
            
            $this->layout = 'memberCenter';
            
            $model=$this->loadModel($id);
            
            $currentUesrId = Yii::App()->user->id;
            if(!$model->isGroupOwners($currentUesrId)){
                throw new CHttpException(404,"You are not the owner");
            }
            
            $allMembers = $model->getAllMembers();
            $memberRelationList = $model->getMemberRelation();
            $this->render('groupMemberList',array(
			'model'=>$model,
                        'allMembers'=>$allMembers,
                        'memberRelationList'=>$memberRelationList
		));
        }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
                $this->layout = '//layouts/groupIndex';
                $model = new Group('search');
                $model->unsetAttributes();  // clear any default values
                if (isset($_GET['Group'])) {
                    $model->attributes = $_GET['Group'];
                }
                $this->render('index', array(
                    'model' => $model,
                ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $this->layout = '//layouts/admin';
		$model=new Group('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Group']))
			$model->attributes=$_GET['Group'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionApprove($id){
            $model=$this->loadModel($id);
            $model->approved =1;
            if($model->save())
                $this->redirect(Yii::app()->request->urlReferrer);
        }
        
        public function actionUnapprove($id){
            $model=$this->loadModel($id);
            $model->approved =0;
            if($model->save())
                $this->redirect(Yii::app()->request->urlReferrer);
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Group the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Group::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Group $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
