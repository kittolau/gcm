<?php
/**
 * to manipulate the file system in a static method way. Unlike FileSystemModule which is used with a file or folder object.
 */
class FileSystemService{
    
    public static function removeFile($fullFilePath){
        $realPath = realpath($fullFilePath);
        if(is_readable($realPath)){
            unlink($realPath);
        }
    }
    
    public static function getRootPath(){
        $appRootPath=Yii::getPathOfAlias('webroot').'/'; // e.g. 'c:/htdocs/'
        return $appRootPath;
    }
    
    public static function imgRelativePathBuilder($mainFolderName,$subFolderName,$fileName_withExstension){
        $img_dir='img/'; 
        $mainFolder_dir=$mainFolderName.'/'; // e.g. 'main/'
        $subFolder_dir=$subFolderName.'/'; // 'sub/'
        $fileName=$fileName_withExstension; // 'img_name'
        
        $relativePath = $img_dir.$mainFolder_dir.$subFolder_dir; // e.g. 'img/main/sub/' for webpage use
        return $relativePath;
    }
    
    public static function imgPhysicalPathBuilder($mainFolderName,$subFolderName,$fileName_withExstension){
        $relativeFilePath = FileSystemService::imgPhysicalPathBuilder($mainFolderName, $subFolderName, $fileName_withExstension);
        $appRootPath=Yii::getPathOfAlias('webroot').'/'; // e.g. 'c:/htdocs/'
        
        $physicalPath = $appRootPath.$relativeFilePath;
        return $physicalPath;
    }
    
    public static function dtStrToISO8601($DT_string){
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $DT_string); 
        return $date->format(DateTime::ISO8601);
    }
}
?>
