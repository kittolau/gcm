<?php $this->widget('zii.widgets.CMenu',array(
        'encodeLabel'=>false,
        'items'=>array(
            array('label'=>'投稿'.Illust::ILLUST_CAT_TITLE, 'itemOptions'=>array('class'=>''),'url'=>array('memberCenter/CreateIllust','mode'=>Illust::ILLUST),'template'=>'{menu}'),
            array('label'=>'投稿'.Illust::MANGA_CAT_TITLE, 'itemOptions'=>array('class'=>''),'url'=>array('memberCenter/CreateIllust','mode'=>Illust::MANGA),'template'=>'{menu}'),
        ),
        'htmlOptions'=>array('class'=>'nav nav-tabs'), //the css class of the ul
        'itemCssClass'=>'',//the css class of the li
        'activeCssClass'=>'active'
)); ?>