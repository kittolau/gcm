<?php
/**
 * See Event Controller for controller details
 */
class IllustController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';
        //left col variable
        public $user; //for viewIllust
        
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete,Bookmark', // we only allow deletion via POST request
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
				'actions'=>array('index','view','search'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','Bookmark','delete'),
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            $this->layout='//layouts/user';
            $illust = Illust::model()->with('Owners')->findByPk($id);
            if($illust == null){
                throw new CHttpException(404,'The specified post cannot be found.');
            }

            $this->user = $illust->getFirstOwnedUser();
            
            $illust->tryIncrementViewCount(Yii::app()->user->id);
            
            $illust->tryIncrementNonUserViewCount();
            
            $this->render('view',array(
                    'model'=>$illust,
            ));
	}
        
        public function actionBookmark(){
            $IllustToBookmarkId = $_POST["id"];
            $IllustToBookmark = Illust::model()->findByPk($IllustToBookmarkId);
            if($IllustToBookmark == null){
                Yii::app()->user->setFlash(FlashMsg::ERROR,"找不到相關作品");
                throw new CHttpException(404,'找不到相關作品');
            }
            
            $current_user_id = Yii::app()->user->id;
            $currentUser = User::model()->findByPk(Yii::app()->user->id);
            
            if($IllustToBookmark->isBookmarkedByUser($currentUser->id)){
                $currentUser->unbookmarkIllust($IllustToBookmarkId);
                Yii::app()->user->setFlash(FlashMsg::WARNING,"你已取消收藏 ".$IllustToBookmark->illust_title);
                $this->redirect(Yii::app()->request->urlReferrer);
            }else{
                $currentUser->bookmarkIllust($IllustToBookmarkId);
                Yii::app()->user->setFlash(FlashMsg::SUCCESS,"你收藏了".$IllustToBookmark->illust_title);
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Illust;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Illust']))
		{
			$model->attributes=$_POST['Illust'];
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
                $userId = Yii::app()->user->id;
                
		$model=$this->loadModel($id);
                
                
                if(!$model->isUserIdAuthor($userId)){
                    if(!Yii::app()->user->isAdmin()){
                            throw new CHttpException(404,'The specified post cannot be found.');
                    }
                    
                }
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Illust']))
		{
			$model->attributes=$_POST['Illust'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
                //$id=$_POST['id'];
		$illust = $this->loadModel($id);
                
                if(Yii::app()->user->isAdmin()){
                    $illust->deepDelete();
                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                     if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }else{
                    $userId = Yii::app()->user->id;

                    if(!$illust->isUserIdAuthor($userId)){
                        throw new CHttpException(404,'The specified post cannot be found.');
                    }

                    $illust->deepDelete();
                    Yii::app()->user->setFlash(FlashMsg::WARNING, " 已移除個人作品");
                     $this->redirect(array('memberCenter/manageIllust'));
                }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{            
                $this->layout= '//layouts/illustIndex';
            
                $model = new Illust('search');
                $model->unsetAttributes();  // clear any default values
                if (isset($_GET['Illust'])) {
                    $model->attributes = $_GET['Illust'];
                }
                $this->render('index', array(
                    'model' => $model,
                ));
	}
        
        public function actionSearch()
	{
            $this->layout= '//layouts/illustIndex';
                $model = new Illust('search');
                $model->unsetAttributes();  // clear any default values
                if (isset($_GET['Illust'])) {
                    $model->attributes = $_GET['Illust'];
                }
                if (isset($_GET['tag'])) {
                    $model->tag = $_GET['tag'];
                }
                
                $this->render('search', array(
                    'model' => $model,
                    'tag'=>$model->tag
                ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $this->layout = '//layouts/admin';
		$model=new Illust('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Illust']))
			$model->attributes=$_GET['Illust'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Illust the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Illust::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Illust $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='illust-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
