<?php
/**
 * This is used as a widget to show the limited number of Popular Group project
 */
class PopularGroupProductWidget extends CWidget
{
    public function init()
    {
        parent::init();
    }
 
    public function run()
    {
        $mostPopularNonR18GroupProduct = GroupProduct::getNonR18MostPopular(5);
        $mostPopularR18GroupProduct = GroupProduct::getR18MostPopular(5);
        $this->render('application.components.view._PopularGroupProductWidget',array(
            'mostPopularNonR18GroupProduct'=>$mostPopularNonR18GroupProduct,
        ));
    }
}
?>