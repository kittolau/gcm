<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->pageTitle = "組員名單 - 組織 - ";
?>
<h4><?php echo CHtml::encode($model->group_name).'組員名單';?></h4>
<hr/>
<table class="table table-hover">
    <thead>
        <tr>
            <th>名稱</th>
            <th>狀態</th>
            <th>加入時間</th>
            <th>會長</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($memberRelationList as $memberRelation){ ?>
        <tr>
            <?php

            $member;
            foreach($allMembers as $user){
                if($memberRelation->user_id == $user->id){
                    $member = $user;
                }
            }
            ?>

            <td><?php echo CHtml::link(CHtml::encode($member->nickname), array('user/view', 'id'=>$member->id)); ?></td>
          <td>
              <?php
              if($memberRelation->is_approved){
                  echo '已確認';
              }else{
                  echo '等待確認';
              }
              ?>
          </td>
          <td><?php echo CHtml::encode($memberRelation->joinded_datetime)?></td>
          <td>
              <?php
              if($memberRelation->is_leader){
                  echo '*';
              }
              ?>
          </td>
          <td>
            <?php
            if(!$memberRelation->is_leader){
                if($memberRelation->is_approved){
                  //echo CHtml::link(CHtml::encode("確認加入"), array('group/approveUser', 'id'=>$member->id,'groupId'=>$model->id));
                  echo CHtml::link(
                        CHtml::encode("取消確認"),
                        array('group/disapproveUser'),
                        array(
                                'submit' => array('group/disapproveUser','id'=>$member->id,'groupId'=>$model->id),
                                //'params' => array('id' =>$data->id),
                            'class'=>"confirm-on-click",
                        )
                );
              }else{
                  echo CHtml::link(
                        CHtml::encode("確認加入"),
                        array('group/approveUser'),
                        array(
                                'submit' => array('group/approveUser','id'=>$member->id,'groupId'=>$model->id),
                                //'params' => array('id' =>$data->id),
                            'class'=>"confirm-on-click",
                        )
                );
              }
            }
              ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
</table>
