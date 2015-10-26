<?php
/**
 * This was used intentionally to render move information on the URL by using the route params
 * although this is still used today, it just provide the original URL route params now.
 */
class SeoHelper 
{
        private static function spaceConvert($string){
            $purifiedString = CHtml::encode($string);
            $patterns = array();
            $patterns[0] = '/\s+/';
            $patterns[1] = '/(?:\<|\>|\(|\)|\.|\/|"|\')/';
            $replacements = array();
            $replacements[0] = '-';
            $replacements[1] = '';

            return preg_replace($patterns, $replacements, $string);
        }
    
	public static function illustViewSEORouteArrayParam($illust){
            return array(
                'id'=>$illust->id,
                //'seoauther'=>$illust->getFirstOwnedUserName(),
               // 'seotitle'=>SeoHelper::spaceConvert($illust->illust_title),
            );
        }
        
        public static function illustViewSEORouteArray($illust){
           //return array('illust/view','id'=>$illust->id,'seotitle'=>SeoHelper::spaceConvert($illust->illust_title));
            return array('illust/view','id'=>$illust->id);
        }
        
        public static function groupProductViewSEORouteArrayParam($groupProduct){
            return array(
                'id'=>$groupProduct->id,
                //'seoauther'=>$illust->getFirstOwnedUserName(),
                //'seotitle'=>SeoHelper::spaceConvert($groupProduct->title),
            );
        }
        
        public static function groupProductViewSEORouteArray($groupProduct){
           //return array('groupProduct/view','id'=>$groupProduct->id,'seotitle'=>SeoHelper::spaceConvert($groupProduct->title));
           return array('groupProduct/view','id'=>$groupProduct->id);
        }
        
        public static function groupViewSEORouteArrayParam($group){
            return array(
                'id'=>$group->id,
                //'seoauther'=>$illust->getFirstOwnedUserName(),
                //'seotitle'=>SeoHelper::spaceConvert($group->group_name),
            );
        }
        
        public static function groupViewSEORouteArray($group){
           //return array('group/view','id'=>$group->id,'seotitle'=>SeoHelper::spaceConvert($group->group_name));
           return array('group/view','id'=>$group->id);
        }
        
        public static function eventViewSEORouteArrayParam($event){
            return array(
                'id'=>$event->id,
                //'seoauther'=>$illust->getFirstOwnedUserName(),
                //'seotitle'=>SeoHelper::spaceConvert($event->title),
            );
        }
        
        public static function eventViewSEORouteArray($event){
           //return array('group/view','id'=>$event->id,'seotitle'=>SeoHelper::spaceConvert($event->title));
           return array('group/view','id'=>$event->id);
        }
        
        public static function userViewSEORouteArrayParam($user){
            return array(
                'id'=>$user->id,
                //'seoauther'=>$illust->getFirstOwnedUserName(),
                //'seotitle'=>SeoHelper::spaceConvert($user->nickname),
            );
        }
        
        public static function userViewSEORouteArray($user){
           //return array('user/view','id'=>$user->id,'seotitle'=>SeoHelper::spaceConvert($user->nickname));
           return array('user/view','id'=>$user->id);
        }
        
        /** event name, user name */
}