<?php

/**
 * This is the model class for table "illust".
 *
 * The followings are the available columns in table 'illust':
 * @property integer $id
 * @property integer $illust_catagory_id
 * @property string $created_datetime
 * @property integer $popularity
 * @property string $illust_summary
 * @property string $tag
 * @property string $img_src
 * @property integer $is_r18
 * @property integer $is_bl
 * @property integer $is_deleted
 * @property integer $illust_category_enum
 * @property string $illust_title
 * @property string $update_datetime
 * The followings are the available model relations:
 * @property IllustCategory $illustCatagory
 * @property User[] $users
 * @property User[] $users1
 * @property User[] $users2
 */
/** go to Group.php to see more detail */
class Illust extends CActiveRecord
{
/** @constant */
        const uniqueTagPrefix='{~}';
    
        
        const TAG_ALLOWED_COUNT_ON_CREATE=10;
       
        const ILLUST=1;
        const MANGA=2;
        
        const ILLUST_CAT_TITLE='插畫';
        const MANGA_CAT_TITLE='漫畫';
/** @public-data-member */
        public $Illust_cat_title;
/** @private-data-member */
        private $_oldTags;
/** @framework-specific */
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'illust';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        //all
                        //array('illust_title','match','pattern'=>'/^[a-zA-Z0-9\s\x{4E00}-\x{9FFF}]*$/u','message'=>'只可使用 中文, 英文 或 數字'),
                        array('illust_title','match','pattern'=>'/^[\S]+/u','message'=>'不能以空白鍵開頭'),
                        array('illust_title', 'length','min'=>1 ,'max'=>25,'on'=>'create'),
                        //on create
                        array('img_src','safe','on'=>'processingImage'),
                        array('illust_category_enum,illust_title', 'required','on'=>'create'),
                        array('tag', 'length', 'max'=>600,'on'=>'create'),
                        array('tag','tagValidate','on'=>'create'),
                        array('illust_summary', 'length', 'max'=>300,'on'=>'create'),
                        ModelRuleHelper::booleanValidateRule('is_r18,is_bl', 'create'),
                        
                        //on update
                        array('illust_title', 'required','on'=>'update'),
                        array('tag', 'length', 'max'=>600,'on'=>'update'),
                        array('tag','tagValidate','on'=>'update'),
                        array('illust_summary', 'length', 'max'=>300,'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, created_datetime, popularity, illust_summary, tag, img_src, is_r18, is_bl, is_deleted, illust_category_enum', 'safe', 'on'=>'search'),
		);
	}
        
        public function behaviors() {
            return array(
                'commentable' => array(
                    'class' => 'ext.comment-module.behaviors.CommentableBehavior',
                    // name of the table created in last step
                    'mapTable' => 'posts_comments_nm',
                    // name of column to related model id in mapTable
                    'mapRelatedColumn' => 'postId'
                ),
           );
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'illustCatagory' => array(self::BELONGS_TO, 'IllustCategory', 'illust_catagory_id'),
			'bookmarkedUsers' => array(self::MANY_MANY, 'User', 'user_bookmark_illust(illust_id, user_id)'),
                        'bookmarkedUsersCount' => array(self::STAT, 'User', 'user_bookmark_illust(illust_id, user_id)'),
			'Owners' => array(self::MANY_MANY, 'User', 'user_own_illust(illust_id, user_id)'),
			'users2' => array(self::MANY_MANY, 'User', 'user_viewed_illust(illust_id, user_id)'),
                    
                        //relation
                        'bookmarkRelations' => array(self::HAS_MANY, 'UserBookmarkIllust', 'illust_id'),
                        'ownership' => array(self::HAS_MANY, 'UserOwnIllust', 'illust_id'),
                        'viewedUserRelation' =>array(self::HAS_MANY, 'UserViewedIllust', 'illust_id'),
                    
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'illust_catagory_id' => '種類',
			'created_datetime' => 'Created Datetime',
			'popularity' => 'Popularity',
			'illust_summary' => '簡介',
			'tag' => 'Tag',
			'img_src' => 'Img Src',
			'is_r18' => 'R18',
			'is_bl' => 'BL',
			'is_deleted' => 'Is Deleted',
			'illust_category_enum' => '分類',
		);
	}
        
        /** @callback */
        protected function afterSave(){

            /*
             * this is not working
            $this->setScenario('processingImage');
            $this->save(); // DONE
             * */

            parent::aftersave();
            $this->tag = $this->removeSymbol($this->tag);
            //IllustTagFrequency::model()->updateFrequency($this->_oldTags,$this->tag);
        }
        
        protected function beforeFind(){
            //$this->categorize($this->illust_category_enum);
            
            return parent::beforeFind();
        }
        
        protected function afterFind(){
            parent::afterFind();
            //$this->categorize($this->illust_category_enum);
            $this->tag = ArrayHelper::array2string($this->getTags());
            $this->tag = $this->removeSymbol($this->tag);
            $this->_oldTags=$this->tag;
            
        }
        
        protected function beforeSave() {
            if($this->isNewRecord){
                $this->created_datetime = DateTimeHelper::now();
                $this->popularity =0;
            }else{
                
            }
            
            $this->update_datetime = DateTimeHelper::now();
            
            /** make the saved tag with symbol transparent to the others class*/
            $this->tag = $this->prependSymbol($this->tag);
            
            return parent::beforeSave();
          }
        
        /** @validation */
        public function tagValidate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
                    $tag_arr = ArrayHelper::string2array($this->tag);
                    $tagCount = count($tag_arr);
                    if($tagCount > Illust::TAG_ALLOWED_COUNT_ON_CREATE)
                        $this->addError('tag','at most 10 tags is allowed');
		}
	}
        
        /** @namedscope */
        /*
        public function showOnlyFollowingAuther($FollowingAutherIdArr){
            $this->getDbCriteria()->mergeWith(array(
                'with'=>'Owners',
                'together'=>true,
                'condition'=>'Owners.id=:id AND `t`.id >:thisillustId',
                'params'=>array(':id'=>$userId,':thisillustId'=>$currentIllustId),
                'order'=>"`t`.id ASC",
                'limit'=>$limit,
            ));
            return $this;
        }
        */
        public function applyUserPreference(){
            $userId = Yii::app()->user->id;
            if(!$userId == null){
                $user = User::model()->findByPk($userId);
                $this->alsoShowR18($user->show_r18)->alsoShowBL($user->show_bl);
            }else{
                //if user is guest
                $this->alsoShowR18(0)->alsoShowBL(0);
            }
            return $this;
        }
        public function alsoShowR18($option){
            if($option == 0){
                //if user do not want to show r18
                $this->getDbCriteria()->mergeWith(array(
                'condition'=>'`t`.is_r18=:is_r18',
                'params'=>array(':is_r18'=>0)
                ));
            }
            return $this;
        }
        
        public function alsoShowBL($option){
            if($option == 0){
                 //if user do not want to show bl
                $this->getDbCriteria()->mergeWith(array(
                'condition'=>'`t`.is_bl=:is_bl',
                'params'=>array(':is_bl'=>0)
                ));
            }
            
            return $this;
        }
        
        public function onlyBelongToUser($userId){
            $this->getDbCriteria()->mergeWith(array(
                'with'=>'Owners',
                'together'=>true,
                'condition'=>'Owners.id=:id',
                'params'=>array(':id'=>$userId)
            ));
            return $this;
        }
        
        public function olderIllust($userId,$currentIllustId,$limit=1){
            $this->getDbCriteria()->mergeWith(array(
                'with'=>'Owners',
                'together'=>true,
                'condition'=>'Owners.id=:id AND `t`.id <:thisillustId',
                'params'=>array(':id'=>$userId,':thisillustId'=>$currentIllustId),
                'order'=>"`t`.id DESC",
                'limit'=>$limit,
            ));
            return $this;
        }
        
        public function newerIllust($userId,$currentIllustId,$limit=1){
            $this->getDbCriteria()->mergeWith(array(
                'with'=>'Owners',
                'together'=>true,
                'condition'=>'Owners.id=:id AND `t`.id >:thisillustId',
                'params'=>array(':id'=>$userId,':thisillustId'=>$currentIllustId),
                'order'=>"`t`.id ASC",
                'limit'=>$limit,
            ));
            return $this;
        }
        
        public function showOnlyFollowingAuther($FollowingAutherIdArr){
            $criteria = new CDbCriteria();
            $criteria->with='Owners';
            $criteria->together=true;
            $criteria->addInCondition("`Owners`.id", $FollowingAutherIdArr);
            
            $this->getDbCriteria()->mergeWith($criteria);
            return $this;
        }
        
        public function showOnlyIllustId($illustIdArr){
            $criteria = new CDbCriteria();
            $criteria->addInCondition("id", $illustIdArr);
            
            $this->getDbCriteria()->mergeWith($criteria);
            return $this;
        }
        
/** @public-command-method */
        public function save_img_src($SavedFileRelativePaths,$savedThumbnailFileRelativePaths){
            
            $serializedPath = ArrayHelper::array2string($SavedFileRelativePaths);
            $serializedThumbnailPath = ArrayHelper::array2string($savedThumbnailFileRelativePaths);
            
            $illustJustSaved = Illust::model()->findByPk($this->id);
            $illustJustSaved->setScenario('processingImage');
            $illustJustSaved->img_src = $serializedPath;
            $illustJustSaved->img_thumbnail_src = $serializedThumbnailPath;
            $illustJustSaved->save();   
        }
        public function categorize($cat){
            if($this->isNewRecord){
                if($cat == Illust::ILLUST){
                    $this->Illust_cat_title = Illust::ILLUST_CAT_TITLE;
                    $this->illust_category_enum =Illust::ILLUST;
                    return;
                }
                if($cat == Illust::MANGA){
                    $this->Illust_cat_title = Illust::MANGA_CAT_TITLE;
                    $this->illust_category_enum =Illust::MANGA;
                    return;
                }
                ExceptionHelper::throw404(get_class($this), "categorize", "cannot categorize for ".$cat);
            }
        }
        public function tryIncrementViewCount($userId){
            if($userId == null){
                return;
            }
            $viewed=UserViewedIllust::model()->findByPk(array('user_id'=>$userId,'illust_id'=>$this->id));
            if($viewed == null){
                $this->incrementViewCount();
                
                $this->addUserViewedIllust($userId);
            }
        }
        
        public function tryIncrementNonUserViewCount(){
                $this->incrementNonUserViewCount();
        }
        
        public function removeSymbol($tags_string){
            if(isset($tags_string) && $tags_string !==""){
                $tag_arr = ArrayHelper::string2array($tags_string);
                $processed_tag_arr = array();
                foreach($tag_arr as $tag){
                    array_push($processed_tag_arr, str_replace(Illust::uniqueTagPrefix,"",$tag));
                }
                return ArrayHelper::array2string($processed_tag_arr);
            }
            return "";
        }
        
        public function prependSymbol($tags_string){
            if(isset($tags_string) && $tags_string !==""){
                $tag_arr = ArrayHelper::string2array($tags_string);
                $processed_tag_arr = array();
                foreach($tag_arr as $tag){
                    array_push($processed_tag_arr, Illust::uniqueTagPrefix.$tag);
                }
                return ArrayHelper::array2string($processed_tag_arr);
            }
            return "";
        }
/** @public-query-method */
        


        public function getAllImgSrcPhysicalPath(){
            $allImgSrc_array = $this->getMangaAllImgSrc();
            
            $resultArr = array();
            $rootPath = FileSystemService::getRootPath();
            foreach($allImgSrc_array as $imgSrc){
                array_push($resultArr, $rootPath.$imgSrc);
            }
            return $resultArr;
        }
        
        public function getFilterableOptions(){
            $categories = array(
                '' => 'All', //default
                Illust::ILLUST => Illust::ILLUST_CAT_TITLE,
                Illust::MANGA => Illust::MANGA_CAT_TITLE,
            );
            return $categories;
        }
        public function getSortableOptions(){
            $sortableOptions = array(
               'created_datetime'=> '投稿日期',
               'popularity' => '人氣', //default
            );
            return $sortableOptions;
        }
        public function getCatName(){
            $categories = array(
                Illust::ILLUST => Illust::ILLUST_CAT_TITLE,
                Illust::MANGA => Illust::MANGA_CAT_TITLE,
            );
            return $categories[$this->illust_category_enum];
        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Illust the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function isCatOf($cat){
            if($this->illust_category_enum == $cat)
                return true;
            else
                return false;
        }
        public function getMangaAllImgSrc(){
            $tag_arr = ArrayHelper::string2array($this->img_src);
            return $tag_arr;
        }
        public function getFirstImgSrc(){
            $tag_arr = ArrayHelper::string2array($this->img_src);
            if(count($tag_arr) > 0){
                return $tag_arr[0];
            }else{
                return "";
            }
        }
        public function getFirstThumnailImgSrc(){
            $tag_arr = ArrayHelper::string2array($this->img_thumbnail_src);
            if(count($tag_arr) > 0){
                $relativeURL = $tag_arr[0];
                return '/'.$relativeURL;
            }else{
                return "";
            }
        }
        
        public function getTags(){
            $tag_arr = ArrayHelper::string2array($this->tag);
            $processed = str_replace(Illust::uniqueTagPrefix, '', $tag_arr);
            return $processed;
        }
        public function getOlderIllusts(){
            $owner = $this->getFirstOwnedUser();
            $Illust = Illust::model()->olderIllust($owner->id,$this->id)->findAll();
            return $Illust;
        }
        
        public function getNewerIllusts(){
            $owner = $this->getFirstOwnedUser();
            $Illust = Illust::model()->newerIllust($owner->id,$this->id)->findAll();
            return $Illust;
        }
        
        public static function getNonR18MostPopular($numberOfItem){
            $mostPopularIllustList = Illust::model()->findAllBySql('Select * from illust where is_r18 = 0 order by non_user_popularity DESC,popularity DESC,created_datetime DESC limit '.$numberOfItem);
            return $mostPopularIllustList;
        }
        
        public static function getR18MostPopular($numberOfItem){
            $mostPopularIllustList = Illust::model()->findAllBySql('Select * from illust where is_r18 = 1 order by non_user_popularity DESC,popularity DESC,created_datetime DESC limit '.$numberOfItem);
            return $mostPopularIllustList;
        }
        
        public function getIndexData(){
            
            /** i use the search approach instead of named scope
             * since named scope may not be able to use with search() method */
            $userId = Yii::app()->user->id;
            if(!$userId == null){
                $user = User::model()->findByPk($userId);
                $this->is_r18 = $user->show_r18;
                $this->is_bl = $user->show_bl;
            }else{
                //if user is guest
                $this->is_r18 = 0;
                $this->is_bl = 0;
            }
            return $this->search();
        }
        
        /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('created_datetime',$this->created_datetime,true);
		$criteria->compare('popularity',$this->popularity);
		$criteria->compare('illust_summary',$this->illust_summary,true);
                if(isset($this->tag) && $this->tag !== ""){
                    /** this is the single tag search */
                    $criteria->compare('tag',Illust::uniqueTagPrefix.$this->tag,true);
                }
		$criteria->compare('img_src',$this->img_src,true);
		$criteria->compare('is_r18',$this->is_r18);
		$criteria->compare('is_bl',$this->is_bl);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('illust_category_enum',$this->illust_category_enum);
                
                $this->getDbCriteria()->mergeWith($criteria);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$this->getDbCriteria(),
                        
                        'sort'=>array(
                            //'defaultOrder'=>'popularity DESC'
                            'defaultOrder'=>'`t`.created_datetime DESC'
                        ),
                        'pagination'=>array(
                            'pageSize'=>10,
                        )
		));
	}
/** @private-command-method */
        private function addUserViewedIllust($userId){
            $relation = new UserViewedIllust;
                $relation->illust_id=$this->id;
                $relation->user_id=$userId;
                $relation->url_referrer=Yii::app()->request->urlReferrer;
                $relation->view_datetime=DateTimeHelper::now();
                $relation->count=1;
                $relation->save();
        }
        
        private function incrementNonUserViewCount(){
            $this->updateCounters(
                array('non_user_popularity'=>1),
                "id = :id",
                array(':id' => $this->id)
            );
        }
        
        private function incrementViewCount(){
            $this->updateCounters(
                array('popularity'=>1),
                "id = :id",
                array(':id' => $this->id)
            );
        }
/** @private-query-method */
/** @relation-command */
        public function addOwnerUserId($userId){
            $relation = new UserOwnIllust;
            $relation->illust_id=$this->id;
            $relation->user_id=$userId;
            $relation->save();
        }
        
        public function deepDelete($thatTransaction=null){
            
            $transaction=null;
            $isHandlingTransaction = $thatTransaction==null;
            if($isHandlingTransaction){
                $transaction = Yii::app()->db->beginTransaction();
            }else{
                $transaction = $thatTransaction;
            }
            
            try{
                /** remove all bookmark */
                $allBookmarkRelations_array = $this->bookmarkRelations;
                foreach($allBookmarkRelations_array as $bookmarkRelation){
                    $bookmarkRelation->delete();
                }
                
                //remove the ownership of this illust
                $allOwnerShip_array = $this->ownership;
                foreach($allOwnerShip_array as $ownership){
                    $ownership->delete();
                }
                
                //remove all viewed user relation with this illust
                $allViewedRelation_array = $this->viewedUserRelation;
                foreach($allViewedRelation_array as $viewedRelation){
                    $viewedRelation->delete();
                }
                
                /**remove all the img */
                $allFullImgFilePath = $this->getAllImgSrcPhysicalPath();
                foreach($allFullImgFilePath as $fullImgPath){
                    FileSystemService::removeFile($fullImgPath);
                }

                /** remove itself */
                $this->delete();
                
                if($isHandlingTransaction){
                    $transaction->commit();
                }
            } catch (Exception $ex) {
                if($isHandlingTransaction){
                    $transaction->rollback();
                }
                throw $ex;
            }
        }
/** @relation-query */
        public function getFirstOwner(){
            $users = $this->Owners;
            if(count($users) == 0){
               $user = new User();
               $user->id = 162;
               $user->nickname = "deleted user";
               $user->user_name = "deleted user";
               return $user;
            }else{
                return $users[0];
            }
        }
        public function getFirstOwnedUser(){
            $owner = $this->getFirstOwner();
            return $owner;
        }
        
        public function getFirstOwnedUserName(){
            $owner = $this->getFirstOwnedUser();
            return $owner->user_name;
        }
        
        public function isUserIdAuthor($userId){
            $Owners = $this->Owners;
            foreach($Owners as $Owner){
                if($Owner->id == $userId)
                    return true;
            }
            return false;
        }
        
        public function isBookmarkedByUser($userId){
            $allBookMarkedUser = $this->bookmarkedUsers;
            foreach($allBookMarkedUser as $user){
                if($user->id == $userId)
                    return true;
            }
            return false;
        }
        
        public function getBookmarkedUsersCount(){
            return $this->bookmarkedUsersCount;
        }
/** @view-specific */
        public function getOlderIllustViewLink(){
            $illust_arr = $this->getOlderIllusts();
            if(count($illust_arr) == 0){
                return '';
            }
            $illust=$illust_arr[0];
            $link = CHtml::link(CHtml::encode('上一張作品: '.$illust->illust_title), SeoHelper::illustViewSEORouteArray($illust));
            return $link;
        }
        
        public function getNewerIllustViewLink(){
            $illust_arr = $this->getNewerIllusts();
            if(count($illust_arr) == 0){
                return '';
            }
            $illust=$illust_arr[0];
            $link = CHtml::link(CHtml::encode('下一張作品: '.$illust->illust_title), SeoHelper::illustViewSEORouteArray($illust));
            return $link;
        }
        public function getTagsLink(){
            $tags_arr = $this->getTags();
            $croppedTags_arr = array_slice($tags_arr, 0, 4);
            $tagLink_arr = array();
            foreach($croppedTags_arr as $tag)
            {
                    $htmlEncodedTagName = CHtml::encode($tag);
                    $url=Yii::app()->createUrl('illust/search',array('tag'=>$htmlEncodedTagName));
                    //echo CHtml::link($htmlEncodedTagName,array('illust/index','search'=>$htmlEncodedTagName),array('class'=>'label label-info','title'=>$htmlEncodedTagName));
                    array_push($tagLink_arr, "<a href='$url' title='$htmlEncodedTagName'> <span class='label label-info'> $htmlEncodedTagName </span> </a>");
            }
            return $tagLink_arr;
        }
        
        public function getAllTagsLink(){
            $tags_arr = $this->getTags();
            $tagLink_arr = array();
            foreach($tags_arr as $tag)
            {
                    $htmlEncodedTagName = CHtml::encode($tag);
                    $url=Yii::app()->createUrl('illust/search',array('tag'=>$htmlEncodedTagName));
                    //echo CHtml::link($htmlEncodedTagName,array('illust/index','search'=>$htmlEncodedTagName),array('class'=>'label label-info','title'=>$htmlEncodedTagName));
                    array_push($tagLink_arr, "<a href='$url' title='$htmlEncodedTagName'> <span class='label label-info'> $htmlEncodedTagName </span> </a>");
            }
            return $tagLink_arr;
        }
        
        public function getViewURL(){
            return Yii::app()->createUrl('illust/view',SeoHelper::illustViewSEORouteArrayParam($this));
        }
        
	

	
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        /*
        private function processImage(){
            //although it should pass the validation before save....
            
            
            
            if (isset($this->photos) && count($this->photos) > 0) {
                $userIllustRelativePath = Illust::illustPath. Yii::app()->user->user_name.'/';
                $userIllustDirPath = Yii::getPathOfAlias('webroot').'/'.Illust::illustPath. Yii::app()->user->user_name.'/';
                
                if(!is_dir($userIllustDirPath)) {
                    mkdir($userIllustDirPath);
                    chmod($userIllustDirPath, 0755); 
                }
                
                
                // go through each uploaded image
                $counter=1;
                foreach ($this->photos as $image => $pic) {
                    $picName = $this->id.'_'.$counter.'.'.$pic->extensionName;
                    if ($pic->saveAs($userIllustDirPath.$picName)) {
                        // add it to the main model now
                        //$this->img_src = $userIllustDirPath.'/'.$picName; //it might be $img_add->name for you, filename is just what I chose to call it in my model
                        
                        $illustJustSaved = Illust::model()->findByPk($this->id);
                        $illustJustSaved->id;
                        $illustJustSaved->illust_title;
                        $illustJustSaved->illust_category_enum;
                        $illustJustSaved->setScenario('processingImage');
                        $illustJustSaved->img_src=$userIllustRelativePath.$picName;
                        $illustJustSaved->save();
                        /*
                        $this->setScenario('processingImage');
                        $this->save(); // DONE
                         * */
        /*
                    }
                    else{
                        echo 'Cannot upload!';
                    }
                }
            }
        }
        */
        
        
        
}
