<?php

class EventController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/eventIndex.php'.
	 */
	public $layout='//layouts/eventIndex';
        
        /**
         * @var eventModel the model used to pass into the //layouts/eventDetail layout
         */
        public $eventDetail_model;
        
	/**
	 * Yii Action filer config for this controller
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
         * callback used by "accessControl" action filer
         */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','passedEvent','eventGroup','eventGroupProduct'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('empty'),
                                'users'=>array('@'),
				//'users'=>array('admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update'),
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
            $this->layout='//layouts/main';
            $model = Event::model()->with(array('GroupProductsCount','JoinedGroups'))->findByPk($id);
            if($model == null){
                throw new CHttpException(404,'The specified Event cannot be found.');
            }
            
            $groupProduct = new GroupProduct('search');
            $groupProduct->unsetAttributes();  // clear any default values
            if (isset($_GET['GroupProduct'])) {
                $groupProduct->attributes = $_GET['GroupProduct'];
            }
            $this->render('view',array(
                    'model'=>$model,
                    'GroupProductModel'=>$groupProduct,
                    'viewData'=>$groupProduct->getOnlyEventData($id)
            ));
	}
        
        
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Event;
                $fileModel=new FileUploadFormModel();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
                $this->layout = '//layouts/admin';
                
		if(isset($_POST['Event']))
		{
                        //db transaction start
                        $transaction = Yii::app()->db->beginTransaction();
                        try{
                            $model->attributes=$_POST['Event'];
                            if($model->save()){
                                $fileModel->LoadUploadedeImage();
                                $fileModel->setScenario(FileUploadFormModel::FILE_UPLOAD_MODE_SINGLE);
                                if($fileModel->isUploadedFile()){
                                    if($fileModel->validate()){
                                    $ips = new ImageProcessService($fileModel, get_class($model), $model->id, "icon");
                                    $ips->saveImage(300,300);
                                    $SavedFileRelativePaths = $ips->getOriginalImageVirtualPath();
                                    $SavedThumbnailFileRelativePaths = $ips->getThumbnailImageVirtualPath();
                                    $model->save_img_src($SavedFileRelativePaths,$SavedThumbnailFileRelativePaths);
                                    
                                    $transaction->commit();
                                    $this->redirect(array('view','id'=>$model->id));
                                    }
                                }else{
                                    $model->save_img_src(array('img/Event/default.jpg'),array('img/Event/default.jpg'));
                                    $transaction->commit();
                                    $this->redirect(array('view','id'=>$model->id));
                                }
                            }
                                
                        } catch (Exception $ex) {
                            $transaction->rollback();
                            Yii::app()->user->setFlash(FlashMsg::ERROR, $e->getMessage());
                        }
			
		}

		$this->render('create',array(
			'model'=>$model,
                        'fileModel'=>$fileModel
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
                $fileModel=new FileUploadFormModel();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
                $this->layout = '//layouts/admin';
                
		if(isset($_POST['Event']))
		{
                        $transaction = Yii::app()->db->beginTransaction();
                        try{
                            $model->attributes=$_POST['Event'];
                            if($model->save()){
                                $fileModel->LoadUploadedeImage();
                                $fileModel->setScenario(FileUploadFormModel::FILE_UPLOAD_MODE_SINGLE);
                                if($fileModel->isUploadedFile()){
                                    if($fileModel->validate()){
                                    $ips = new ImageProcessService($fileModel, get_class($model), $model->id, "icon");
                                    $ips->saveImage(300,300);
                                    $SavedFileRelativePaths = $ips->getOriginalImageVirtualPath();
                                    $SavedThumbnailFileRelativePaths = $ips->getThumbnailImageVirtualPath();
                                    $model->save_img_src($SavedFileRelativePaths,$SavedThumbnailFileRelativePaths);
                                    
                                    $transaction->commit();
                                    $this->redirect(array('view','id'=>$model->id));
                                    }
                                }else{
                                    $transaction->commit();
                                    $this->redirect(array('view','id'=>$model->id));
                                }
                            }
                                
                        } catch (Exception $ex) {
                            $transaction->rollback();
                            Yii::app()->user->setFlash(FlashMsg::ERROR, $e->getMessage());
                        }
			
		}

		$this->render('create',array(
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new Event('search');
                $model->unsetAttributes();  // clear any default values
                if (isset($_GET['Event'])) {
                    $model->attributes = $_GET['Event'];
                }
                $this->render('index', array(
                    'model' => $model,
                    'indexData' => $model->getIndexData()
                ));
	}
        
        public function actionEventGroupProduct($id)
        {
            $this->layout='//layouts/eventDetail';
            $this->eventDetail_model = Event::model()->with(array('GroupProductsCount','JoinedGroups'))->findByPk($id);
            
            if($this->eventDetail_model == null){
                throw new CHttpException(404,'The specified Event cannot be found.');
            }
            
            $model = new GroupProduct('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['GroupProduct'])) {
                $model->attributes = $_GET['GroupProduct'];
            }
            
            $this->render('eventGroupProduct', array(
                    'dataprovider' => $model->getOnlyEventData($id)
                ));
        }
        
        public function actionEventGroup($id)
        {
            $this->layout='//layouts/eventDetail';
            $this->eventDetail_model = Event::model()->with(array('GroupProductsCount','JoinedGroups'))->findByPk($id);
            
            if($this->eventDetail_model == null){
                throw new CHttpException(404,'The specified Event cannot be found.');
            }
            
            $model = new Group('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Group'])) {
                $model->attributes = $_GET['Group'];
            }
            
            $this->render('eventGroup', array(
                    'dataprovider' => $model->getOnlyEventData($id)
                ));
        }
        
        public function actionPassedEvent()
	{
                $this->layout='//layouts/main';
		$model = new Event('search');
                $model->unsetAttributes();  // clear any default values
                if (isset($_GET['Event'])) {
                    $model->attributes = $_GET['Event'];
                }
                $this->render('passedEvent', array(
                    'model' => $model,
                    'passedEventData' => $model->getPassedEventData()
                ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $this->layout = '//layouts/admin';
		$model=new Event('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Event']))
			$model->attributes=$_GET['Event'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Event the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Event::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
         * Yii generated method for ajax client side validation
         * We seldom to use this method
         */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
