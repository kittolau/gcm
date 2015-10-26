<?php
        
        if($model == null){
            throw new Exception("_BSTagListWidget cannot init if model is null");
        }

        $isMethodExist = method_exists($model, 'getTags');
        if(!$isMethodExist){
            throw new Exception(sprintf("[_BSTagListWidget]%s does not have getTags(), missing implementation?",  get_class($model)));
        }
        $tags_arr = $model->getTags();
        $croppedTags_arr = array_slice($tags_arr, 0, 4);
        foreach($croppedTags_arr as $tag)
        {
                $htmlEncodedTagName = CHtml::encode($tag);
                $url=$this->createUrl('illust/index',array('search'=>$htmlEncodedTagName));
                //echo CHtml::link($htmlEncodedTagName,array('illust/index','search'=>$htmlEncodedTagName),array('class'=>'label label-info','title'=>$htmlEncodedTagName));
                echo "<a href='$url' title='$htmlEncodedTagName'> <span class='label label-info'> $htmlEncodedTagName </span> </a>";
        }
?>
