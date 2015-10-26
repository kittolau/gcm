<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php $user = $this->user ?>
<!-- Example row of columns -->
<div class="row">

<!-- search bar -->
<div  class="col-xs-12 col-sm-4 col-md-3 col-lg-3"><!-- z-index:1020; - fix for .pull-right on xs widths-->
<!-- user / group -->
<div class="row">
    <div  class="col-xs-12 col-sm-12 col-md-10  col-md-offset-2 col-lg-9 col-lg-offset-3">
				<div  class="list-group panel panel-default">
					<div class="panel-body">
						<div style="height:135px;width:135px; overflow: hidden" class="horizontalCenter">

							<img class="img-responsive horizontalCenter" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $user->icon_src ?>" alt="post image">
						</div>
					</div><!-- icon -->

					<div class="panel-footer">
                                                <div class="row">
                                                    <div class="col-xs-12 text-center">
                                                        <a class="userName" href="<?php echo Yii::app()->createUrl('user/view',  SeoHelper::userViewSEORouteArrayParam($user))?>"> <?php echo $user->nickname ?> </a><br><span>(<?php echo $user->id ?>)</span>
                                                    </div>
                                                    <br>
                                                    <?php $this->Widget('UserFollowWidget',array(
                                                    'user'=>$user,
                                                    ))?>

                                                </div>

					</div><!--user name / user id -->
				</div><!-- user / group panel -->

                                <?php $isJobAccepting = $user->accept_job ?>
                                <?php if($isJobAccepting){ ?>
				<div class="panel panel-success">
				  <div class="panel-heading">
					<div class="row">
					  <div class="col-xs-3">
						<i style="font-size: 32px" class="glyphicon glyphicon-ok-sign"></i>
					  </div>
					  <div class="col-xs-9 text-right">
						<h4>接受工作委託</h4>
					  </div>
					</div>
				  </div>
                                    <!--
				  <a href="#">
					<div class="panel-footer announcement-bottom">
					  <div class="row">
						<div class="col-xs-6">
						  查看過去委託作品
						</div>
						<div class="col-xs-6 text-right">
						  <i class="glyphicon glyphicon-circle-arrow-right"></i>
						</div>
					  </div>
					</div>
				  </a>
                                    -->
				</div><!-- job accept panel -->
				<?php }else{ ?>
				<div class="panel panel-danger">
				  <div class="panel-heading">
					<div class="row">
					  <div class="col-xs-3">
						<i style="font-size: 32px" class="glyphicon glyphicon-remove-sign"></i>
					  </div>
					  <div class="col-xs-9 text-right">
						<h4>暫不接受委託</h4>
					  </div>
					</div>
				  </div>
                                    <!--
				  <a href="#">
					<div class="panel-footer announcement-bottom">
					  <div class="row">
						<div class="col-xs-8">
						  查看過去委託作品
						</div>
						<div class="col-xs-4 text-right">
						  <i class="glyphicon glyphicon-circle-arrow-right"></i>
						</div>
					  </div>
					</div>
				  </a>
                                    -->
				</div><!-- job accept panel -->
                                <?php } ?>
				<!--
				<div  class="list-group panel panel-default">
					<div class="panel-heading list-group-item text-center hidden-xs panel-heading-smaller">
						<h6>
							<span class="pull-left">正在關注</span>
							<span class="glyphicon glyphicon-check pull-right"></span>
							<span class="clearfix"></span>
						</h6>
					</div><!-- header -->
				<!--
					<div class="panel-body zeroPanding">
						<div class="pull-left followingIcon">
							<img class="img-responsive  pull-leftfollowingIcon"  src="img/Cat-cats-32958715-1440-900.jpg" alt="post image">
						</div>
						<div class="pull-left followingIcon">
							<img class="img-responsive"  src="img/Cat-cats-32958715-1440-900.jpg" alt="post image">
						</div><div class="pull-left followingIcon">
							<img class="img-responsive"  src="img/Cat-cats-32958715-1440-900.jpg" alt="post image">
						</div>
						<div class="pull-left followingIcon">
							<img class="img-responsive"  src="img/Cat-cats-32958715-1440-900.jpg" alt="post image">
						</div>
						<div class="pull-left followingIcon">
							<img class="img-responsive"  src="img/Cat-cats-32958715-1440-900.jpg" alt="post image">
						</div>
						<div class="pull-left followingIcon">
							<img class="img-responsive"  src="img/Cat-cats-32958715-1440-900.jpg" alt="post image">
						</div>
					</div><!-- following user icon -->
				<!--</div><!-- following panel -->

				<!--
				<div  class="list-group panel panel-default userDetailPanel">
					<div class="panel-heading list-group-item text-center hidden-xs">
						<h6>
							<span class="pull-left">用戶資料</span>
							<span class="glyphicon glyphicon-list-alt pull-right"></span>
							<span class="clearfix"></span>
						</h6>
					</div><!-- header -->
				<!--
					<ul class="list-group ">
						<li class="list-group-item">連絡方式：</li>
						<li class="list-group-item">Dapibus ac facilisis in</li>
						<li class="list-group-item">Morbi leo risus</li>
						<li class="list-group-item">Porta ac consectetur ac</li>
						<li class="list-group-item">Vestibulum at eros</li>
					</ul>
				</div><!-- user detail panel -->

				<div  class="list-group panel panel-default userBelongGroupPanel">
					<div class="panel-heading list-group-item text-center hidden-xs">
						<h6>
							<span class="pull-left">所屬組織</span>
							<span class="glyphicon glyphicon-tower pull-right"></span>
							<span class="clearfix"></span>
						</h6>
					</div><!-- header -->

					<div class="panel-body">
                                                <?php $Group_arr = $user->getAllJoinedGroup() ?>
                                                <?php foreach($Group_arr as $group){ ?>
						<div class="media">
                                                    <a class="pull-left" rel="tooltip" title="<?php echo $group->group_name?>" href="<?php echo Yii::app()->createUrl('group/view',  SeoHelper::groupViewSEORouteArrayParam($group))?>">
								<div style="height:39px;width:60px;">
									<img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $group->icon_src?>" alt="post image">
								</div>
							</a>
							<div class="media-body">
								<a class="pull-left" rel="tooltip" title="<?php echo $group->group_name?>" href="<?php echo Yii::app()->createUrl('group/view',SeoHelper::groupViewSEORouteArrayParam($group))?>">
									<h4 class=" textOverflow forceInline" title="<?php echo $group->group_name?>">
										<?php echo $group->group_name?>
									</h4>
								</a>
							</div>

						</div>
                                                <?php } ?>
					</div>

					<div class="panel-footer">
						<div class="row">
							<div class="col-xs-12">
								<!--<a class="btn btn-link btn-sm pull-right" href="#">  more </a>-->
                                                                <p></p>
								<span class="clearfix"></span>
							</div>
					</div><!--user name / user id -->
					</div>
				</div><!-- user group panel -->
                </div>
    </div>
</div><!-- SIDE BAR END -->

<!-- CONTENT SIDE-->
<div class="col-sm-9 col-lg-8">

<?php echo $content; ?>

</div>
</div>

<?php $this->endContent(); ?>
