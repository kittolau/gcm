<?php
/* @var $this GroupProductController */
/* @var $model GroupProduct */
/* @var $form CActiveForm */
JSHelper::ApplyServersideValidationErrorToInputField();
?>

<ol class="breadcrumb">
        <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span>更新販賣<?php echo $model->GroupProduct_cat_title?></li>
</ol>
		
    <div class="row">
    <div class="col-md-2" style="">
    </div>
    <div class="col-md-7" style="">
    
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'group-product-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableClientValidation'=>true,
        'htmlOptions' => array('class'=>'form col-md-12 center-block'),
        'clientOptions'=>  JSHelper::CActiveFormClientOptionsForBSWidget(),    
        'focus'=>array($model,'title'),
        'errorMessageCssClass'=>'has-error'
)); ?>

	<?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'title',
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

            <?php $this->Widget('TagWidget',array(
                'form'=>$form,
                'fieldName'=>'tag',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSListBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'new_event_arr_id',
                'model'=>$model,
                'explanationText'=>'',
                'option'=>Event::getListDataForAllEventAvailable()
            ))?>
        
            <?php if($model->product_catagory_enum == GroupProduct::BOOK){?>
                
                <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'book_inner_page_materia',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'book_outer_page_materia',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php } ?>
        
            <?php if($model->product_catagory_enum == GroupProduct::ELECT){?>
        
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'elect_demo_url',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'elect_demo_url',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'elect_format',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php } ?>
        
            <?php if($model->product_catagory_enum == GroupProduct::GIFT){?>
                
                <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'gift_material',
                'model'=>$model,
                'explanationText'=>''
            ))?>
        
            <?php } ?>
        
	<?php $this->renderPartial('/site/_BSSubmitButtonWidget')?>

<?php $this->endWidget(); ?>
    </div>
    <div class="col-md-6" style="">

    </div>
</div>

    