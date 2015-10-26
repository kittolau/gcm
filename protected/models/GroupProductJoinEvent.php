<?php

/**
 * This is the model class for table "group_product_join_event".
 *
 * The followings are the available columns in table 'group_product_join_event':
 * @property integer $product_id
 * @property integer $event_id
 */
/** go to Group.php to see more detail */
class GroupProductJoinEvent extends CActiveRecord
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
		return 'group_product_join_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, event_id', 'required'),
			array('product_id, event_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('product_id, event_id', 'safe', 'on'=>'search'),
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
			'product_id' => 'Product',
			'event_id' => 'Event',
		);
	}
/** @public-command-method */
/** @public-query-method */
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

		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('event_id',$this->event_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GroupProductJoinEvent the static model class
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
