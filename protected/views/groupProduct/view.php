<?php
/* @var $this IllustController */
/* @var $model Illust */
        $this->openGraphTitle = CHtml::encode($model->title).'@graphic_site';
        $this->openGraphDescription = CHtml::encode($model->product_summary);
        $this->openGraphType = "article";
        $this->openGraphURL = Yii::app()->createAbsoluteUrl('groupProduct/view',array('id'=>$model->id));
        $this->openGraphSiteName = "graphic_site.net";

        $absoluteIMGPath = array();
        foreach($model->getAllSrc() as $relativeIMGPath){
            array_push($absoluteIMGPath, 'http://graphic_site.net/'.$relativeIMGPath);
        }

        $this->openGraphImageArray = $absoluteIMGPath;

        $this->openGraphArticleTagArray = $model->getEventTitleArray();

        $this->openGraphArticlePublishedTime = DTHelper::dtStrToISO8601($model->created_datetime);

        //$this->openGraphArticleAuthor = $model->getFirstOwner()->nickname;

        $this->openGraphArticleSection = $model->getCatName();


?>
<?php $ownedGroup = $model->getOwnedGroup();
        $this->pageTitle = CHtml::encode($model->title)."(".CHtml::encode($ownedGroup->group_name).") - 販賣情報 - ";
        ?>
<!-- group product part -->
<div class="col-12 col-lg-12">
        <ul class="pager">
                <li class="previous"><?php echo $model->getOlderGroupProductLink()?></li>
                <li class="next"><?php echo $model->getNewerGroupProductLink()?></li>
        </ul>
</div><!-- pager -->
<h2 ><?php echo CHtml::encode($model->title); ?></h2>
        <p class=" clearfix">
                <p class=" clearfix">
                        <?php echo CHtml::link(CHtml::encode($model->getCatName()),array('groupProduct/index','GroupProduct[product_catagory_enum]'=>$model->product_catagory_enum)); ?>
                        |
                        <?php echo CHtml::encode($model->popularity); ?> views
                        |
                        <?php echo CHtml::encode($model->created_datetime); ?>
                </p>
        </p>

            <div class="pull-left illust-rating-widget">
                <div>
                    <a class="plurk-share-link" title="Share to Plurk" href="javascript:void(window.open('http://www.plurk.com/?qualifier=shares&status='.concat(encodeURIComponent(window.location.href)).concat(' ').concat('(').concat(encodeURIComponent(document.title)).concat(')')));">
                        <img title="share" src="http://statics.plurk.com/bda225d234426cccca300c551f60438e.png" width="97" height="20" align="absmiddle" border="0" />
                    </a>
                </div>
            </div>

            <div class="pull-left illust-rating-widget">
                <div class="fb-share-button" data-href="<?php echo Yii::app()->createAbsoluteUrl('groupProduct/view',array('id'=>$model->id))?>" data-type="box_count"></div>
            </div>
            <div class="pull-left illust-rating-widget">
                <div class="fb-like" data-href="<?php echo Yii::app()->createAbsoluteUrl('groupProduct/view',array('id'=>$model->id))?>" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
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
                            if($model->isUserIdOwner($userId)  || Yii::app()->user->isAdmin()){
                                ?>
                                <div class="btn-group btn-group-sm pull-right">

                                                                    <?php
                                                                    $url = array('groupProduct/delete','id' =>$model->id);
                                                                    echo CHtml::link(
                                                                            '<i class="glyphicon glyphicon-trash"></i> Delete',
                                                                            $url,
                                                                            array(
                                                                                    'submit' => $url,
                                                                                    //'params' => array('groupProduct/delete','id' =>$model->id),
                                                                                'class'=>"btn btn-primary confirm-on-click",
                                                                            )
                                                                    );
                                                                    ?>


                                                                    </a><!-- user button group-->
                                                                    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('groupProduct/update',array('id'=>$model->id))?>">
                                                                        <i class="glyphicon glyphicon-pencil">
                                                                        </i> Edit
                                                                    </a>
                                                                </div>


                            <?php } ?>
                        <div class="clearfix"></div>


<p class="descriptionsummary">
        <?php echo StringHelper::ConvertNewlineToBRwithHTMLEncode($model->product_summary); ?>
</p><!-- summary -->

<div>

    <p>組織：<?php echo CHtml::link(CHtml::encode($ownedGroup->group_name), SeoHelper::groupViewSEORouteArray($ownedGroup),array('title'=>CHtml::encode($ownedGroup->group_name)))?></p>

        <p>類形：<?php echo CHtml::encode($model->getCatName()); ?></p>
        <p>價格：<?php echo CHtml::encode($model->price); ?></p>

        <?php if($model->isCatOf(GroupProduct::BOOK)){ ?>
            <p>頁數：<?php echo CHtml::encode($model->book_number_of_page); ?></p>
            <p>內頁用料：<?php echo CHtml::encode($model->book_inner_page_materia); ?></p>
            <p>封面用料：<?php echo CHtml::encode($model->book_outer_page_materia); ?></p>
        <?php } ?>
        <?php if($model->isCatOf(GroupProduct::GIFT)){ ?>
            <p>用料：<?php echo CHtml::encode($model->gift_material); ?></p>
        <?php } ?>
        <?php if($model->isCatOf(GroupProduct::ELECT_CAT_TITLE)){ ?>
            <p>試用/聽版本(demo)：<?php echo CHtml::encode($model->elect_demo_url); ?></p>
            <?php if($model->elect_is_selling){ ?>
                <p>電子販賣：<?php echo CHtml::encode($model->elect_selling_url); ?></p>
            <?php } ?>
            <p>size：<?php echo CHtml::encode($model->elect_size); ?></p>
            <p>format：<?php echo CHtml::encode($model->elect_format); ?></p>
        <?php } ?>

        <p>販賣展場：
        <ul class="textOverflow tagContainer">
                                <?php $eventTags = $model->getEventLinks();
                                foreach ($eventTags as $tag){
                                    echo '<li><h5>'.$tag.'</h5></li>';
                                }
                                ?>
                        </ul><!-- tag -->
        </p>
</div><!-- detail part -->

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

<?php
                    $allImgSrc = $model->getAllSrc();
                    foreach($allImgSrc as $imgSrc){
                        $baseURL = Yii::app()->request->baseUrl.'/';
                        echo "<img class='img-responsive lazy img-viewfull' src='".$baseURL."img/loader.gif' data-src='".$baseURL."$imgSrc' alt='post image'>";
                    }

?>

<!-- /group product part -->
 <h3>評論</h3>

                <?php $this->renderPartial('comment.views.comment.commentList', array(
                    'model'=>$model
                )); ?>
