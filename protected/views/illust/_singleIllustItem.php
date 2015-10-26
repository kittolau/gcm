<?php
/* @var $this IllustController */
/* @var $data Illust */
?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 itemHover">
						<div class="row">
							<div class="col-xs-5 col-sm-5 col-md-4 col-lg-6">
                                                            <a href="<?php echo $data->getViewURL()?>" class="thumbnail">
									<div class="illustThumbnail">
										<img class="img-responsive lazy" src="/img/loader.gif" data-src="<?php echo CHtml::encode($data->getFirstThumnailImgSrc()); ?>" alt="post image">
									</div>
								</a>
							</div><!-- right thumbnail col -->
						
							<div class="col-xs-7 col-sm-6 ">
								<h4 class=" textOverflow forceInline" title="<?php echo CHtml::encode($data->illust_title); ?>">
                                                                    <b><a href="<?php echo $data->getViewURL()?>">
									<?php echo CHtml::encode($data->illust_title); ?>
                                                                    </a>
                                                                    </b>
								</h4><!-- title -->
							
                                                                <?php $IllustOwner = $data->getFirstOwner()?>
								<p class="textOverflow forceInline">
                                                                    By <a href="<?php echo Yii::app()->createUrl('user/view',  SeoHelper::userViewSEORouteArrayParam($IllustOwner))?>" title="<?php echo CHtml::encode($IllustOwner->nickname); ?>"><?php echo CHtml::encode($IllustOwner->nickname); ?></a>
								</p><!-- auther -->
                                                                <h6 class=" clearfix">
                                                                        <small>
                                                                        <?php echo CHtml::encode($data->getCatName()); ?>
                                                                        |
                                                                        <?php echo CHtml::encode($data->popularity); ?> views
                                                                        | 
                                                                        <span class="timeago" title="<?php echo CHtml::encode(DTHelper::dtStrToISO8601($data->created_datetime)); ?>"></span>
                                                                       </small>
                                                                </h6>
								<ul class="textOverflow tagContainer">
									<?php $tagLinks_arr = $data->getTagsLink();
                                                                        foreach ($tagLinks_arr as $tagLink){
                                                                            echo '<li>'.$tagLink.'</li>';
                                                                        }
                                                                        ?>
								</ul><!-- tag -->
							</div><!-- left col-->
						</div>
					</div>