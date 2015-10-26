<?php

/**
 * This is the model class for table "illust_tag_frequency".
 *
 * The followings are the available columns in table 'illust_tag_frequency':
 * @property integer $id
 * @property string $tag
 * @property integer $frequency
 */
/** go to Group.php to see more detail */
class IllustTagFrequency extends CActiveRecord
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
		return 'illust_tag_frequency';
	}

	/**
     * @return array validation rules for model attributes.
     */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tag, frequency', 'required'),
			array('frequency', 'numerical', 'integerOnly'=>true),
			array('tag', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tag, frequency', 'safe', 'on'=>'search'),
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
		);
	}

	/**
     * @return array customized attribute labels (name=>label)
     */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tag' => 'Tag',
			'frequency' => 'Frequency',
		);
	}
   
/** @public-command-method */

        public function updateFrequency($oldTags, $newTags)
	{
		$oldTags=ArrayHelper::string2array($oldTags);
		$newTags=ArrayHelper::string2array($newTags);
		/*
		array_values() returns all the values from the array and indexes the array numerically.
		input:  array("size" => "XL", "color" => "gold");
		output: Array ( [0] => XL , [1] => gold)
         */
		$this->addTags(array_values(array_diff($newTags,$oldTags)));
		$this->removeTags(array_values(array_diff($oldTags,$newTags)));
	}

    //add the need tag that is added compare to the old tag
	public function addTags($tags)
	{
		$criteria=new CDbCriteria;
		//the in condition accept the array with values
		$criteria->addInCondition('tag',$tags);

		/*
		public integer updateCounters(array $counters, mixed $condition='', array $params=array ( ))

		the counters to be updated (column name=>increment value)
		query condition or criteria.
         */

		$this->updateCounters(array('frequency'=>1),$criteria);
		foreach($tags as $tag)
		{
			/*
			public boolean exists(mixed $condition='', array $params=array ( ))

			query condition or criteria.
			parameters to be bound to an SQL statement.
             */
			if(!$this->exists('tag=:tag',array(':tag'=>$tag)))
			{
				$tagRecord=new IllustTagFrequency;
				$tagRecord->tag=$tag;
				$tagRecord->frequency=1;
				$tagRecord->save();
			}
		}
	}
    
        public function removeTags($tags)
	{
		if(empty($tags))
			return;
		$criteria=new CDbCriteria;
		$criteria->addInCondition('tag',$tags);
		$this->updateCounters(array('frequency'=>-1),$criteria);

		/*
		deleteAll(where)
         */
		$this->deleteAll('frequency<=0');
	}

/** @public-query-method */

    /**
     * Returns tag names and their corresponding weights.
     * Only the tags with the top weights will be returned.
     * @param integer the maximum number of tags that should be returned
     * @return array weights indexed by tag names.
     */
	public function findTagWeights($limit=20)
	{
		$models=$this->findAll(array(
			'order'=>'frequency DESC',
			'limit'=>$limit,
		));

		$total=0;
		foreach($models as $model)
			$total+=$model->frequency;

		$tags=array();
		if($total>0)
		{
			foreach($models as $model)
				$tags[$model->name]=8+(int)(16*$model->frequency/($total+10));
			ksort($tags);
		}
		return $tags;
	}

	/**
     * Suggests a list of existing tags matching the specified keyword.
     * @param string the keyword to be matched
     * @param integer maximum number of tags to be returned
     * @return array list of matching tag names
     */
	public function suggestTags($keyword,$limit=20)
	{
		$tags=$this->findAll(array(
			'condition'=>'tag LIKE :keyword',
			'order'=>'frequency DESC, tag',
			'limit'=>$limit,
			'params'=>array( //parameters to be bound to an SQL statement.
				/*
				strtr: convert the string to other string

				$trans = array("h" => "-", "hello" => "hi", "hi" => "hello");
				echo strtr("hi all, I said hello", $trans);

				result:
					hello all, I said hi
                 */
				':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
			),
		));
		$names=array();
		foreach($tags as $tag)
			$names[]=$tag->tag;
		return $names;
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
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('frequency',$this->frequency);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    

	/**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return IllustTagFrequency the static model class
     */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
/** @private-command-method */
/** @private-query-method */
/** @relation-command */
/** @relation-query */
/** @view-specific */
    
    
	

	
}
