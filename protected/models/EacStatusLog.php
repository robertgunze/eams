<?php

/**
 * This is the model class for table "tbl_eac_status_log".
 *
 * The followings are the available columns in table 'tbl_eac_status_log':
 * @property integer $id
 * @property integer $decision_id
 * @property integer $status_id
 * @property string $status_narrative
 * @property string $remarks
 * @property integer $approved
 * @property integer $create_user_id
 * @property string $date_created
 * @property integer $update_user_id
 * @property string $date_updated
 *
 * The followings are the available model relations:
 * @property EacDecision $decision
 * @property EacLookup $status
 * @property User $updateUser
 * @property User $createUser
 */
class EacStatusLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_eac_status_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('decision_id, status_id,status_narrative, approved, create_user_id, date_created, date_updated', 'required'),
			array('decision_id, status_id, approved, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('remarks','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, decision_id, status_id, remarks, approved, create_user_id, date_created, update_user_id, date_updated', 'safe', 'on'=>'search'),
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
			'decision' => array(self::BELONGS_TO, 'EacDecision', 'decision_id'),
			'status' => array(self::BELONGS_TO, 'EacLookup', 'status_id'),
			'updateUser' => array(self::BELONGS_TO, 'User', 'update_user_id'),
			'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'decision_id' => 'Decision',
			'status_id' => 'Status',
                        'status_narrative'=>'Implementation Status Narrative',
			'remarks' => 'Remarks',
			'approved' => 'Approved',
			'create_user_id' => 'Create User',
			'date_created' => 'Date Created',
			'update_user_id' => 'Update User',
			'date_updated' => 'Date Updated',
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
		$criteria->compare('decision_id',$this->decision_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('remarks',$this->remarks,true);
                $criteria->compare('status_narrative',$this->remarks,true);
		$criteria->compare('approved',$this->approved);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('update_user_id',$this->update_user_id);
		$criteria->compare('date_updated',$this->date_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EacStatusLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
