<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $sex
 * @property string $is_mda
 * @property string $mda_id
 * @property string $meac_office_id
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property EamsFrameworkIndicatorMapping[] $eamsFrameworkIndicatorMappings
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, sex,active', 'required'),
			array('is_mda,mda_id,meac_office_id,active', 'numerical', 'integerOnly'=>true),
			array('username, password, first_name, middle_name, last_name', 'length', 'max'=>100),
			array('sex', 'length', 'max'=>1),
			array('email', 'email'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, first_name, middle_name, last_name, sex,phone,email,is_mda,mda_id,meac_office_id active', 'safe', 'on'=>'search'),
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
			'eamsFrameworkIndicatorMappings' => array(self::HAS_MANY, 'EamsFrameworkIndicatorMapping', 'created_by'),
                        'meacOffice'=>array(self::BELONGS_TO,'MeacOffice','meac_office_id'),
                        'mda'=>array(self::BELONGS_TO,'Mda','mda_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'sex' => 'Sex',
			'email' =>'Email',
			'phone' =>'Phone#',
            'is_mda' => 'Is Account for MDA User?',
            'mda_id' => 'MDA',
            'meac_office_id' => 'MEAC Office',
			'active' => 'Active',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
        $criteria->compare('mda_id',$this->mda_id);
        $criteria->compare('meac_office_id',$this->meac_office_id);
        $criteria->compare('is_mda',$this->is_mda);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function hashPassword($password){
            
            return sha1($password);
        }

        public static function getNotificationSubscribers($criteria){
           $users = self::model()->findAll($criteria);
           $recipients = array();
           foreach ($users as $key => $user) {
           	if(!empty($user->email)){
            	array_push($recipients,$user->email);
        	}
           }
           
           return $recipients;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
