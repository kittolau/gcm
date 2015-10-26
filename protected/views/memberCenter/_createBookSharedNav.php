<?php $this->widget('zii.widgets.CMenu',array(
        'encodeLabel'=>false,
        'items'=>array(
            array('label'=>'投稿'.GroupProduct::BOOK_CAT_TITLE, 'itemOptions'=>array('class'=>''),'url'=>array('memberCenter/createGroupProduct','mode'=>GroupProduct::BOOK),'template'=>'{menu}'),
            array('label'=>'投稿'.GroupProduct::GIFT_CAT_TITLE, 'itemOptions'=>array('class'=>''),'url'=>array('memberCenter/createGroupProduct','mode'=>GroupProduct::GIFT),'template'=>'{menu}'),
            array('label'=>'投稿'.GroupProduct::ELECT_CAT_TITLE, 'itemOptions'=>array('class'=>''),'url'=>array('memberCenter/createGroupProduct','mode'=>GroupProduct::ELECT),'template'=>'{menu}'),
        ),
        'htmlOptions'=>array('class'=>'nav nav-tabs'), //the css class of the ul
        'itemCssClass'=>'',//the css class of the li
        'activeCssClass'=>'active'
)); ?>