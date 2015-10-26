<?php

/**
 *  This provide a high level method for you to query or manipulate the folder and file objects.
 */
class Folder{
    
    private $physicalPath;
    
    public function __construct($path) {
        $this->physicalPath = realpath($path);
        if(!is_dir($this->physicalPath)){
            throw new Exception($physicalPath.' is not a folder');
        }
    }
    
/** @public-query */
    
    public function getFullPhysicalPath(){
        return $this->physicalPath;
    }
    
    private function getParentFolderName(){
        return dirname($this->physicalPath);
    }
    
    public function getParentFolder(){
        $parentFolderPhysicalPath = $this->getParentFolderName();
        return new Folder($parentFolderPhysicalPath);
    }
    
    public function getContainedFolder(){
        $result = array(); 
        
        $cdir = scandir($this->physicalPath);
        foreach ($cdir as $key => $value) 
        { 
            /* filter out "." and ".." */
            if(in_array($value,array(".",".."))){
                continue;
            }
            
            $fullPath = $this->physicalPath . DIRECTORY_SEPARATOR . $value;
            
            if (is_dir($fullPath)) 
            { 
               $folderObject = new Folder($fullPath);
               $result[] = $fileObject; 
            }   
        } 
        return $result; 
    }
    
    public function getContainedFiles(){
        $result = array(); 
        
        $cdir = scandir($this->physicalPath);
        foreach ($cdir as $key => $value) 
        { 
            /* filter out "." and ".." */
            if(in_array($value,array(".",".."))){
                continue;
            }
            
            $fullPath = $this->physicalPath . DIRECTORY_SEPARATOR . $value;
            
            if (is_file($fullPath)) 
            { 
               $fileObject = new File($fullPath);
               $result[] = $fileObject; 
            }   
        } 
        return $result; 
    }
    
    public static function isFolderExist($path){
        $physicalPath = realpath($path);
        $isFolderExist = is_dir($physicalPath);
        return $isFolderExist;
    }

    public  function getFolderName(){
        return basename($this->physicalPath);
    }
    
/** @public-command */
    public function rename($newName){
        
        $folderBasePath = $this->getParentFolderName() . DIRECTORY_SEPARATOR;
        $FolderNewName = $folderBasePath . $newName;
        
        /* check if the new name exist */
        if(is_dir($FolderNewName)){
            throw new Exception($FolderNewName.' already exist');
        }
        
        rename($this->physicalPath,$newName);
    }

    public static function tryCreateFolder($path){
        $physicalPath = realpath($path);
        /* check if the folder is exist */
        if(!is_dir($physicalPath)) {
            mkdir($physicalPath,0777,true); // recursive mkdir
            chmod($physicalPath, 0755); 
        }
    }
}