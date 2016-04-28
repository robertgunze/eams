<?php

/**
 * This is the model class for table "tbl_eac_lookup".
 *
 * The followings are the available columns in table 'tbl_eac_lookup':
 * @property integer $id
 * @property integer $type
 * @property string $key
 * @property string $description
 * @property integer $eams_central_id
 */
class EacLookup extends CActiveRecord
{
        const SECTORAL_COUNCIL =1;
        const IMPLEMENTATION_STATUS = 2;
        const DECISION_SOURCE = 3;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_eac_lookup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, description, eams_central_id', 'required'),
			array('type, eams_central_id', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type,key,description, eams_central_id', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'key'=>'Key',
			'description' => 'Description',
			'eams_central_id' => 'Eams Central ID',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('key',$this->key);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('eams_central_id',$this->eams_central_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getLookupTypes(){
            return array(
                self::SECTORAL_COUNCIL=>'Sectoral Council',
                self::IMPLEMENTATION_STATUS=>'Implementation Status',
                self::DECISION_SOURCE=>'Decision Source'
            );
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EacLookup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
