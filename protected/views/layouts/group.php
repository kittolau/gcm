<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php $group = $this->group ?>
<!-- Example row of columns -->
<div class="row">

<!-- search bar -->
<div  class="col-xs-12 col-sm-4 col-md-3 col-lg-3"><!-- z-index:1020; - fix for .pull-right on xs widths-->
<!-- user / group -->
<div class="row">
    <div  class="col-xs-12 col-sm-12 col-md-10  col-md-offset-2 col-lg-9 col-lg-offset-3">

				<div  class="list-group panel panel-default">
					<div class="panel-body">
						<div style="height:100px;width:150px; overflow: hidden" class="horizontalCenter">
							<img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $group->icon_src ?>" alt="post image">
						</div>
					</div><!-- icon -->
					
					<div class="panel-footer">
						<div class="row">
							<div class="col-xs-12 text-center">
                                                            <a class="groupName" href="<?php echo Yii::app()->createUrl('group/view',  SeoHelper::groupViewSEORouteArrayParam($group))?>"></i>  <?php echo CHtml::encode($group->group_name) ?> </a><br><span>(<?php echo $group->id ?>)</span>
							</div>
							<br>
							<?php $this->Widget('GroupFollowWidget',array(
                                                        'group'=>$group,
                                                        ))?>
                                                        
                                                        <?php $this->Widget('JoinGroupWidget',array(
                                                        'group'=>$group,
                                                        ))?>
							
						</div>
					</div><!--user name / user id -->
				</div><!-- user / group panel -->
				
				<div class="panel panel-default" data-ui-comp="group-info">
                                    <!-- Default panel contents -->
                                    <div class="panel-heading">組織資訊</div>
                                    <div class="panel-body">
                                      <p><?php echo CHtml::encode($group->group_summary); ?></p>
                                    </div>

                                    <!-- List group -->
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                      </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col col-xs-6 col-sm-12">
                                                    是否招募中？
                                                </div>
                                                <div class="col col-xs-6 col-sm-12">
                                                    <?php echo CHtml::encode($group->is_recuiting); ?>
                                                </div>                            
                                            </div>
                                        </li>
                                      <li class="list-group-item">
                                          <div class="row">
                                                <div class="col col-xs-6 col-sm-12">
                                                    EMAIL:
                                                </div>
                                                <div class="col col-xs-6 col-sm-12">
                                                    <?php echo CHtml::encode($group->contact_email); ?>
                                                </div>                            
                                            </div>
                                      </li>
                                      <li class="list-group-item">
                                          <div class="row">
                                                <div class="col col-xs-6 col-sm-12">
                                                    facebook:
                                                </div>
                                                <div class="col col-xs-6 col-sm-12">
                                                    <?php echo CHtml::encode($group->facebook_url); ?>
                                                </div>                            
                                            </div>
                                      </li>
                                      
                                      <li class="list-group-item">
                                          <div class="row">
                                                <div class="col col-xs-6 col-sm-12">
                                                    公式網站：
                                                </div>
                                                <div class="col col-xs-6 col-sm-12">
                                                    <?php echo CHtml::encode($group->website_url); ?>
                                                </div>                            
                                            </div>
                                      </li>
                                    </ul>
                                  </div>
			
				
				<div  class="list-group panel panel-default userBelongGroupPanel">
					<div class="panel-heading list-group-item text-center hidden-xs">
						<h6>
							<span class="pull-left">人員</span> 
							<span class="glyphicon glyphicon-tower pull-right"></span>
							<span class="clearfix"></span>
						</h6>
					</div><!-- header -->
				
					<div class="panel-body">
                                                <?php $user_arr = $group->getAllApprovedGroupMember() ?>
                                                <?php foreach($user_arr as $user){ ?>
						<div class="media">
							<a class="pull-left" rel="tooltip" title="<?php echo $user->nickname ?>" href="<?php echo Yii::app()->createUrl('user/view',SeoHelper::userViewSEORouteArrayParam($user))?>">
								<div style="height:48px;width:48px;">
									<img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $user->icon_src ?>" alt="post image">
								</div>
							</a>
							<div class="media-body">
								<a class="pull-left" rel="tooltip" title="<?php echo $user->nickname ?>" href="<?php echo Yii::app()->createUrl('user/view',SeoHelper::userViewSEORouteArrayParam($user))?>">
									<h4 class=" textOverflow forceInline" title="<?php echo $user->nickname ?>">
										<?php echo $user->nickname ?>
									</h4>
								</a>
							</div>

						</div>
                                                <?php } ?>
					</div>
					
					<div class="panel-footer">
						<div class="row">
							<div class="col-xs-12">
								<a class="btn btn-link btn-sm pull-right" href="#">  more </a>
								<span class="clearfix"></span>
							</div>
					</div><!--user name / user id -->
					</div>
				</div><!-- group menber panel -->
                                </div>
    </div>
</div><!-- SIDE BAR END -->
	  
<!-- CONTENT SIDE-->
<div class="col-sm-9 col-lg-8">
 
<?php echo $content; ?>

</div>
</div>

<?php $this->endContent(); ?>