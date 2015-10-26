<?php

/**
 * This is the model class for table "group".
 *
 * The followings are the available columns in table 'group':
 * @property integer $id
 * @property string $group_name
 * @property string $group_summary
 * @property string $created_datetime
 * @property integer $popularity
 * @property integer $is_recuiting
 * @property string $website_url
 * @property string $contact_email
 * @property string $facebook_url
 * @property integer $is_auto_approved
 * @property string $icon_src
 *
 * The followings are the available model relations:
 * @property GroupProduct[] $groupProducts
 * @property User[] $users
 * @property User[] $users1
 */
class Group extends CActiveRecord
{

/** @constant */
    const DEFAULT_IMG_PATH = "img/Group/circle.png";

/** @public-data-member */
/** @private-data-member */
/** @framework-specific */

        /**
         * Model's Display Name in the input form or anywhere in the programme
         */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_name' => '組織名稱',
			'group_summary' => '組織簡介',
			'created_datetime' => 'Created Datetime',
			'popularity' => 'Popularity',
			'is_recuiting' => 'Is Recuiting',
			'website_url' => '組織網頁網址',
			'contact_email' => 'Email',
			'facebook_url' => 'Facebook網址',
			'is_auto_approved' => 'Is Auto Approved',
			'icon_src' => 'Icon',
		);
	}

        /**
	 * the associated database table name for this model
	 */
	public function tableName()
	{
		return 'group';
	}

	/**
	 * validation rules for model attributes.
         * This is also used during mass assignment like $model->attributes = $_GET['Group'];
         *
         * if the attribute is not exist in the validation rule of specifc scenario or the validation rule is not 'safe'
         * then that attribute will be omitted during mass assignment.
	 */
	public function rules()
	{

		return array(
                        //general
                        array('group_summary', 'length', 'max'=>150),
                        array('website_url,facebook_url', 'url'),
                        array('website_url, contact_email, facebook_url', 'length', 'max'=>100),
                        array('is_auto_approved','match','pattern'=>'/^[01]{1}$/'),
                        //oncreate only
			array('group_name, contact_email', 'required','on'=>'create'),
			array('group_name', 'length','min'=>1, 'max'=>25),
                        //array('group_name','match','pattern'=>'/^[a-zA-Z0-9\s\x{4E00}-\x{9FFF}]*$/u','message'=>'只可使用 中文, 英文 或 數字'),
                        array('group_name','match','pattern'=>'/^[\S]+/u','message'=>'不能以空白鍵開頭'),
                        array('group_name', 'unique','on'=>'create','message'=>'已有組織 {value}'),

                        array('contact_email', 'email','on'=>'create'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, group_name, group_summary, created_datetime, popularity, is_recuiting, website_url, contact_email, facebook_url, is_auto_approved, icon_src', 'safe', 'on'=>'search'),
		);
	}

	/**
         * Yii's orm relation config, see http://www.yiiframework.com/doc/guide/1.1/en/database.arr for more detail
         */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                        //relational model
			'groupProducts' => array(self::HAS_MANY, 'GroupProduct', 'group_id'),
                        'JoinedEventRelation' => array(self::HAS_MANY, 'GroupProductJoinEvent', array('id'=>'product_id'),'through'=>'groupProducts'),
                        'MostRecentgroupProduct' => array(self::HAS_MANY, 'GroupProduct', 'group_id','order'=>'created_datetime DESC','limit'=>1),
			'followingUsers' => array(self::MANY_MANY, 'User', 'user_follow_group(group_id, user_id)'),
                        'followedCount' => array(self::STAT, 'User', 'user_follow_group(group_id, user_id)'),
                        'UserFollowGroupRelations' => array(self::HAS_MANY, 'UserFollowGroup', 'group_id'),

			'members' => array(self::MANY_MANY, 'User', 'user_member_group(group_id, user_id)'),
                        'memberRelation' => array(self::HAS_MANY, 'UserMemberGroup', 'group_id'),



                        //relational model via through
                        'GroupOwners' => array(self::HAS_MANY, 'User', array('user_id'=>'id'),'through'=>'memberRelation','condition'=>'memberRelation.is_leader=1'),
                        'membersPendingApprove' => array(self::HAS_MANY, 'User', array('user_id'=>'id'),'through'=>'memberRelation','condition'=>'memberRelation.is_approved=0'),
                        'approvedMembers' => array(self::HAS_MANY, 'User', array('user_id'=>'id'),'through'=>'memberRelation','condition'=>'memberRelation.is_approved=1'),
		);
	}

        /** @namedscope */
        public function ShowOnlyApprovedGroup(){
                //if user do not want to show r18
                $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'`t`.approved=:approved',
                    'params'=>array(':approved'=>1)
                ));
            return $this;
        }

        /** @callback */
        protected function beforeSave() {
            if($this->isNewRecord){
                $this->created_datetime = DateTimeHelper::now();
                $this->popularity =0;
            }else{
            }
            return parent::beforeSave();
          }

          protected function afterFind(){
              if(StringHelper::isNullOrEmpty($this->icon_src)){
                  $this->icon_src = Group::DEFAULT_IMG_PATH;
              }
              return parent::afterFind();
          }


          /** @public-command-method */
/** @public-query-method */
         public function isApproved(){
            return $this->approved == 1;
        }

        public function getSortableOptions(){
            $sortableOptions = array(
               'popularity' => '人氣', //default
               'created_datetime'=> '註冊日期',
            );
            return $sortableOptions;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Group the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

        public function isAutoApprove(){
            return $this->is_auto_approved;
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
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('group_summary',$this->group_summary,true);
		$criteria->compare('created_datetime',$this->created_datetime,true);
		$criteria->compare('popularity',$this->popularity);
		$criteria->compare('is_recuiting',$this->is_recuiting);
		$criteria->compare('website_url',$this->website_url,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('facebook_url',$this->facebook_url,true);
		$criteria->compare('is_auto_approved',$this->is_auto_approved);
		$criteria->compare('icon_src',$this->icon_src,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function getOnlyEventData($eventId){
            $criteria=new CDbCriteria;

            $criteria->mergeWith(array(
                'condition'=>'approved=1',
            ));

            $criteria->mergeWith(array(
                'with'=>'JoinedEventRelation',
                'condition'=>'JoinedEventRelation.event_id=:event_id',
                'params'=>array(':event_id'=>  $eventId),
                'together'=>true
            ));

            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }
/** @private-command-method */
/** @private-query-method */
/** @relation-command */
        public function addOwnerUser($userID){
            $relation = new UserMemberGroup;
            $relation->user_id=$userID;
            $relation->group_id = $this->id;
            $relation->joinded_datetime =  DateTimeHelper::now();
            $relation->is_leader=1; // remember to use 1 for boolean, using true will not make this record saving
            $relation->is_approved=1;
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
                //delete all group product that belong to this group
                $allGroupProduct_array = $this->groupProducts;
                foreach($allGroupProduct_array as $groupProduct){
                    $groupProduct->deepDelete($transaction);
                }

                //delete all event relation that this group joined
                $allEventRelation_array = $this->JoinedEventRelation;
                foreach($allEventRelation_array as $joinedEventRelation){
                    $joinedEventRelation->delete();
                }

                //delete all the user follow group relation
                $allUserFollowGroupRelations_array = $this->UserFollowGroupRelations;
                foreach($allUserFollowGroupRelations_array as $userFollowGroupRelation){
                    $userFollowGroupRelation->delete();
                }

                //delete all user joined group relation
                $allMemberRelation_array = $this->memberRelation;
                foreach($allMemberRelation_array as $memberRelation){
                    $memberRelation->delete();
                }

                //delete self
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

        /** @groupProduct */
        public function getLatestGroupProduct(){
            $groupProduct_arr = $this->MostRecentgroupProduct;
            if(count($groupProduct_arr) > 0)
                return $groupProduct_arr[0];
            else
                return new GroupProduct;
        }

        /** @user */
        public function getAllMembers(){
            return $this->members;
        }
        public function isUserPendingApprove($userID){
            $pendingUserList = $this->membersPendingApprove;
            foreach($pendingUserList as $user){
                if($user->id == $userID)
                    return true;
            }
            return false;
        }

        public function getLeaders(){
            $leaders = $this->GroupOwners;
            return $leaders;
        }

        public function getAllApprovedGroupMember(){
            return $this->approvedMembers;
        }

        public function isUserJoined($userID){
            $joinedUserList = $this->members;
            foreach($joinedUserList as $user){
                if($user->id == $userID)
                    return true;
            }
            return false;
        }

        public function isGroupOwners($userID){
            $groupOwnerList = $this->GroupOwners;
            foreach($groupOwnerList as $user){
               if($user->id == $userID)
                   return true;
           }
        }

        /** @UserMemberGroup relation */
        public function getMemberRelation(){
            return $this->memberRelation;
        }

        /** @UserFollowGroup */
        public function isFollowedByUser($currentLogedInUserId){
            $allFollowingUsers = $this->followingUsers;
            foreach($allFollowingUsers as $user){
                if($user->id == $currentLogedInUserId)
                    return true;
            }
            return false;
        }

        public function getFollowedCount(){
            return $this->followedCount;
        }
/** @view-specific */

















}
