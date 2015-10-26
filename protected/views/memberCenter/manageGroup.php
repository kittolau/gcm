<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
JSHelper::SubmitOnDropDownListChange('#GroupSelect');
$this->pageTitle = "組織管理 - 會員中心 - ";
?>

<h4>組織管理</h4>
<div class="panel">
    <div class="panel-body">
        <?php $form=$this->beginWidget('CActiveForm', array(
	//'id'=>'groupProduct-form',
	//'enableClientValidation'=>true,
        //'enableAjaxValidation'=>false,
        //'htmlOptions' => array('class'=>'form col-md-12 center-block','enctype' => 'multipart/form-data','multiple'=>'multiple'),
        //'clientOptions'=>  JSHelper::CActiveFormClientOptionsForBSWidget(),
        //'focus'=>array($model,'title'),
        //'errorMessageCssClass'=>'has-error'
        )); ?>

        <div class="row">
            <div class="input-group input-group-sm col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <span class="input-group-addon">正在管理</span>
            <select id="GroupSelect" name="manageGroupId" class=" form-control">
            <?php
                    for($i=0;$i<count($ownedGroupArray);$i++){
                        $group = $ownedGroupArray[$i];
                        $isSelected="";
                        if($manageGroup->id == $group->id){
                            $isSelected="selected";
                        }

                        print "<option value='".$group->id."' ".$isSelected.">".$group->group_name."</option>";
                    }
                ?>
           </select>
            </div>
            <div class="input-group input-group-sm col-xs-12 col-sm-4 col-md-3 col-lg-3">
                <?php echo CHtml::link('申請創立更多組織',array('memberCenter/createGroup'),array('class'=>'btn btn-primary btn-sm'));?>
            </div>
        </div>
        <?php if($manageGroup != null){ ?>
        <div class="row">
            <div class="col-xs-12">
                <p>申請狀態:
                    <?php if($manageGroup->isApproved()){ ?>
                    <span class="label label-success">已接納</span>
                    <?php }else{ ?>
                    <span class="label label-warning">等待申請</span>
                    <?php } ?>
                <p>
                    <?php if($manageGroup->isApproved()){
                    echo CHtml::link(CHtml::encode("更新組織資訊"), array('group/update', 'id'=>$manageGroup->id));
                    echo "<br/>";
                    echo CHtml::link(CHtml::encode("管理組員"), array('group/groupMemberList', 'id'=>$manageGroup->id));
                    } ?>
            </div>
        </div>
        <?php } ?>

    <?php $this->endWidget(); ?>
    </div>
</div>

