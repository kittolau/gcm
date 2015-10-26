<?php
/**
 * This is used as a widget to show the limited number of Popular Illust project
 */
class PopularIllustWidget extends CWidget
{
    public function init()
    {
        parent::init();
    }
 
    public function run()
    {
        $mostPopularNonR18Illust = Illust::getNonR18MostPopular(5);
        $mostPopularR18Illust = Illust::getR18MostPopular(5);
        $this->render('application.components.view._PopularIllustWidget',array(
            'mostPopularNonR18Illust'=>$mostPopularNonR18Illust,
        ));
    }
}
?>