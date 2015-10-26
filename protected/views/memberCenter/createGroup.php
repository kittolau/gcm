<?php

$this->pageTitle=Yii::app()->name . ' - Register';
CHtml::$afterRequiredLabel='<span class="required"> (必須)</span>';
?>
<?php
JSHelper::lockSubmitButtonOnSubmit();
JSHelper::preventEnterKeySubmit();
?>
<?php
$this->pageTitle = "組織創立 - 會員中心 - ";
?>
<ol class="breadcrumb">
        <li class="active"> <span class="glyphicon glyphicon-chevron-down"></span>組織創立</li>
</ol>

    <div class="row">
    <div class="col-md-4 col-md-push-7" style="">
        <dl>
            <dt>創立組織需知</dt>
            <dd>
                <ol>
                    <li>開設組織(需人手審核)</li>
                    <li>如己參加過活動，把參展報到書加到附件中
                (只需要報到書和組織名，其他個人資料請自行處理)</li>
                    <li>由於負責人的權限(包括刪除組織)不可簡單地易手，所以請由真正的負責人作出申請。</li>
                    <li>如屬新組織從未參與任何活動，請提供公式網站及連結。並以上述網站中的組織 E-mail 提出申請。</li>
                    <li>無意參展的網絡創作組織不受理。</li>
                    <li> 這類申請不保證會通過審批。</li>
                </ol>
            </dd>
          </dl>
    </div>
    <div class="col-md-7 col-md-pull-4" style="">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groupCreate-form',
	'enableClientValidation'=>true,
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('class'=>'form col-md-12 center-block','enctype' => 'multipart/form-data','multiple'=>'multiple'),
        'clientOptions'=>  JSHelper::CActiveFormClientOptionsForBSWidget(),
        'focus'=>array($model,'illust_title'),
        'errorMessageCssClass'=>'has-error'
        )); ?>

            <div class="form-group ">
                <label >負責人</label>
                <input class="form-control" placeholder="" type="text" maxlength="50" value="<?php echo Yii::app()->user->user_name?>" disabled="disabled">
            </div>

            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'group_name',
                'model'=>$model,
                'explanationText'=>''
            ))?>

            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'group_summary',
                'model'=>$model,
                'explanationText'=>''
            ))?>

            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'website_url',
                'model'=>$model,
                'explanationText'=>''
            ))?>

            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'contact_email',
                'model'=>$model,
                'explanationText'=>''
            ))?>

            <?php $this->renderPartial('/site/_BSTextFieldWidget',array(
                'form'=>$form,
                'fieldName'=>'facebook_url',
                'model'=>$model,
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



