<?php
/**
 * The form model used to handle the file uploading and file saving
 */
class FileUploadFormModel extends CFormModel
{
    const FILE_UPLOAD_MODE_SINGLE="single";
    const FILE_UPLOAD_MODE_MULTI="multi";
    
    
    //the private field to be used to stoer the file arr
    const MULTI_FILE_FIELD_NAME="photos";
    const SINGLE_FILE_FIELD_NAME="photo";
    public $photos;
    public $photo;
    
    public $allowEmpty=false;
    
    //this is used by multifileupload widget cilent side validation
    private $BSWidgetAccept='jpg|gif|png';
    public function getClientSideAcceptFormat(){
        return $this->BSWidgetAccept;
    }
    private $BSWidgetMaxFile=32;
    public function getClientSideMaxFile(){
        return $this->BSWidgetMaxFile;
    }

    /**
     * This should be called first before any of the below method is called, otherwise that will not work
     */
    public function LoadUploadedeImage(){
        $this->photos=CUploadedFile::getInstances($this,FileUploadFormModel::MULTI_FILE_FIELD_NAME);
        $this->photo=CUploadedFile::getInstance($this,FileUploadFormModel::SINGLE_FILE_FIELD_NAME);
    }
    
    public function isUploadedFile(){
        $isUploadedMultifile = count($this->photos) !=0;
        if($isUploadedMultifile){
            return true;
        }
        $isUploaded = $this->photo != NULL;
        return $isUploaded;
    }
    
    /**
     * can be used to change the validation rule if needed
     * default allow empty is false
     */
    public function uploadIsNotCompulsory(){
        $allowEmpty=true;
    }
    
    
    /**
     * the new verions of saving the image, this method just help you save the image
     */
    public function saveImage($folderPath , $fileName_noExtension){
        
        /* check if folder is valid */
        $physicalPath = realpath($folderPath);
        if(!is_dir($physicalPath)){
            throw new Exception($physicalPath.' is not a folder');
        }
        
        /* handle single image upload case */
        $isSinglePhotoUpload = $this->photo !=null && count($this->photos) == 0;
        if($isSinglePhotoUpload){
            //this should be the single file upload case
            array_push($this->photos, $this->photo);
        }
        
        $isPhotosExist = isset($this->photos) && count($this->photos) > 0;
        //if ($isPhotosExist) {
            /* save each uploaded file */
            $SavedFileNames = array();  
            $counter=1;
            foreach ($this->photos as $image => $pic) {
                $picName = sprintf("%s_%s.%s",$fileName_noExtension,$counter,$pic->extensionName); // 'img_name_1.jpg'
                if ($pic->saveAs($physicalPath . '/' . $picName)) {
                    array_push($SavedFileNames, $picName); 
                    $counter++;
                }
                else{
                    throw new Exception("File cannot be saved");
                }
            }
            return $SavedFileNames;
        //}else{
        //    return array();
        //}
    }
    
    /**
     * the old version of saving the image, some part is still using it
     */
    public function processImage($mainFolderName,$subFolderName,$fileName_noExtension){
            
            $appRootPath=Yii::getPathOfAlias('webroot').'/'; // e.g. 'c:/htdocs/'
            $img_dir='img/'; 
            $mainFolder_dir=$mainFolderName.'/'; // e.g. 'main/'
            $subFolder_dir=$subFolderName.'/'; // 'sub/'
            $fileName=$fileName_noExtension; // 'img_name'
            
            if($this->photo !=null && count($this->photos) == 0){
                //this should be the single file upload case
                array_push($this->photos, $this->photo);
            }
            
            if (isset($this->photos) && count($this->photos) > 0) {
                $relativePath = $img_dir.$mainFolder_dir.$subFolder_dir; // e.g. 'img/main/sub/' for webpage use
                $physicalPath = $appRootPath.$img_dir.$mainFolder_dir.$subFolder_dir; // e.g. 'c:/htdocs/main/sub/' for saving file
                
                if(!is_dir($physicalPath)) {
                    mkdir($physicalPath,0777,true); // recursive mkdir
                    chmod($physicalPath, 0755); 
                }
                
                
                // go through each uploaded image
                
                $SavedFileRelativePaths = array();
                
                $counter=1;
                foreach ($this->photos as $image => $pic) {
                    $picName = sprintf("%s_%s.%s",$fileName_noExtension,$counter,$pic->extensionName);
                    if ($pic->saveAs($physicalPath.$picName)) {
                        // add it to the main model now
                        //$this->img_src = $userIllustDirPath.'/'.$picName; //it might be $img_add->name for you, filename is just what I chose to call it in my model
                        
                        $relativePathWithFileName = $relativePath.$picName; // 'img/main/sub/img_name_1.jpg'
                        
                        array_push($SavedFileRelativePaths, $relativePathWithFileName);
                        $counter++;
                    }
                    else{
                        throw new Exception("File cannot be saved");
                    }
                }
                return $SavedFileRelativePaths;
            }
        }
        
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
                        array(FileUploadFormModel::MULTI_FILE_FIELD_NAME,'required','message'=>'必須上存最少1張圖片','on'=>FileUploadFormModel::FILE_UPLOAD_MODE_MULTI),
                        array(FileUploadFormModel::MULTI_FILE_FIELD_NAME,'file',
                            'maxSize'=>1024 * 1024 * 2, // 4MB
                            'minSize'=>1024 * 1, //1KB
                            'maxFiles'=>$this->BSWidgetMaxFile,
                            /*
                             * FUCK! if you set this to 1, you must not use multiple file uploader
                             * you cannot use maxFiles=1 and multiplefileuploader in the same time
                             * 
                             * the problem is that when you use multiplefileupload but set maxFiles=1
                             * In yii framework, when it get the file validator, it will check
                             * if($this->maxFiles > 1)
                             * if this false, then it will ASSUME that you used single file upload
                             * and try to get the file by using
                             * $file = CUploadedFile::getInstance($object, $attribute);
                             * that is why when you used multiplefileupload, you will get null if getInstance() is called
                             * and then if it cannot get the file, it will assume that the file is not uploaded
                             * that is why you always get 'no uploaded file'
                             * 
                             */
                            'enableClientValidation'=>0,
                            'allowEmpty'=>$this->allowEmpty,
                            //this will not work for multifile
                            'tooLarge'=>'{file}不能超過2MB',
                            'tooMany'=>'上存圖片不能超過2張',
                            'tooSmall'=>'{file}不能小於1KB',
                            'types'=>'gif,jpeg,jpg,png',
                            'message'=>'必須上存最少1張圖片',
                            'wrongMimeType'=>'mime type is wrong',
                            'wrongType'=>'{file}圖片格式必須是{extensions}',
                            'on'=>FileUploadFormModel::FILE_UPLOAD_MODE_MULTI
                            ),
                            array(FileUploadFormModel::SINGLE_FILE_FIELD_NAME,'file',
                            'types'=>'gif,jpeg,jpg,png',
                            'maxSize'=>1024 * 1024 * 2, // 4MB
                            'minSize'=>1024 * 1, //56KB
                            'maxFiles'=>1,
                            'enableClientValidation'=>0,
                            'allowEmpty'=>$this->allowEmpty, // need to be uploaded
                            'tooLarge'=>'圖片不能超過2MB',
                            'tooMany'=>'上存圖片不能超過1張',
                            'tooSmall'=>'圖片不能小於1KB',
                            'message'=>'必須上存圖片',
                            'wrongMimeType'=>'mime type is wrong',
                            'wrongType'=>'圖片格式必須是{extensions}',
                            'on'=>FileUploadFormModel::FILE_UPLOAD_MODE_SINGLE
                            ),
                        );
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			FileUploadFormModel::MULTI_FILE_FIELD_NAME=>'多項圖片上存',
                        FileUploadFormModel::SINGLE_FILE_FIELD_NAME=>'圖片上存',
		);
	}
}
