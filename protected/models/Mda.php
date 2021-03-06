<?php

/**
 * This is the model class for table "tbl_mda".
 *
 * The followings are the available columns in table 'tbl_mda':
 * @property integer $id
 * @property string $description
 * @property string $abbrev
 * @property string $contact_details
 * @property string $phone_no
 * @property string $email
 * @property string $remarks
 */
class Mda extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_mda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, contact_details, phone_no, email', 'required'),
			array('description, contact_details, email, remarks', 'length', 'max'=>255),
			array('abbrev, phone_no', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, abbrev, contact_details, phone_no, email, remarks', 'safe', 'on'=>'search'),
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
			'description' => 'Description',
			'abbrev' => 'Abbrev',
			'contact_details' => 'Contact Details',
			'phone_no' => 'Phone No',
			'email' => 'Email',
			'remarks' => 'Remarks',
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
		$criteria->compare('abbrev',$this->abbrev,true);
		$criteria->compare('contact_details',$this->contact_details,true);
		$criteria->compare('phone_no',$this->phone_no,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mda the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
