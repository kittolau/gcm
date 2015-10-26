<?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'title',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSMultiFileUploadWidget',array(
                'form'=>$form,
                'model'=>$fileModel,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'is_r18',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'is_bl',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'price',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextAreaWidget',array(
                'form'=>$form,
                'fieldName'=>'product_summary',
                'model'=>$model,
                'rows'=>'5',
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSDropDownListWidget',array(
                'form'=>$form,
                'fieldName'=>'group_id',
                'model'=>$model,
                'explanationText'=>'',
                'option'=>User::getListDataForGroupOwner(Yii::app()->user->id)
            ))?>
        
            <?php $this->renderPartial('/site/_BSListBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'event_arr_id',
                'model'=>$model,
                'explanationText'=>'',
                'option'=>Event::getListDataForAllEventAvailable(),
                'preselected_id'=>$preselected_event_id
            ))?>

            <?php $this->Widget('TagWidget',array(
                'form'=>$form,
                'fieldName'=>'tag',
                'model'=>$model,
                'explanationText'=>''
            ))?>