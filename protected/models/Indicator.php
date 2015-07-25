<?php

/**
 * This is the model class for table "tbl_indicator".
 *
 * The followings are the available columns in table 'tbl_indicator':
 * @property integer $id
 * @property string $description
 * @property string $definition
 * @property string $interpretation
 * @property string $guid
 *
 * The followings are the available model relations:
 * @property EamsFrameworkIndicatorMapping[] $eamsFrameworkIndicatorMappings
 */
class Indicator extends CActiveRecord
{
       public $frequency;
       public $indicatorUnit;
       public $indicatorDataSource;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_indicator';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, definition, interpretation, guid,frequency, indicatorUnit,indicatorDataSource', 'required'),
			array('description', 'length', 'max'=>255),
			array('guid', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, definition, interpretation, guid', 'safe', 'on'=>'search'),
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
			'eamsFrameworkIndicatorMappings' => array(self::HAS_MANY, 'EamsFrameworkIndicatorMapping', 'indicator_id'),
                        'indicatorFrequency' => array(self::MANY_MANY, 'Frequency', 'tbl_indicator_frequency_mapping(indicator_id, frequency_id)'),
                        'indicatorFramework' => array(self::MANY_MANY, 'EamsFramework', 'tbl_eams_framework_indicator_mapping(indicator_id, framework_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'description' => 'Description',
			'definition' => 'Definition',
			'interpretation' => 'Interpretation',
			'guid' => 'Guid',
                        'frequency'=>'Frequency'
		);
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('definition',$this->definition,true);
		$criteria->compare('interpretation',$this->interpretation,true);
		$criteria->compare('guid',$this->guid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Indicator the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
