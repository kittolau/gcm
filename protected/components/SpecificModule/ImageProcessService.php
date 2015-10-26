<?php

/**
 * This is a class that is specifically build for this application
 * Mainly used by calling the saveImage() and get the saved image path and saved thumbnail path
 */
class ImageProcessService{
    private $folderPhysicalPath;
    private $folderVirtualPath;
    private $fileName;
    private $FileUploadFormModel;
    
    public function __construct($FileUploadFormModel,$mainFolderName,$subFolderName,$fileName_noExtension) {
        $appRootPath=Yii::getPathOfAlias('webroot'); // e.g. 'c:/htdocs'
        $imgDirName = 'img';
        $imgDir='/'.$imgDirName; 
        $mainFolder_dir= '/' . $mainFolderName; // e.g. '/main'
        $subFolder_dir= '/' . $subFolderName; // '/sub'
        
        $this->FileUploadFormModel = $FileUploadFormModel;
        $this->fileName= $fileName_noExtension; // 'img_name'
        $this->folderPhysicalPath = $appRootPath.$imgDir.$mainFolder_dir.$subFolder_dir; // e.g. 'c:/htdocs/main/sub' for saving file
        $this->folderVirtualPath = $imgDirName.$mainFolder_dir.$subFolder_dir; // e.g. 'img/main/sub' for webpage use
    }
    
    private $savedFileName_Array;
    private $savedThumbnailFileName_Array;
    
    public function saveImage($thumbnailHeight, $thumbnailWidth){
        $folderPhysicalPath = $this->folderPhysicalPath;
        $isFolderExist = is_dir($folderPhysicalPath);
        if(!$isFolderExist) {
             // recursive mkdir
            mkdir($folderPhysicalPath,0777,true);
            chmod($folderPhysicalPath, 0755); 
        }
        
        //save the image
        $this->savedFileName_Array = $this->FileUploadFormModel->saveImage($folderPhysicalPath,$this->fileName);
        
        //save the image as thumbnail
        $allImagePhysicalPath = $this->getSavedImagePhysicalPathArray($this->savedFileName_Array);
        $fileObjectArray = $this->getSavedImageFileObjectArray($allImagePhysicalPath);
        $this->savedThumbnailFileName_Array = array();
        foreach ($fileObjectArray as $fileObject ){
            $thumbGen = new ThumbnailImageGenerator($fileObject->getFullPhysicalPath());
            
            $filename = $fileObject->getFileName();
            $thumbnailFileName = 'f'.$filename.'.jpg';
            
            $thumbGen->saveAsThumbnail($this->folderPhysicalPath, $thumbnailFileName, $thumbnailHeight, $thumbnailWidth);
            array_push($this->savedThumbnailFileName_Array, $thumbnailFileName);
        }
    }
    
    private function getSavedImageFileObjectArray($fileFullPath_Array){
        $fileObject = array_map(
                function($elem){
                     return new File($elem);
                 },$fileFullPath_Array);
        return $fileObject;
    }
    
    private function getSavedImagePhysicalPathArray($fileName_array){
        $SavedFileRelativePaths = array();
        foreach ($fileName_array as $savedFileName) {
            $picName = '/' . $savedFileName; //'/saveImg_1.jpg'
            $relativePathWithFileName = $this->folderPhysicalPath . $picName; // 'c:/htdocs/main/sub/img_name_1.jpg'
            array_push($SavedFileRelativePaths, $relativePathWithFileName);
        }
        return $SavedFileRelativePaths;
    }
    
    private function getSavedImageVirtualPath($fileName_array){
        $SavedFileRelativePaths = array();
        foreach ($fileName_array as $savedFileName) {
            $picName = '/' . $savedFileName; //'/saveImg_1.jpg'
            $relativePathWithFileName = $this->folderVirtualPath . $picName; // 'img/main/sub/img_name_1.jpg'
            array_push($SavedFileRelativePaths, $relativePathWithFileName);
        }
        return $SavedFileRelativePaths;
    }
    
    /**
     * @return saved original image virtual path
     */
    public function getOriginalImageVirtualPath(){
        return $this->getSavedImageVirtualPath($this->savedFileName_Array);
    }
    
    public function getThumbnailImageVirtualPath(){
        return $this->getSavedImageVirtualPath($this->savedThumbnailFileName_Array);
    }
}

