<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property integer $id
 * @property string $title
 * @property string $event_date
 * @property string $event_time_interval
 * @property string $apply_date
 * @property string $place_rent
 * @property string $lat_lng
 * @property string $event_place_title
 *
 * The followings are the available model relations:
 * @property GroupProduct[] $groupProducts
 */
class Event extends CActiveRecord
{

/** @constant */
/** @public-data-member */
/** @private-data-member */
/** @framework-specific */


    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, event_date, event_time_interval, apply_date, place_rent, lat_lng, event_place_title, ticket_price', 'required'),
			array('title, event_time_interval, lat_lng, event_place_title', 'length', 'max'=>50),
			array('place_rent', 'length', 'max'=>100),
                        array('official_website_url,apply_form_url', 'length', 'max'=>500),
                        array('official_website_url,apply_form_url', 'url'),
                        ModelRuleHelper::booleanValidateRule('is_doujin,is_stage,is_cosplay,is_product_upload_allowed,is_promotion_iframe_allowed'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, event_date, event_time_interval, apply_date, place_rent, lat_lng, event_place_title', 'safe', 'on'=>'search'),
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
			'groupProducts' => array(self::MANY_MANY, 'GroupProduct', 'group_product_join_event(event_id, product_id)'),
                        'GroupProductsCount' => array(self::STAT, 'GroupProduct', 'group_product_join_event(event_id, product_id)'),
                        'GroupJoinEventRelations'=>array(self::HAS_MANY, 'GroupProductJoinEvent', 'event_id'),
                        'JoinedGroupsProducts' => array(self::HAS_MANY, 'GroupProduct', array('product_id'=>'id'),'through'=>'GroupJoinEventRelations'),
                        'JoinedGroups' => array(self::HAS_MANY, 'Group', array('group_id'=>'id'),'through'=>'JoinedGroupsProducts'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '活動名稱',
			'event_date' => '活動日期',
			'event_time_interval' => '活動時間',
			'apply_date' => '開始申請時間',
			'place_rent' => '租金',
			'lat_lng' => 'Lat Lng',
			'event_place_title' => '活動地點',
                        'ticket_price'=>'門票',
                        'is_doujin'=>'誌',
                        'is_stage'=>'舞台表演',
                        'is_cosplay'=>'Cosplay',
                        'is_product_upload_allowed'=>'是否給組織登陸制品',
                        'is_promotion_iframe_allowed'=>'是否容許制品宣傳框架',
                        'official_website_url'=>'官方網站link'
		);
	}

        /** @namedscope */
        public function onlyPassEvent(){
            $today = DateTimeHelper::today();

            $this->getDbCriteria()->mergeWith(array(
                'condition'=>'event_date<:event_date',
                'params'=>array(':event_date'=>  $today)
            ));
            return $this;
        }

        public function onlyTodayAndFutherEvent(){
            $today = DateTimeHelper::today();

            $this->getDbCriteria()->mergeWith(array(
                'condition'=>'event_date>=:event_date',
                'params'=>array(':event_date'=>  $today)
            ));
            return $this;
        }

        public function onlyUploadableEvent(){
            $this->getDbCriteria()->mergeWith(array(
                'condition'=>'is_product_upload_allowed=1',
            ));
            return $this;
        }

/** @public-command-method */
        public function save_img_src($SavedFileRelativePaths,$savedThumbnailFileRelativePaths){

            $serializedPath = ArrayHelper::array2string($SavedFileRelativePaths);
            $serializedThumbnailPath = ArrayHelper::array2string($savedThumbnailFileRelativePaths);

            $illustJustSaved = Event::model()->findByPk($this->id);
            $illustJustSaved->icon_src = $serializedPath;
            $illustJustSaved->icon_thumbnail_src = $serializedThumbnailPath;
            $illustJustSaved->save();
        }


/** @public-query-method */

        public function getPassedEventData(){
            $criteria=new CDbCriteria;

            $today = DateTimeHelper::today();
            $criteria->mergeWith(array(
                'condition'=>'event_date<:event_date',
                'params'=>array(':event_date'=>  $today)
            ));

            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            //'defaultOrder'=>'popularity DESC'
                            'defaultOrder'=>'`t`.event_date ASC'
                        ),
                        'pagination'=>array(
                            'pageSize'=>25,
                        )
		));
        }

        public function getIndexData(){
            $criteria=new CDbCriteria;

            $today = DateTimeHelper::today();
            $criteria->mergeWith(array(
                //'with'=>array('GroupProductsCount','JoinedGroups'),
                'condition'=>'event_date>=:event_date',
                'params'=>array(':event_date'=>  $today),
                //'together'=>true
            ));

            /*
             * There may be some problem with the yii's model relation
             * although it is tested that it works locally
             * but it wont work properly on the server
             * dont know why
             */

            //$criteria->with = array('GroupProductsCount','JoinedGroups');

            //$criteria->together = true;

            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            //'defaultOrder'=>'popularity DESC'
                            'defaultOrder'=>'`t`.event_date ASC'
                        ),
                        'pagination'=>array(
                            'pageSize'=>10,
                        )
		));
        }

        public function getSortableOptions(){
            $sortableOptions = array(
               'event_date'=> '最近期日期',
            );
            return $sortableOptions;
        }

        public function isEventAvailableForAdding(){
            return true;
        }

        public static function getAllEventAvailable(){
            $allEvents = Event::model()->onlyTodayAndFutherEvent()->findAll();
            return $allEvents;
        }

        public static function getPastEvent(){
            $allEvents = Event::model()->onlyPassEvent()->findAll();
            return $allEvents;
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('event_date',$this->event_date,true);
		$criteria->compare('event_time_interval',$this->event_time_interval,true);
		$criteria->compare('apply_date',$this->apply_date,true);
		$criteria->compare('place_rent',$this->place_rent,true);
		$criteria->compare('lat_lng',$this->lat_lng,true);
		$criteria->compare('event_place_title',$this->event_place_title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            //'defaultOrder'=>'popularity DESC'
                            'defaultOrder'=>'`t`.event_date ASC'
                        ),
                        'pagination'=>array(
                            'pageSize'=>10,
                        )
		));
	}

        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Event the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

        public static function getListDataForAllEventAvailable(){
            $allEvents = Event::model()->onlyTodayAndFutherEvent()->onlyUploadableEvent()->findAll();
            return CHtml::listData($allEvents,'id','title');
        }

/** @private-command-method */
/** @private-query-method */
/** @relation-command */
/** @relation-query */
/** @view-specific */
}
