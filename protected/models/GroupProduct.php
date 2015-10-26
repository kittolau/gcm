<?php

/**
 * This is the model class for table "group_product".
 *
 * The followings are the available columns in table 'group_product':
 * @property integer $id
 * @property integer $group_id
 * @property integer $product_catagory_id
 * @property double $price
 * @property string $created_datetime
 * @property string $last_update_datetime
 * @property string $img_src
 * @property string $thumbnail_src
 * @property string $product_summary
 * @property string $tag
 * @property integer $is_r18
 * @property integer $is_bl
 * @property integer $is_deleted
 * @property integer $product_catagory_enum
 * @property integer $book_number_of_page
 * @property string $book_inner_page_materia
 * @property string $book_outer_page_materia
 * @property string $gift_material
 * @property string $elect_demo_url
 * @property integer $elect_is_selling
 * @property string $elect_selling_url
 * @property integer $elect_size
 * @property string $elect_format
 *
 * The followings are the available model relations:
 * @property Group $group
 * @property ProductCatagory $productCatagory
 * @property Event[] $events
 * @property User[] $users
 */
/** go to Group.php to see more detail */
class GroupProduct extends CActiveRecord
{
/** @constant */
        const uniqueTagPrefix='{*}';
        const TAG_ALLOWED_COUNT_ON_CREATE=10;

        const BOOK=1;
        const GIFT=2;
        const ELECT=3;

        const BOOK_CAT_TITLE='誌';
        const GIFT_CAT_TITLE='精品';
        const ELECT_CAT_TITLE='電子制品';
/** @public-data-member */
        public $GroupProduct_cat_title;

        public $event_arr_id; //used for form data binding
        public $new_event_arr_id;

        /** @scope used for filter*/
        public $event_id;
/** @private-data-member */
/** @framework-specific */

        /**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
			'productCatagory' => array(self::BELONGS_TO, 'ProductCatagory', 'product_catagory_id'),
			'events' => array(self::MANY_MANY, 'Event', 'group_product_join_event(product_id, event_id)'),
                        'eventRelations' =>array(self::HAS_MANY, 'GroupProductJoinEvent', 'product_id'),
                        'UserViewedRelations' =>array(self::HAS_MANY, 'UserViewedGroupProduct', 'group_product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_id' => '組織',
			'product_catagory_id' => '種類',
			'price' => '價錢',
			'created_datetime' => 'Created Datetime',
			'last_update_datetime' => 'Last Update Datetime',
			'img_src' => 'Img Src',
			'thumbnail_src' => 'Thumbnail Src',
			'product_summary' => '簡介',
			'tag' => 'Tag',
			'is_r18' => 'R18',
			'is_bl' => 'BL',
			'is_deleted' => 'Is Deleted',
			'product_catagory_enum' => '分類',
			'book_number_of_page' => '頁數',
			'book_inner_page_materia' => '內頁用料',
			'book_outer_page_materia' => '封面用料',
			'gift_material' => '用料',
			'elect_demo_url' => 'Demo網址',
			'elect_is_selling' => '是否販賣',
			'elect_selling_url' => '販賣網址',
			'elect_size' => 'Size',
			'elect_format' => 'Format',
                        'event_id' => '場次',
                        'event_arr_id' => '場次'
		);
	}

        public function behaviors() {
            return array(
                'commentable' => array(
                    'class' => 'ext.comment-module.behaviors.CommentableBehavior',
                    // name of the table created in last step
                    'mapTable' => 'groupproduct_posts_comments_nm',
                    // name of column to related model id in mapTable
                    'mapRelatedColumn' => 'postId'
                ),
           );
        }

        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'group_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        //generic rule for create
                        /** When dealing with UTF-8, regex need 'u' modifier
                         *
                         */
                         array('book_inner_page_materia,book_outer_page_materia,gift_material,elect_demo_url,elect_format,elect_selling_url','safe'),
                        //array('title','match','pattern'=>'/^[a-zA-Z0-9\s\x{4E00}-\x{9FFF}]*$/u','message'=>'只可使用 中文, 英文, 數字 或 空白鍵'),
                        array('title','match','pattern'=>'/^[\S]+/u','message'=>'不能以空白鍵開頭'),
                        array('title', 'length','min'=>1, 'max'=>25),
                        array('img_src','safe','on'=>'processingImage'),
                        ModelRuleHelper::booleanValidateRule('is_r18,is_bl','create'),
                        array('group_id','isGroupBelongToUser','on'=>'create'),
                        array('event_arr_id','isEventExistAndValid'),
                        array('product_summary', 'length', 'max'=>300),
			array('tag', 'length', 'max'=>600),
                        array('tag', 'tagValidate'),
                        array('title,group_id', 'required'),
			array('price', 'match','pattern'=>'/^(?:0|[1-9]{1}[0-9]*)/'),
                        //Book specific rule
                        array('book_inner_page_materia, book_outer_page_materia', 'length', 'max'=>30,'on'=>GroupProduct::BOOK_CAT_TITLE),
                        array('book_number_of_page', 'numerical','on'=>GroupProduct::BOOK_CAT_TITLE),
                        //Gift specifc rule
                        array('gift_material', 'length', 'max'=>30 ,'on'=>GroupProduct::GIFT_CAT_TITLE),
                        //elect specifc rule
			array( 'elect_demo_url, elect_selling_url', 'length', 'max'=>100,'on'=>GroupProduct::ELECT_CAT_TITLE),
                        array( 'elect_demo_url, elect_selling_url', 'url','on'=>GroupProduct::ELECT_CAT_TITLE),
			array('elect_format', 'length', 'max'=>20,'on'=>GroupProduct::ELECT_CAT_TITLE),

                        //on update
                        array('new_event_arr_id','isEventExistAndValid'),
                        array('event_arr_id','isEventExistAndValid','on'=>'update'),
                        array('product_summary', 'length', 'max'=>300,'on'=>'update'),
			array('tag', 'length', 'max'=>600,'on'=>'update'),
                        array('tag', 'tagValidate','on'=>'update'),
                        array('price,title', 'required','on'=>'update'),
			array('price', 'numerical','on'=>'update'),
                        //Book specific rule
                        array('book_inner_page_materia, book_outer_page_materia', 'length', 'max'=>30,'on'=>'update'),
                        //Gift specifc rule
                        array('gift_material', 'length', 'max'=>30 ,'on'=>'update'),
                        //elect specifc rule
			array( 'elect_demo_url, elect_selling_url', 'length', 'max'=>100,'on'=>'update'),
                        array( 'elect_demo_url, elect_selling_url', 'url','on'=>'update'),
			array('elect_format', 'length', 'max'=>20,'on'=>'update'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, group_id, product_catagory_id, price, created_datetime, last_update_datetime, img_src, thumbnail_src, product_summary, tag, is_r18, is_bl, is_deleted, product_catagory_enum, book_number_of_page, book_inner_page_materia, book_outer_page_materia, gift_material, elect_demo_url, elect_is_selling, elect_selling_url, elect_size, elect_format,event_id', 'safe', 'on'=>'search'),
		);
	}

        /** @validation */
        public function isEventExistAndValid(){
            if($this->event_arr_id == null){
                //no event is going to be added, so no error
                return;
            }
            $AllEvent = Event::model()->findAll();
            foreach($AllEvent as $event){
                if(in_array($event->id,$this->event_arr_id)){
                    if(!$event->isEventAvailableForAdding()){
                        $this->addError('event_arr_id','event_arr_id cannot be added');
                    }
                }
            }
        }

        public function tagValidate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
                    $tag_arr = ArrayHelper::string2array($this->tag);
                    $tagCount = count($tag_arr);
                    if($tagCount > GroupProduct::TAG_ALLOWED_COUNT_ON_CREATE)
                        $this->addError('tag','at most 10 tags is allowed');
		}
	}

        /** @callback */
        protected function beforeSave() {
            if($this->isNewRecord){
                $this->created_datetime = DateTimeHelper::now();
                $this->last_update_datetime = DateTimeHelper::now();
                //$this->popularity =0;
                $this->processTags();
            }else{
                $this->last_update_datetime = DateTimeHelper::now();
                $this->processTags();
            }
            return parent::beforeSave();
          }

        protected function afterFind(){
            //$this->categorize($this->illust_category_enum);
            $this->tag = ArrayHelper::array2string($this->getTags());
            return parent::afterFind();
        }

        /** @namedscope */

        public function showOnlyFollowingGroup($FollowingGroupIdArr){
            $criteria = new CDbCriteria();
            $criteria->addInCondition("`t`.group_id", $FollowingGroupIdArr);
            $this->getDbCriteria()->mergeWith($criteria);
            return $this;
        }

        public function onlyBelongToGroup($groupId){
            $this->getDbCriteria()->mergeWith(array(
                'condition'=>"group_id=:group_id",
                'params'=>array(':group_id'=>$groupId)
            ));
            return $this;
        }

                public function olderGroupProduct($groupId,$currentGroupId,$limit=1){
            $this->getDbCriteria()->mergeWith(array(
                'condition'=>'`t`.group_id=:id AND `t`.id <:thisGroupProduct',
                'params'=>array(':id'=>$groupId,':thisGroupProduct'=>$currentGroupId),
                'order'=>"`t`.id DESC",
                'limit'=>$limit,
            ));
            return $this;
        }

        public function newerGroupProduct($groupId,$currentGroupId,$limit=1){
            $this->getDbCriteria()->mergeWith(array(
                'condition'=>'`t`.group_id=:id AND `t`.id >:thisGroupProduct',
                'params'=>array(':id'=>$groupId,':thisGroupProduct'=>$currentGroupId),
                'order'=>"`t`.id ASC",
                'limit'=>$limit,
            ));
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
/** @public-command-method */

        public function tryIncrementViewCount($userId){

            if($userId == null){
                return;
            }


            $viewed=UserViewedGroupProduct::model()->findByPk(array('user_id'=>$userId,'group_product_id'=>$this->id));
            if($viewed == null){
                $this->incrementViewCount();

                $this->addUserViewedGroupProduct($userId);
            }

        }

        public function tryIncrementNonUserViewCount(){
                $this->incrementNonUserViewCount();
        }

         public function categorize($cat){
            if($this->isNewRecord){
                if($cat == GroupProduct::BOOK){
                    $this->GroupProduct_cat_title = GroupProduct::BOOK_CAT_TITLE;
                    $this->product_catagory_enum =GroupProduct::BOOK;

                    return;
                }
                if($cat == GroupProduct::GIFT){
                    $this->GroupProduct_cat_title = GroupProduct::GIFT_CAT_TITLE;
                    $this->product_catagory_enum =GroupProduct::GIFT;

                    return;
                }
                if($cat == GroupProduct::ELECT){
                    $this->GroupProduct_cat_title = GroupProduct::ELECT_CAT_TITLE;
                    $this->product_catagory_enum =GroupProduct::ELECT;

                    return;
                }
                ExceptionHelper::throw404(get_class($this), "categorize", "cannot categorize for ".$cat);
            }
        }

        public function processTags(){
            if(isset($this->tag) && $this->tag !==""){
                $tag_arr = ArrayHelper::string2array($this->tag);
                $processed_tag_arr = array();
                foreach($tag_arr as $tag){
                    array_push($processed_tag_arr, GroupProduct::uniqueTagPrefix.$tag);
                }
                $this->tag = ArrayHelper::array2string($processed_tag_arr);
            }

        }

        public function save_img_src($SavedFileRelativePaths,$SavedThumbnailPath){

            $serializedPath = ArrayHelper::array2string($SavedFileRelativePaths);

            $serializedThumbnailPath = ArrayHelper::array2string($SavedThumbnailPath);

            $illustJustSaved = GroupProduct::model()->findByPk($this->id);
            $illustJustSaved->setScenario('processingImage');
            $illustJustSaved->img_src=$serializedPath;

            $illustJustSaved->thumbnail_src = $serializedThumbnailPath;

            $illustJustSaved->save();
        }

/** @public-query-method */



        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GroupProduct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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

                $criteria->with= array('events'); //with relationship
                $criteria->together = true;

		$criteria->compare('id',$this->id);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('created_datetime',$this->created_datetime,true);
		$criteria->compare('last_update_datetime',$this->last_update_datetime,true);
		$criteria->compare('img_src',$this->img_src,true);
		$criteria->compare('thumbnail_src',$this->thumbnail_src,true);
		$criteria->compare('product_summary',$this->product_summary,true);
		if(isset($this->tag) && $this->tag !== ""){
                    $criteria->compare('tag',  GroupProduct::uniqueTagPrefix.$this->tag,true);
                }
		$criteria->compare('is_r18',$this->is_r18);
		$criteria->compare('is_bl',$this->is_bl);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('product_catagory_enum',$this->product_catagory_enum);
		$criteria->compare('book_number_of_page',$this->book_number_of_page);
		$criteria->compare('book_inner_page_materia',$this->book_inner_page_materia,true);
		$criteria->compare('book_outer_page_materia',$this->book_outer_page_materia,true);
		$criteria->compare('gift_material',$this->gift_material,true);
		$criteria->compare('elect_demo_url',$this->elect_demo_url,true);
		$criteria->compare('elect_is_selling',$this->elect_is_selling);
		$criteria->compare('elect_selling_url',$this->elect_selling_url,true);
		$criteria->compare('elect_size',$this->elect_size);
		$criteria->compare('elect_format',$this->elect_format,true);

                $criteria->compare('events.id',$this->event_id,true); // relationship.attribute

                $this->getDbCriteria()->mergeWith($criteria);

                $mergedCriteria = $this->getDbCriteria();

		return new CActiveDataProvider($this, array(
			'criteria'=>$mergedCriteria,
                        'sort'=>array(
                            //'defaultOrder'=>'popularity DESC'
                            'defaultOrder'=>'created_datetime DESC'
                        ),
                        'pagination'=>array(
                            'pageSize'=>10,
                        )
		));
	}

        public function getIndexData(){

            $criteria=new CDbCriteria;

            $userId = Yii::app()->user->id;
            $isUserLoggedIn = !$userId == null;
            if($isUserLoggedIn){
                $user = User::model()->findByPk($userId);
                if($user->show_r18){
                    $criteria->compare('is_r18',array(0,1));
                }else{
                    $criteria->compare('is_r18',0);
                }

                if($user->show_bl){
                    $criteria->compare('is_bl',array(0,1));
                }else{
                    $criteria->compare('is_bl',0);
                }
            }else{
                $criteria->compare('is_bl',array(0,1));
                $criteria->compare('is_r18',0);
            }



            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            //'defaultOrder'=>'popularity DESC'
                            'defaultOrder'=>'created_datetime DESC'
                        ),
                        'pagination'=>array(
                            'pageSize'=>10,
                        )
		));
        }

        public function getOnlyEventData($eventId){

            $criteria=new CDbCriteria;

            $userId = Yii::app()->user->id;
            $isUserLoggedIn = !$userId == null;
            if($isUserLoggedIn){
                $user = User::model()->findByPk($userId);
                if($user->show_r18){
                    $criteria->compare('is_r18',array(0,1));
                }else{
                    $criteria->compare('is_r18',0);
                }

                if($user->show_bl){
                    $criteria->compare('is_bl',array(0,1));
                }else{
                    $criteria->compare('is_bl',0);
                }
            }else{
                $criteria->compare('is_bl',array(0,1));
                $criteria->compare('is_r18',0);
            }

            $criteria->mergeWith(array(
                'with'=>'eventRelations',
                'condition'=>'eventRelations.event_id=:event_id',
                'params'=>array(':event_id'=>  $eventId),
                'together'=>true
            ));

            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            //'defaultOrder'=>'popularity DESC'
                            'defaultOrder'=>'created_datetime DESC'
                        ),
                        'pagination'=>array(
                            'pageSize'=>10,
                        )
		));
        }



        public function applyUserPreference(){
            $userId = Yii::app()->user->id;
            if(!$userId == null){
                $user = User::model()->findByPk($userId);
                $this->alsoShowR18($user->show_r18)->alsoShowBL($user->show_bl);
            }else{
                //if user is guest
                $this->alsoShowR18(0)->alsoShowBL(1);
            }
            return $this;
        }

        public function isCatOf($cat){
            if($this->product_catagory_enum == $cat)
                return true;
            else
                return false;
        }

        public function getCatName(){
            $categories = array(
                GroupProduct::BOOK => GroupProduct::BOOK_CAT_TITLE,
                GroupProduct::GIFT => GroupProduct::GIFT_CAT_TITLE,
                GroupProduct::ELECT => GroupProduct::ELECT_CAT_TITLE,
            );
            return $categories[$this->product_catagory_enum];
        }



        public function getSortableOptions(){
            $sortableOptions = array(
               'created_datetime'=> '投稿日期',
               'popularity' => '人氣', //default

            );
            return $sortableOptions;
        }

        public function getFilterableOptions($fieldName){
            if($fieldName == 'product_catagory_enum'){
                $categories = array(
                '' => 'All', //default
                GroupProduct::BOOK => GroupProduct::BOOK_CAT_TITLE,
                GroupProduct::GIFT => GroupProduct::GIFT_CAT_TITLE,
                GroupProduct::ELECT => GroupProduct::ELECT_CAT_TITLE,
                );
                return $categories;
            }
            if($fieldName == 'event_id'){
                $eventOptions = array('' => 'All');
                $allEvent = Event::getAllEventAvailable();
                foreach($allEvent as $event){
                    $key = $event->id;
                    $value = $event->title;
                    $eventOptions[$key] = $value;
                }
                return $eventOptions;
            }
        }

        public static function getNonR18MostPopular($numberOfItem){
            $mostPopularGroupProductList = GroupProduct::model()->findAllBySql('Select * from group_product order by popularity DESC,created_datetime DESC limit '.$numberOfItem);
            return $mostPopularGroupProductList;
        }
        public static function getR18MostPopular($numberOfItem){
            $mostPopularGroupProductList = GroupProduct::model()->findAllBySql('Select * from group_product order by popularity DESC,created_datetime DESC limit '.$numberOfItem);
            return $mostPopularGroupProductList;
        }

        public function getTags(){
            $tag_arr = ArrayHelper::string2array($this->tag);
            $processed = str_replace(GroupProduct::uniqueTagPrefix, '', $tag_arr);
            return $processed;
        }

        public function getEventTitleArray(){
            $allEvents = $this->events;
            $croppedEvents_arr = $allEvents;
            $link_arr=array();
            foreach($croppedEvents_arr as $event)
            {
                    array_push($link_arr, CHtml::encode($event->title));
            }
            return $link_arr;
        }

        public function getAllImgSrcPhysicalPath(){
            $allImgSrc_array = $this->getAllSrc();

            $resultArr = array();
            $rootPath = FileSystemService::getRootPath();
            foreach($allImgSrc_array as $imgSrc){
                array_push($resultArr, $rootPath.$imgSrc);
            }
            return $resultArr;
        }

        public function getAllSrc(){
            $tag_arr = ArrayHelper::string2array($this->img_src);
            return $tag_arr;
        }

        public function getFirstImgSrc(){
            $tag_arr = ArrayHelper::string2array($this->thumbnail_src);

            if(count($tag_arr) > 0){
                return $tag_arr[0];
            }else{
                return null;
            }
        }

        public function getOlderGroupProduct(){
            $groupProduct = GroupProduct::model()->olderGroupProduct($this->group_id,$this->id)->findAll();
            return $groupProduct;
        }

        public function getNewerGroupProduct(){
            $groupProduct = GroupProduct::model()->newerGroupProduct($this->group_id,$this->id)->findAll();
            return $groupProduct;
        }

/** @private-command-method */
        private function incrementViewCount(){
            $this->updateCounters(
                array('popularity'=>1),
                "id = :id",
                array(':id' => $this->id)
            );
        }

        private function incrementNonUserViewCount(){
            $this->updateCounters(
                array('non_user_popularity'=>1),
                "id = :id",
                array(':id' => $this->id)
            );
        }
/** @private-query-method */
/** @relation-command */

        public function deepDelete($thatTransaction=null){

            $transaction=null;
            $isHandlingTransaction = $thatTransaction==null;
            if($isHandlingTransaction){
                $transaction = Yii::app()->db->beginTransaction();
            }else{
                $transaction = $thatTransaction;
            }

            try{
                /** remove all related events */
                $allEventRelations_array = $this->eventRelations;
                foreach($allEventRelations_array as $eventRelation){
                    $eventRelation->delete();
                }

                //remove all viewed relation
                $allUserViewdRelation_array = $this->UserViewedRelations;
                foreach($allUserViewdRelation_array as $userViewedRelation){
                    $userViewedRelation->delete();
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

        private function addUserViewedGroupProduct($userId){
            $relation = new UserViewedGroupProduct;
                $relation->group_product_id=$this->id;
                $relation->user_id=$userId;
                $relation->url_referrer=Yii::app()->request->urlReferrer;
                $relation->view_datetime=DateTimeHelper::now();
                $relation->count=1;
                $relation->save();
        }

        /** @GroupProductJoinEvent */
        public function addJoinEvent($eventId){
            $relation = new GroupProductJoinEvent;
            $relation->product_id=$this->id;
            $relation->event_id=$eventId;
            $relation->save();
        }

        public function removeJoinEvent($eventId){
            $relation = GroupProductJoinEvent::model()->findByPk(array('product_id'=>$this->id,'event_id'=>$eventId));
            $relation->delete();
        }

        public function addJoinEvents($event_arr_id){
            //assume it is validated
            if(count($event_arr_id) > 0){
                foreach($event_arr_id as $event_id){
                    $this->addJoinEvent($event_id);
                }
            }
        }

        public function updateJoinEvents(){
            $diff = new DiffHelper($this->getJoinEventsIdArray(),$this->new_event_arr_id);

            $newEventIdArray = $diff->getNewlyAddedValue();
            foreach($newEventIdArray as $id){
                $this->addJoinEvent($id);
            }

            $removeEventIdArray = $diff->getNewlyRemovedValue();
            foreach($removeEventIdArray as $id){
                $this->removeJoinEvent($id);
            }
        }
/** @relation-query */
        /** @group */
         public function getOwnedGroup(){
            $ownedGroup = $this->group;
            return $ownedGroup;
        }

        /** @user */
        public function isUserIdOwner($userId){
            $group = $this->group;
                if($group->isGroupOwners($userId)){
                    return true;
                }
            return false;
        }

        public function isGroupBelongToUser(){
                $group = Group::model()->findByPk($this->group_id);
                if($group==null){
                    $this->addError('group_id','Group does not exit');
                    return;
                }
                $userID = Yii::app()->user->id;

                if(!$group->isApproved()){
                    $this->addError('group_id','組織還沒被確認');
                }

                if(!$group->isGroupOwners($userID)){
                    $this->addError('group_id','you are not the owner');
                }
        }

        /** @GroupProductJoinEvent */
        public function getJoinEvents(){
            return $this->events;
        }

        public function getJoinEventsIdArray(){
            $IdArray = array();
            $EventsObjArray = $this->getJoinEvents();

            foreach($EventsObjArray as $event){
                array_push($IdArray, $event->id);
            }
            return $IdArray;
        }
/** @view-specific */

        public function getEventLinks(){
            $allEvents = $this->events;
            $croppedEvents_arr = array_slice($allEvents, 0, 4);
            $link_arr=array();
            foreach($croppedEvents_arr as $event)
            {
                    $htmlEncodedEventTitle = CHtml::encode($event->title);
                    $url=Yii::app()->createUrl('event/view',  SeoHelper::eventViewSEORouteArrayParam($event));
                    //echo CHtml::link($htmlEncodedTagName,array('illust/index','search'=>$htmlEncodedTagName),array('class'=>'label label-info','title'=>$htmlEncodedTagName));
                    array_push($link_arr, "<a href='$url' title='$htmlEncodedEventTitle'> <span class='label label-warning'> $htmlEncodedEventTitle </span> </a>");
            }
            return $link_arr;
        }

        public function getOlderGroupProductLink(){
            $groupProduct_arr = $this->getOlderGroupProduct();
            if(count($groupProduct_arr) == 0){
                return '';
            }
            $groupProduct=$groupProduct_arr[0];
            $link = CHtml::link(CHtml::encode('上一張作品: '.$groupProduct->title), SeoHelper::groupProductViewSEORouteArrayParam($groupProduct));
            return $link;
        }

        public function getNewerGroupProductLink(){
            $groupProduct_arr = $this->getNewerGroupProduct();
            if(count($groupProduct_arr) == 0){
                return '';
            }
            $groupProduct=$groupProduct_arr[0];
            $link = CHtml::link(CHtml::encode('下一張作品: '.$groupProduct->title), SeoHelper::groupProductViewSEORouteArrayParam($groupProduct));
            return $link;
        }

        public function getAllTagsLink(){
            $tags_arr = $this->getTags();
            $tagLink_arr = array();
            foreach($tags_arr as $tag)
            {
                    $htmlEncodedTagName = CHtml::encode($tag);
                    $url=Yii::app()->createUrl('groupProduct/search',array('tag'=>$htmlEncodedTagName));
                    //echo CHtml::link($htmlEncodedTagName,array('illust/index','search'=>$htmlEncodedTagName),array('class'=>'label label-info','title'=>$htmlEncodedTagName));
                    array_push($tagLink_arr, "<a href='$url' title='$htmlEncodedTagName'> <span class='label label-info'> $htmlEncodedTagName </span> </a>");
            }
            return $tagLink_arr;
        }

        public function getTagsLink(){
            $tags_arr = $this->getTags();
            $croppedTags_arr = array_slice($tags_arr, 0, 4);
            $tagLink_arr = array();
            foreach($croppedTags_arr as $tag)
            {
                    $htmlEncodedTagName = CHtml::encode($tag);
                    $url=Yii::app()->createUrl('groupProduct/search',array('tag'=>$htmlEncodedTagName));
                    //echo CHtml::link($htmlEncodedTagName,array('illust/index','search'=>$htmlEncodedTagName),array('class'=>'label label-info','title'=>$htmlEncodedTagName));
                    array_push($tagLink_arr, "<a href='$url' title='$htmlEncodedTagName'> <span class='label label-info'> $htmlEncodedTagName </span> </a>");
            }
            return $tagLink_arr;
        }
}
