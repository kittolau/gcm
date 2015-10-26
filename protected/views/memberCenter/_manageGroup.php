<?php
/* @var $this IllustController */
/* @var $data Illust */
?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 itemHover">
						<div class="row">
							<div class="col-xs-5 col-sm-5 col-md-4 col-lg-6">
								<a href="<?php echo $this->createUrl('illust/view',SeoHelper::illustViewSEORouteArrayParam($data))?>" class="thumbnail">
									<div class="illustThumbnail">
										<img class="img-responsive lazy" src="<?php echo Yii::app()->request->baseUrl; ?>/img/loader.gif" data-src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo CHtml::encode($data->getFirstImgSrc()); ?>" alt="post image">
									</div>
								</a>
							</div><!-- right thumbnail col -->
						
							<div class="col-xs-7 col-sm-6 ">
								<h4 class=" textOverflow forceInline" title="<?php echo CHtml::encode($data->illust_title); ?>">
                                                                    <b><a href="<?php echo $this->createUrl('illust/view',SeoHelper::illustViewSEORouteArrayParam($data))?>">
									<?php echo CHtml::encode($data->illust_title); ?>
                                                                    </a>
                                                                    </b>
								</h4><!-- title -->
                                                                <h6 class=" clearfix">
                                                                        <small>
                                                                        <?php echo CHtml::encode($data->getCatName()); ?>
                                                                        |
                                                                        <?php echo CHtml::encode($data->popularity); ?> views
                                                                        | 
                                                                        <span class="timeago" title="<?php echo CHtml::encode(DTHelper::dtStrToISO8601($data->created_datetime)); ?>"></span>
                                                                       </small>
                                                                </h6>
                                                                <br>
                                                                <div class="col-xs-12 btn-group-vertical btn-group-sm">
                                                                    
                                                                    <?php
                                                                    $url = array('illust/delete','id'=>$data->id);
                                                                    echo CHtml::link(
                                                                            '<i class="glyphicon glyphicon-trash"></i> Delete',
                                                                            $url,
                                                                            array(
                                                                                    'submit' => array('illust/delete','id'=>$data->id),
                                                                                    //'params' => array('id' =>$data->id),
                                                                                'class'=>"btn btn-primary confirm-on-click",
                                                                            )
                                                                    );
                                                                    ?>
      
                                                                        
                                                                    </a><!-- user button group-->
                                                                    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('illust/update',array('id'=>$data->id))?>">
                                                                        <i class="glyphicon glyphicon-pencil">
                                                                        </i> Edit
                                                                    </a>   
                                                                </div>
                                                                
								<ul class="textOverflow tagContainer">
									<?php 
                                                                        /*
                                                                        $tagLinks_arr = $data->getTagsLink();
                                                                        foreach ($tagLinks_arr as $tagLink){
                                                                            echo '<li>'.$tagLink.'</li>';
                                                                        }
                                                                         * */
                                                                         
                                                                        ?>
								</ul><!-- tag -->
							</div><!-- left col-->
						</div>
					</div>