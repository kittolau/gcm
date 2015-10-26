<?php
/**
 * See Event Controller for controller details
 */
class GroupProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';
        
        //left col variable
        public $group; //for viewGroupProduct
        
        public $mostPopularPopular;
        
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('create','update','delete'),
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
            $this->layout='//layouts/group';
            $model=GroupProduct::model()->with('group')->findByPk($id);
            if($model == null){
                throw new CHttpException(404,'The specified post cannot be found.');
            }
            $this->group = $model->getOwnedGroup();
            
            $model->tryIncrementViewCount(Yii::app()->user->id);
            
            $model->tryIncrementNonUserViewCount();
            
            $this->render('view',array(
                    'model'=>$model,
            ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new GroupProduct;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GroupProduct']))
		{
			$model->attributes=$_POST['GroupProduct'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

        public function actionSearch()
	{
            
            $this->layout= '//layouts/groupProductIndex';
                $model = new GroupProduct('search');
                $model->unsetAttributes();  // clear any default values
                if (isset($_GET['GroupProduct'])) {
                    $model->attributes = $_GET['GroupProduct'];
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                
            
		$model=$this->loadModel($id);
                 
                $userId = Yii::app()->user->id;
                if(!$model->isUserIdOwner($userId)){
                    if(!Yii::app()->user->isAdmin()){
                        throw new CHttpException(404,'The specified post cannot be found.');
                    }
                }
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GroupProduct']))
		{
			$model->attributes=$_POST['GroupProduct'];
			if($model->save()){
                            $model->updateJoinEvents();
                            $this->redirect(array('view','id'=>$model->id));
                        }
				
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
		$groupProduct = $this->loadModel($id);
                
                
                if(Yii::app()->user->isAdmin()){
                    $groupProduct->delete();
                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }else{
                    $groupId = $groupProduct->group_id;
                    
                    $userId = Yii::app()->user->id;
                    if(!$groupProduct->isUserIdOwner($userId)){
                        throw new CHttpException(404,'The specified post cannot be found.');
                    }
                    
                    $groupProduct->delete();
                    
                    Yii::app()->user->setFlash(FlashMsg::WARNING, "已移除販賣情報");
                    
                    $this->redirect(array('group/view','id'=>$groupId));
                }
                
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
                $this->layout= '//layouts/groupProductIndex';
            
		$model = new GroupProduct('search');
                $model->unsetAttributes();  // clear any default values
                if (isset($_GET['GroupProduct'])) {
                    $model->attributes = $_GET['GroupProduct'];
                }
                $this->render('index', array(
                    'model' => $model,
                    'dataprovider'=>$model->getIndexData()
                ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $this->layout = '//layouts/admin';
		$model=new GroupProduct('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GroupProduct']))
			$model->attributes=$_GET['GroupProduct'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return GroupProduct the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=GroupProduct::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param GroupProduct $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='group-product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
