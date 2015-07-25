<?php

/**
 * This is the model class for table "tbl_frequency".
 *
 * The followings are the available columns in table 'tbl_frequency':
 * @property integer $id
 * @property string $description
 * @property string $code
 * @property integer $period
 *
 * The followings are the available model relations:
 * @property EamsFacts[] $eamsFacts
 * @property IndicatorFrequencyMapping[] $indicatorFrequencyMappings
 */
class Frequency extends CActiveRecord
{
        const DAILY = 'daily';
        const WEEKLY = 'weekly';
        const MONTHLY = 'monthly';
        const QUARTERLY = 'quarterly';
        const BI_ANNUALY = 'bi-annually';
        const ANNUALLY = 'annualy';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_frequency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, code,period', 'required'),
			array('period', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description,code, period', 'safe', 'on'=>'search'),
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
			'eamsFacts' => array(self::HAS_MANY, 'EamsFacts', 'time_id'),
             
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
                        'code'=>'Frequecy Code',
			'period' => 'Period',
                    
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
                $criteria->compare('period',$this->code);
		$criteria->compare('period',$this->period);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Frequency the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
