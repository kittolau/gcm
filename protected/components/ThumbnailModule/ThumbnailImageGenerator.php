<?php

/**
 * This is a class used to generate a thumbnail image
 */
class ThumbnailImageGenerator{
    
    private $filePath;
    
    public function __construct($OriginalImagePhysicalPath) {
        $this->filePath = $OriginalImagePhysicalPath;
    }
    
    public function saveAsThumbnail($folderPath , $fileName_withExtension,$targetHeight,$targetWidth){
        
        /* load up the image */
        $image = Yii::app()->image->load($this->filePath);
        
        
        
        /* determine the original image property landscape or protrait */
        $imageWidth = $image->width;
        $imageHeight = $image->height;
        $isImageLandscape = $imageWidth > $imageHeight;
        $isImageProtrait = $imageHeight > $imageWidth;
        $isImageSquare = $imageHeight == $imageWidth;

        /* determine the target image property */
        $isTargetImageLandscape = $targetWidth > $targetHeight;
        $isTargetImageProtrait = $targetHeight > $targetWidth;
        $isTargetImageSquare = $targetHeight == $targetWidth;
        
        $finalImagePath = $folderPath . '/' . $fileName_withExtension;
        
        if (file_exists($finalImagePath)) {
            $file = new File($finalImagePath);
            $file->delete();
        }
        
        $image->resize($targetWidth,$targetHeight,Image::WIDTH);
        
        $resizeFactor = $targetWidth / $imageWidth;
        
        $resizedImageHeight = ceil($imageHeight * $resizeFactor);
        if($resizedImageHeight < $targetHeight){
            $image->crop($targetHeight,$targetWidth);
            $image->resize($targetWidth,$targetHeight,Image::HEIGHT);
        }else if($resizedImageHeight > $targetHeight){
            $image->crop($targetHeight,$targetWidth);
        }
        $image->save($finalImagePath);
        
        
        
        return $finalImagePath;
        
        //$image->resize(400, 100)->rotate(-45)->quality(75)->sharpen(20);
        //$image->save(); // or $image->save('images/small.jpg');
    }
}