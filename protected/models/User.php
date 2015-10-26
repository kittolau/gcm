<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $sex
 * @property string $website_url
 * @property string $summary
 * @property string $user_name
 * @property string $email
 * @property string $password
 * @property string $created_datetime
 * @property string $icon_src
 * @property integer $show_r18
 * @property integer $show_bl
 *
 * The followings are the available model relations:
 * @property Illust[] $illusts
 * @property Group[] $groups
 * @property UserFollowUser[] $userFollowUsers
 * @property UserFollowUser[] $userFollowUsers1
 * @property GroupProduct[] $groupProducts
 */
/** go to Group.php to see more detail, but this also contain some logic for login  */
class User extends CActiveRecord
{


/** @constant */
    const DEFAULT_ICON_PATH = 'img/usericon/noimage_user.png';
/** @public-data-member */
        public $password_repeat = null ;
        private $pwdChanged = false ;
        private $salt;

        /** @scope for Register only */
        public $isTermAccepted = false;
/** @private-data-member */

/** @framework-specific */
        
        /** @validation */
        public function canShowR18($R18AttributeName){
            if($this->$R18AttributeName){
                $birthdayDT = new DateTime($this->birthday);
                $birthdayPlus18 = $birthdayDT->add(new DateInterval('P18Y'));
                $DTInterval = $birthdayPlus18->diff(new DateTime(DateTimeHelper::now()));
                $intervalSign = $DTInterval->format("%R");
                $isUnder18 =  $intervalSign == "-";
                if($isUnder18){
                    $this->addError($R18AttributeName,'18歲以下不能開啟R18');
                }
            }
            return;
        }
        
        public function isValidPassword($passwordToBeValidate){
            $this->salt = $this->saltPassword($this->user_name . "salt0103938273646" );
            $hashed_pw = $this->encrypt($passwordToBeValidate, $this->salt);
            if($this->password == $hashed_pw)
                return true;
            else
                return false;
        }
        
          /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return User the static model class
        */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }
        /**
        * @return string the associated database table name
        */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        //General
                        array('birthday','date','format'=>'yyyy-M-d'),
                        array('email', 'length', 'max'=>50),
                        array('email','email'),
                        array('nickname', 'length', 'min'=>1, 'max'=>15),
                        array('nickname','match','pattern'=>'/^[a-zA-Z0-9\s\x{4E00}-\x{9FFF}]*$/u','message'=>'只可使用 中文, 英文 或 數字'),
                        array('nickname','match','pattern'=>'/^[\S]+/u','message'=>'不能以空白鍵開頭'),
                        array('nickname','required'),
                        //Register case
                        array('user_name,password_repeat,password,email,birthday', 'required','on'=>'register'),
                        array('user_name','match','pattern' => '/^[a-zA-Z0-9]*$/','message' => '只可使用英文字 或 數字'),
                        
                        array('user_name', 'length', 'min'=>5, 'max'=>20,'on'=>'register'),
                        array('password', 'length', 'min'=>8, 'max'=>20,'on'=>'register'),
                        array('password_repeat','compare','compareAttribute'=>'password','on'=>'register'),
                        array('email,user_name','unique','on'=>'register','message'=>'不可使用 {value}'),
                        array('isTermAccepted','compare','compareValue'=>TRUE,'message'=>'你必需同意服務條款','on'=>'register'),
                        
                    
			//array('sex, website_url, summary, user_name, email, password, created_datetime, icon_src', 'required'),
			array('show_r18, show_bl,accept_job', 'numerical', 'integerOnly'=>true,'on'=>'update'),
			array('sex', 'length', 'max'=>2,'on'=>'update'),
			array('website_url, email', 'length', 'max'=>100,'on'=>'update'),
                        array('website_url', 'url','on'=>'update'),
			array('summary', 'length', 'max'=>300),
                        array('email', "unique",'on'=>'update'),  
                        array('show_r18',"canShowR18",'on'=>'update'),
			//array('password', 'length', 'max'=>64),
                     
                     
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sex, website_url, summary, user_name, email, password, created_datetime, icon_src, show_r18, show_bl', 'safe', 'on'=>'search'),
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
			'illusts' => array(self::MANY_MANY, 'Illust', 'user_own_illust(user_id, illust_id)'),
			'groups' => array(self::MANY_MANY, 'Group', 'user_member_group(user_id, group_id)'),
                        'followingUsers' => array(self::MANY_MANY, 'User', 'user_follow_user(user_id, follow_user_id)'),
                        //'followedByUsers' => array(self::MANY_MANY, 'User', 'user_follow_user(follow_user_id, user_id)'),
                        'followedCount' => array(self::STAT, 'User', 'user_follow_user(user_id, follow_user_id)'),
			'followedByUsersRelation' => array(self::HAS_ONE, 'UserFollowUser', 'follow_user_id'),
                        'followedByUsers' => array(self::HAS_MANY, 'User', array('user_id'=>'id'),'through'=>'followedByUsersRelation'),
                        'follwingGroups'=> array(self::MANY_MANY, 'Group', 'user_follow_group(user_id, group_id)'),
                        'joinedGroup'=> array(self::MANY_MANY, 'Group', 'user_member_group(user_id, group_id)'),
			'groupProducts' => array(self::MANY_MANY, 'GroupProduct', 'user_viewed_group_product(user_id, group_product_id)'),
                        'memberRelation' => array(self::HAS_MANY, 'UserMemberGroup', 'user_id'),
                        'OwnedGroup' => array(self::HAS_MANY, 'Group', array('group_id'=>'id'),'through'=>'memberRelation','condition'=>'memberRelation.is_leader=1'),
                        'joinedApprovedGroup' => array(self::MANY_MANY, 'Group', 'user_member_group(user_id, group_id)','condition'=>'joinedApprovedGroup.approved=1'),//you need to use the relation name to apply the condition
                        'OwnedApprovedGroup' => array(self::HAS_MANY, 'Group', array('group_id'=>'id'),'through'=>'memberRelation','condition'=>'memberRelation.is_leader=1 AND OwnedApprovedGroup.approved=1'),
                        'bookmarkedIllust' => array(self::MANY_MANY, 'Illust', 'user_bookmark_illust(user_id, illust_id)'),
                    
                        //relation
                        'userFollowedByUserRelation' =>array(self::HAS_MANY, 'UserFollowUser', 'follow_user_id'),
                        'userFollowUserRelation' =>array(self::HAS_MANY, 'UserFollowUser', 'user_id'),
                        'userFollowGroupRelation' => array(self::HAS_MANY, 'UserFollowGroup', 'user_id'),
                        'userViewedGroupProductRelation' => array(self::HAS_MANY, 'UserViewedGroupProduct', 'user_id'),
                        'userViewedIllustRelation' => array(self::HAS_MANY, 'UserViewedIllust', 'user_id'),
                        'bookmarkedIllustsRelation' => array(self::HAS_MANY, 'UserBookmarkIllust', 'user_id'),
                        'joinedGroupRelation' => array(self::HAS_MANY, 'UserMemberGroup', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sex' => '性別',
			'website_url' => '個人網頁',
			'summary' => '個人簡介',
			'user_name' => '登入使用者名稱',
			'email' => 'Email',
			'password' => '密碼',
			'created_datetime' => '創建時間',
			'icon_src' => 'Icon Src',
			'show_r18' => '顯示R18',
			'show_bl' => '顯示BL',
                        'accept_job'=>'接受工作委託',
                        'birthday'=>'生日日期',
                        'isTermAccepted'=>'同意服務條款',
                        'nickname'=>'昵稱'
		);
	}
        
        /** @callback */
        protected function beforeSave() {
            if($this->isNewRecord){
                $this->password = $this->createPassword();
                $this->created_datetime = DateTimeHelper::now();
                
            }
            elseif($this->pwdChanged){
              $this->password = $this->createPassword();
            }
            return parent::beforeSave();
          }
          
          protected function afterFind(){
              if(StringHelper::isNullOrEmpty($this->icon_src)){
                  $this->icon_src = User::DEFAULT_ICON_PATH;
              }
              return parent::afterFind();
          }
        
/** @public-command-method */
          public function setAttributes($attributes, $safe = true ) {
            foreach($attributes as $name => $value){
              $this->setAttribute($name, $value);
            }
            return true;
          }
          
          private function markAsPasswordChanged(){
              $this->pwdChanged = true ;
          }
          
          public function setAttribute($name, $value) {
            if($name == "password"){
                $this->markAsPasswordChanged();
            }
            parent::setAttribute($name, $value);
          }
          
          public function purgePassword(){
              $this->password ="";
              $this->password_repeat = "";
          }
          
          public function resetPasswordAs($newPassword){
              $this->password = $newPassword;
              $this->markAsPasswordChanged();
          }
          
/** @public-query-method */

        public static function findLoginUser($userNameFieldValue){
            $user = User::Model()->find('user_name=:user_name',array(':user_name'=>$userNameFieldValue));
            return $user;
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
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('website_url',$this->website_url,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created_datetime',$this->created_datetime,true);
		$criteria->compare('icon_src',$this->icon_src,true);
		$criteria->compare('show_r18',$this->show_r18);
		$criteria->compare('show_bl',$this->show_bl);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
        /*
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
         * */
        
/** @private-command-method */
        protected function createPassword(){
            $this->salt = $this->saltPassword($this->user_name . "salt0103938273646" );
            return $this->encrypt($this->password, $this->salt);
          } 
        
        protected  function encrypt($rawPwd, $salt){
            return md5("{$rawPwd}.{$salt}");
          }
          
          protected function saltPassword($salt){
            return md5($salt);
          }
/** @private-query-method */
        
/** @relation-command */
        
        public function unfollowGroup($followGroupId){

                    $relation = UserFollowGroup::model()->findByPk(array('user_id'=>$this->id,'group_id'=>$followGroupId));
                    $relation->delete();
        }
        
        public function followGroup($followGroupId){
                    $relation = new UserFollowGroup;
                    $relation->user_id=$this->id;
                    $relation->group_id=$followGroupId;
                    $relation->save();
        }
        
        public function bookmarkIllust($illustId){
                    $relation = new UserBookmarkIllust;
                    $relation->user_id=$this->id;
                    $relation->illust_id=$illustId;
                    $relation->save();
        }
        
        public function unbookmarkIllust($illustId){

                    $relation = UserBookmarkIllust::model()->findByPk(array('user_id'=>$this->id,'illust_id'=>$illustId));
                    $relation->delete();
        }
        
        public function followUser($followUserId){
                    $relation = new UserFollowUser;
                    $relation->user_id=$this->id;
                    $relation->follow_user_id=$followUserId;
                    $relation->save();
        }
        
        public function unfollowUser($followUserId){

                    $relation = UserFollowUser::model()->findByPk(array('user_id'=>$this->id,'follow_user_id'=>$followUserId));
                    $relation->delete();
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
                /** remove all Illust */
                $allUserIllust_array = $this->illusts;
                foreach($allUserIllust_array as $illust){
                    $illust->deepDelete($transaction);
                }

                /**remove all group */
                $allUserOwnedGroup_array = $this->OwnedGroup;
                foreach($allUserOwnedGroup_array as $group){
                    $group->deepDelete($transaction);
                }
                
                //remove all user joined group relation
                $ajjJoinedGroupRelation_array = $this->joinedGroupRelation;
                foreach($ajjJoinedGroupRelation_array as $joinedGroupRelation){
                    $joinedGroupRelation->delele();
                }
                
                $allBookmarkRelation_array = $this->bookmarkedIllustsRelation;
                foreach($allBookmarkRelation_array as $bookmarkRelation){
                    $bookmarkRelation->delele();
                }
                
                $allUserViewedGroupProductRelation_array = $this->userViewedGroupProductRelation;
                foreach($allUserViewedGroupProductRelation_array as $groupProductViewedRelation){
                    $groupProductViewedRelation->delele();
                }
                
                $allUserViewedIllustRelation_array = $this->userViewedIllustRelation;
                foreach($allUserViewedIllustRelation_array as $IllustViewedRelation){
                    $IllustViewedRelation->delele();
                }
                /*
                $allFollowingGroupRelation_array = $this->userFollowGroupRelation;
                foreach($allFollowingGroupRelation_array as $followingGroupRelation){
                    $followingGroupRelation->delele();
                }
                */
                $userFollowGroupModel = new UserFollowGroup();
                $userFollowGroupModel->deleteAll('user_id=:user_id',array(':user_id'=>$this->id));
                /*
                $allFollowUserRelation_array = $this->userFollowUserRelation;
                foreach($allFollowUserRelation_array as $followingUserRelation){
                    $followingUserRelation->delele();
                }
                
                $allFollowedByUserRelation_array = $this->userFollowedByUserRelation;
                foreach($allFollowedByUserRelation_array as $followedByUserRelation){
                    $followedByUserRelation->delele();
                }
                */
                $userFollowUserModel = new UserFollowUser();
                $userFollowUserModel->deleteAll('user_id=:user_id',array(':user_id'=>$this->id));
                
                $userFollowUserModel = new UserFollowUser();
                $userFollowUserModel->deleteAll('follow_user_id=:user_id',array(':user_id'=>$this->id));
                
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
        
        public function isFollowedByUser($userId){
            
            $followedByUser = $this->followedByUsers;
            foreach($followedByUser as $followingUser){

                if($followingUser->id == $userId){
                    //if the current user is followed by the user who is currently loged in
                    return true;
                }
            }
            return false;
        }
        
        public function getFollowingUsers(){
            return $this->followingUsers;
        }

        public function getFollowingUsersIdArr(){
            $userArr = $this->getFollowingUsers();
            $userIdArr = array();
            foreach($userArr as $u){
                array_push($userIdArr,$u->id);
            }
            return $userIdArr;
        }

        public function getFollowingGroups(){
            return $this->follwingGroups;
        }

        public function getFollowingGroupsIdArr(){
            $groupArr = $this->getFollowingGroups();
            $groupIdArr = array();
            foreach($groupArr as $g){
                array_push($groupIdArr,$g->id);
            }
            return $groupIdArr;
        }

        public function getFollowedUsers(){
            return $this->followedByUsers;
        }

        public function getFollowedCount(){
            return $this->followedCount;
        }

        public function getAllJoinedGroup(){
            return $this->joinedApprovedGroup;
        }
        
        /** @UserBookmarkIllust */
        public function getBookmarkedIllust(){
            return $this->bookmarkedIllust;
        }

        public function getBookmarkedIllustId(){
            $IllustArr = $this->getBookmarkedIllust();
            $IllustIdArr = array();
            foreach($IllustArr as $i){
                array_push($IllustIdArr,$i->id);
            }
            return $IllustIdArr;
        }
        
        /** @UserMemberGroup relation */
        public static function getOwnedApprovedGroupArray($userID){
            $user = User::model()->findByPk($userID);
            $OwnedGroups = $user->OwnedApprovedGroup;
            return $OwnedGroups;
        }

        public static function getOwnedGroupArray($userID){
            $user = User::model()->findByPk($userID);
            $OwnedGroups = $user->OwnedGroup;
            return $OwnedGroups;
        }
            
/** @view-specific */
        public static function getListDataForGroupOwner($userID){
            $OwnedGroups = User::getOwnedGroupArray($userID);
            return CHtml::listData($OwnedGroups,'id','group_name');
        }
}
