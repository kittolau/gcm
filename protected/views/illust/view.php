<?php
/* @var $this IllustController */
/* @var $model Illust */
        $this->openGraphTitle = CHtml::encode($model->illust_title).'@';
        $this->openGraphDescription = CHtml::encode($model->illust_summary);
        $this->openGraphType = "article";
        $this->openGraphURL = Yii::app()->createAbsoluteUrl('illust/view',array('id'=>$model->id));
        $this->openGraphSiteName = "";

        $absoluteIMGPath = array();
        foreach($model->getMangaAllImgSrc() as $relativeIMGPath){
            array_push($absoluteIMGPath, ''.$relativeIMGPath);
        }

        $this->openGraphImageArray = $absoluteIMGPath;

        $this->openGraphArticleTagArray = $model->getTags();

        $this->openGraphArticlePublishedTime = DTHelper::dtStrToISO8601($model->created_datetime);

        //$this->openGraphArticleAuthor = $model->getFirstOwner()->nickname;

        $this->openGraphArticleSection = $model->getCatName();
?>
<?php
$this->pageTitle = CHtml::encode($model->illust_title)."(".CHtml::encode($model->getFirstOwner()->nickname).") - 個人作品 - ";
?>
<div class="col-12 col-lg-12">
			<ul class="pager">

				<li class="previous"><?php echo $model->getOlderIllustViewLink(); ?></li>
				<li class="next"><?php echo $model->getNewerIllustViewLink(); ?></li>
			</ul>
		</div><!-- pager -->

<!-- group product part -->
		<h2 ><?php echo CHtml::encode($model->illust_title); ?></h2>
			<p class=" clearfix">
				<?php echo CHtml::link(CHtml::encode($model->getCatName()),array('illust/index','Illust[illust_category_enum]'=>$model->illust_category_enum)); ?>
				|
				<?php echo CHtml::encode($model->popularity); ?> views
                                |
				<?php echo CHtml::encode($model->created_datetime); ?>
			</p>

                            <div class="pull-left illust-rating-widget">
                            <?php $this->Widget('IllustFollowWidget',array(
                                                    'illust'=>$model,
                                                    ))?>

                            </div>



                            <div class="pull-left illust-rating-widget">
                                <a class="plurk-share-link" title="Share to Plurk" href="javascript:void(window.open('http://www.plurk.com/?qualifier=shares&status='.concat(encodeURIComponent(window.location.href)).concat(' ').concat('(').concat(encodeURIComponent(document.title)).concat(')')));">
                                    <img title="share" src="http://statics.plurk.com/bda225d234426cccca300c551f60438e.png" width="97" height="20" align="absmiddle" border="0" />
                                </a>
                            </div>

                            <div class="pull-left illust-rating-widget">
                                <div class="fb-share-button" data-href="<?php echo Yii::app()->createAbsoluteUrl('illust/view',array('id'=>$model->id))?>" data-type="box_count"></div>
                            </div>
                            <div class="pull-left illust-rating-widget">
                                <div class="fb-like" data-href="<?php echo Yii::app()->createAbsoluteUrl('illust/view',array('id'=>$model->id))?>" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
                            </div>



                            <div class="pull-right illust-rating-widget">
                                <div>
                                    <div class="bubble "> <i class="glyphicon glyphicon-eye-open"></i> <?php echo CHtml::encode($model->non_user_popularity); ?> </div>
                                    <h5><span class="label label-default">
                                                   檢視數
                                            </span><!-- user button group-->
                                                    </h5>
                                </div>
                            </div>

                           <div class="pull-right illust-rating-widget">
                                <div>
                                    <div class="bubble "> <i class="glyphicon glyphicon-eye-open"></i> <?php echo CHtml::encode($model->popularity); ?> </div>
                                    <h5><span class="label label-default">
                                                   用戶檢視數
                                            </span><!-- user button group-->
                                                    </h5>
                                </div>
                            </div>

                            <?php

                            $userId = Yii::app()->user->id;
                            if($model->isUserIdAuthor($userId) || Yii::app()->user->isAdmin()){
                                ?>
                                <div class="btn-group btn-group-sm pull-right">

                                                                    <?php
                                                                    $url = array('illust/delete','id'=>$model->id);
                                                                    echo CHtml::link(
                                                                            '<i class="glyphicon glyphicon-trash"></i> Delete',
                                                                            $url,
                                                                            array(
                                                                                    'submit' => array('illust/delete','id'=>$model->id),
                                                                                    //'params' => array('id' =>$data->id),
                                                                                'class'=>"btn btn-primary confirm-on-click",)
                                                                    );
                                                                    ?>


                                                                    </a><!-- user button group-->
                                                                    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('illust/update',array('id'=>$model->id))?>">
                                                                        <i class="glyphicon glyphicon-pencil">
                                                                        </i> Edit
                                                                    </a>
                                                                </div>


                            <?php } ?>
                        <div class="clearfix"></div>



		<p class="descriptionsummary">
			<?php echo StringHelper::ConvertNewlineToBRwithHTMLEncode($model->illust_summary); ?>
		</p><!-- summary -->

		<div class="panel panel-default">
			<div class="panel-heading">
				<h5>
                                    <span style="float: left;">Tag :</span>
                                <ul class="viewtagContainer">
                                        <?php $tagLinks_arr = $model->getAllTagsLink();
                                        foreach ($tagLinks_arr as $tagLink){
                                            echo '<li>'.$tagLink.'</li>';
                                        }
                                        ?>
                                </ul><!-- tag -->
                                <div class="clearfix"></div>
				</h5>
			</div>
		</div><!-- tag panel -->
		<?php if($model->isCatOf(Illust::ILLUST)){?>
		<img class="img-responsive lazy" src="<?php echo Yii::app()->request->baseUrl; ?>/img/loader.gif" data-src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $model->img_src?>" alt="post image">
                <?php }else if($model->isCatOf(Illust::MANGA)){
                    $allImgSrc = $model->getMangaAllImgSrc();
                    foreach($allImgSrc as $imgSrc){
                        $baseURL =  Yii::app()->request->baseUrl.'/';
                        echo "<img class='img-responsive lazy img-viewfull' src='".$baseURL."img/loader.gif' data-src='".$baseURL."$imgSrc' alt='post image'>";
                    }
                }
                ?>
		<!-- /group product part -->
                <h3>評論</h3>

                <?php $this->renderPartial('comment.views.comment.commentList', array(
                    'model'=>$model
                )); ?>
