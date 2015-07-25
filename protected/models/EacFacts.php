<?php

/**
 * This is the model class for table "tbl_eac_facts".
 *
 * The followings are the available columns in table 'tbl_eac_facts':
 * @property string $id
 * @property string $protocol_id
 * @property string $protocol_details
 * @property integer $protocol_provision_id
 * @property string $protocol_provision_description
 * @property integer $data_field_code
 * @property string $data_field_desc
 * @property integer $indicator_id
 * @property string $indicator_description
 * @property string $data_collection_guidelines
 * @property string $numeric_data
 * @property string $alphanumeric_data
 * @property string $date_created
 * @property integer $create_user_id
 * @property string $date_updated
 * @property integer $update_user_id
 */
class EacFacts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_eac_facts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('protocol_id, protocol_provision_id, protocol_provision_description, indicator_id, indicator_description,date_created, create_user_id, date_updated, update_user_id', 'required'),
			array('protocol_provision_id, data_field_code, indicator_id, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('protocol_id', 'length', 'max'=>10),
			array('protocol_details, protocol_provision_description, indicator_description, data_collection_guidelines', 'length', 'max'=>300),
			array('data_field_desc, numeric_data', 'length', 'max'=>50),
			array('alphanumeric_data', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, protocol_id, protocol_details, protocol_provision_id, protocol_provision_description, data_field_code, data_field_desc, indicator_id, indicator_description, data_collection_guidelines, numeric_data, alphanumeric_data, date_created, create_user_id, date_updated, update_user_id', 'safe', 'on'=>'search'),
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
			'protocol_id' => 'Protocol',
			'protocol_details' => 'Protocol Details',
			'protocol_provision_id' => 'Protocol Provision',
			'protocol_provision_description' => 'Protocol Provision Description',
			'data_field_code' => 'Data Field Code',
			'data_field_desc' => 'Data Field Desc',
			'indicator_id' => 'Indicator',
			'indicator_description' => 'Indicator Description',
			'data_collection_guidelines' => 'Data Collection Guidelines',
			'numeric_data' => 'Numeric Data',
			'alphanumeric_data' => 'Alphanumeric Data',
			'date_created' => 'Date Created',
			'create_user_id' => 'Create User',
			'date_updated' => 'Date Updated',
			'update_user_id' => 'Update User',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('protocol_id',$this->protocol_id,true);
		$criteria->compare('protocol_details',$this->protocol_details,true);
		$criteria->compare('protocol_provision_id',$this->protocol_provision_id);
		$criteria->compare('protocol_provision_description',$this->protocol_provision_description,true);
		$criteria->compare('data_field_code',$this->data_field_code);
		$criteria->compare('data_field_desc',$this->data_field_desc,true);
		$criteria->compare('indicator_id',$this->indicator_id);
		$criteria->compare('indicator_description',$this->indicator_description,true);
		$criteria->compare('data_collection_guidelines',$this->data_collection_guidelines,true);
		$criteria->compare('numeric_data',$this->numeric_data,true);
		$criteria->compare('alphanumeric_data',$this->alphanumeric_data,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EacFacts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
