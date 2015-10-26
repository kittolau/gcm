<?php
/**
 * This is used as the tag input widget. This will also include the 
 */
class TagWidget extends CWidget
{

	//remark:
	// this public variable is used as the parameter to accept a user_id
	// that used to get back the model
	//
	// to use this parameter in the view, we simply do something like
	// $this->widget('UserPortlet',array('user_id'=>'1234567');
        const promptText='';
    
        public $form;
	public $fieldName;
	public $model;
        public $explanationText;
        
   
    public function init()
    {
        if($this->model == null){
            throw new Exception("TagWidget cannot init if model is null");
        }
        if($this->fieldName == null){
            throw new Exception("TagWidget cannot init if fieldName is null");
        }
        if($this->form == null){
            throw new Exception("TagWidget cannot init if form is null");
        }
        if($this->explanationText == null){
            $this->explanationText = '輸入TAG後，請按 Enter 以確定使用';
        }
        parent::init();
    }
 
    public function run()
    {
        $this->render('application.components.view._TagWidget',array(
            'model'=>$this->model,
            'fieldName'=>$this->fieldName,
            'explanationText'=>$this->explanationText,
            'form'=>$this->form
        ));
    }
}
?>