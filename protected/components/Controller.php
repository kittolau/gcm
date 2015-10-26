<?php
/**
 * Base controller generated by Yii
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

        public $openGraphTitle = "graphic site";
        public $openGraphDescription = "";
        public $openGraphType = "website";
        public $openGraphURL = "http://graphic_site.net";

        public $openGraphSiteName = "graphic site";

        public $openGraphImage = 'http://graphic_site.net/img/logo/mainlogo.png';
        public $openGraphImageArray = array();

        public $openGraphArticleTagArray = array();
        public $openGraphArticleSection="";
        public $openGraphArticleAuthor = "";
        public $openGraphArticlePublishedTime = "";

}