<?php
/* @var $this GroupController */
/* @var $model Group */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Group', 'url'=>array('index')),
	array('label'=>'Create Group', 'url'=>array('create')),
	array('label'=>'View Group', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Group', 'url'=>array('admin')),
);
$this->pageTitle = "更新組織資訊 - 組織 - ";

?>


<ol class="breadcrumb">
        <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span>個人資料更新</li>
</ol>

    <div class="row">
    <div class="col-md-4 col-md-push-7" style="">

    </div>
    <div class="col-md-7 col-md-pull-4" style="">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groupUpdate-form',
	'enableClientValidation'=>true,
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('class'=>'form col-md-12 center-block','enctype' => 'multipart/form-data','multiple'=>'multiple'),
        'clientOptions'=>  JSHelper::CActiveFormClientOptionsForBSWidget(),
        'focus'=>array($model,'illust_title'),
        'errorMessageCssClass'=>'has-error'
        )); ?>

            <div class="form-group ">
                <label >組織名稱</label>
                <input class="form-control" placeholder="" type="text" maxlength="50" value="<?php echo $model->group_name?>" disabled="disabled">
            </div>

            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'website_url',
                'model'=>$model,
                'explanationText'=>'需要加上 http:// 或 https://'
            ))?>

            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'facebook_url',
                'model'=>$model,
                'explanationText'=>'需要加上 http:// 或 https://'
            ))?>


            <?php $this->renderPartial('/site/_BSCheckBoxWidget',array(
                'form'=>$form,
                'fieldName'=>'is_auto_approved',
                'model'=>$model,
                'explanationText'=>''
            ))?>

            <?php $this->renderPartial('/site/_BSTextAreaWidget',array(
                'form'=>$form,
                'fieldName'=>'group_summary',
                'model'=>$model,
                'rows'=>'5',
                'explanationText'=>''
            ))?>

         <?php $this->renderPartial('/site/_BSFileUploadWidget',array(
                'form'=>$form,
                'model'=>$fileModel,
                'explanationText'=>''
            ))?>


            <?php $this->renderPartial('/site/_BSSubmitButtonWidget')?>
          <?php $this->endWidget(); ?>
    </div>

</div>

