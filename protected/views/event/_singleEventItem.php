<?php
/* @var $this IllustController */
/* @var $data Illust */
?>
<div class="col-xs-12 eventHover">
						<div class="row">

							<div class="col-xs-12">
                                                            <div class="media">
                                                                <a class="pull-left" href="<?php echo $this->createUrl('event/view',SeoHelper::eventViewSEORouteArrayParam($data))?>">
                                                                    <img class="img-responsive lazy list-item-image" src="/img/loader.gif" style="width: 150px;height:150px" data-src="/<?php echo CHtml::encode($data->icon_thumbnail_src); ?>" alt="post image">
                                                                  </a>

                                                                <div class="media-body">
                                                                  <div class=" textOverflow forceInline" title="<?php echo CHtml::encode($data->title); ?>">
                                                                    <b>
                                                                        <a href="<?php echo $this->createUrl('event/view',SeoHelper::eventViewSEORouteArrayParam($data))?>">
                                                                            <h3><span class="label label-warning"><?php echo CHtml::encode($data->title); ?></span></h3>
                                                                        </a>
                                                                    </b>
								</div><!-- title -->
                                                                <br>
                                                                  <strong>日期： </strong>
                                                                    <?php echo CHtml::encode($data->event_date); ?>

                                                                  <strong style="margin-left: 30px;">時間： </strong>
                                                                    <?php echo CHtml::encode($data->event_time_interval); ?>
                                                                  <br>
                                                                  <strong>門票： </strong>
                                                                    <?php echo CHtml::encode($data->ticket_price); ?>
                                                                  <br>
                                                                  <strong>地點： </strong>
                                                                    <?php echo CHtml::encode($data->event_place_title); ?>
                                                                  <br>
                                                                  <br>
                                                                </div>
                                                                <div class="list-item-footer">
                                                                    <div class="pull-left">
                                                                        <span class="list-item-footer-item">登錄組織: <?php echo count($data->JoinedGroups); ?></span>
                                                                        <span class="list-item-footer-item">登錄制品: <?php echo CHtml::encode($data->GroupProductsCount); ?></span>
                                                                    </div>

                                                                    <div class="pull-right">
                                                                        <?php if($data->is_doujin){?>
                                                                            <span class="label label-warning">誌</span>
                                                                        <?php }?>
                                                                        <?php if($data->is_cosplay){?>
                                                                            <span class="label label-warning">Cosplay</span>
                                                                        <?php }?>
                                                                        <?php if($data->is_stage){?>
                                                                            <span class="label label-warning">舞台表演</span>
                                                                        <?php }?>

                                                                    </div>

                                                                </div>
                                                          </div>


							</div><!-- left col-->
						</div>
					</div>
<hr class="list-item-hr">
