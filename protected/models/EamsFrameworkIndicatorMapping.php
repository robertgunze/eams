<?php

/**
 * This is the model class for table "tbl_eams_framework_indicator_mapping".
 *
 * The followings are the available columns in table 'tbl_eams_framework_indicator_mapping':
 * @property integer $id
 * @property integer $indicator_id
 * @property integer $framework_id
 * @property integer $indicator_unit_id
 * @property integer $data_source_id
 * @property integer $created_by
 * @property string $timestamp
 *
 * The followings are the available model relations:
 * @property User $createdBy
 * @property Indicator $indicator
 * @property EamsFramework $framework
 * @property IndicatorUnit $indicatorUnit
 * @property IndicatorDataSource $dataSource
 */
class EamsFrameworkIndicatorMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_eams_framework_indicator_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('indicator_id, indicator_unit_id', 'required'),
			array('indicator_id, framework_id, indicator_unit_id, data_source_id, created_by', 'numerical', 'integerOnly'=>true),
			array('timestamp', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, indicator_id, framework_id, indicator_unit_id, data_source_id, created_by, timestamp', 'safe', 'on'=>'search'),
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
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
			'indicator' => array(self::BELONGS_TO, 'Indicator', 'indicator_id'),
			'framework' => array(self::BELONGS_TO, 'EamsFramework', 'framework_id'),
			'indicatorUnit' => array(self::BELONGS_TO, 'IndicatorUnit', 'indicator_unit_id'),
			'dataSource' => array(self::BELONGS_TO, 'IndicatorDataSource', 'data_source_id'),
                        'eamsFacts'=>array(self::HAS_MANY,'EamsFacts','framework_ind_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'indicator_id' => 'Indicator',
			'framework_id' => 'Framework',
			'indicator_unit_id' => 'Indicator Unit',
			'data_source_id' => 'Data Source',
			'created_by' => 'Created By',
			'timestamp' => 'Timestamp',
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
		$criteria->compare('indicator_id',$this->indicator_id);
		$criteria->compare('framework_id',$this->framework_id);
		$criteria->compare('indicator_unit_id',$this->indicator_unit_id);
		$criteria->compare('data_source_id',$this->data_source_id);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EamsFrameworkIndicatorMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
