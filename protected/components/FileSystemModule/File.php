<?php

/**
 *  This provide a high level method for you to query or manipulate the files.
 */
class File{
    
    private $physicalPath;
    private $path_parts;
    
    public function __construct($path) {
        /* convert all relative path to physical path */
        $this->physicalPath = realpath($path);
        
        if(!is_file($this->physicalPath)){
            throw new Exception($physicalPath.' is not a file');
        }
        
        $this->path_parts = pathinfo($this->physicalPath);
    }
/** @public-command */
    
    public function getFullPhysicalPath(){
        return $this->physicalPath;
    }
    
    /**
     * 
     * @return string "myfile.txt"
     */
    public function getBaseName(){
        return $this->path_parts['basename'];
    }
    
    /**
     * 
     * @return string "myfile"
     */
    public function getFileName(){
        
        /* since basename() have bugs with chinese charactor 
        return basename($physicalPath); 
         */
        return $this->path_parts['filename'];
    }
    
    /**
     * 
     * @return string "txt"
     */
    public function getExstension(){
        return $this->path_parts['extension'];
    }
    
    public function getFolder(){
        $folderPhysicalPath = $this->path_parts['dirname'];
        return new Folder($folderPhysicalPath);
    }

/** @public-command */
    public function delete(){
        if(is_readable($this->physicalPath)){
            unlink($this->physicalPath);
        }
    }
}
