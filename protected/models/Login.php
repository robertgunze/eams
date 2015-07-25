<?php

/**
 * This is the model class for table "tbl_login".
 *
 * The followings are the available columns in table 'tbl_login':
 * @property integer $id
 * @property integer $user_id
 * @property integer $status
 * @property string $details
 * @property string $other_details
 * @property string $date_created
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Login extends CActiveRecord
{
    
        const FAILED_LOGIN = 0;
        const SUCCESSFUL_LOGIN = 1;
        const LOGGED_OUT = 2;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_login';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, status, details, other_details', 'required'),
			array('user_id, status', 'numerical', 'integerOnly'=>true),
			array('details, other_details', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, status, details, other_details, date_created', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'status' => 'Status',
			'details' => 'Details',
			'other_details' => 'Other Details',
			'date_created' => 'Date Created',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('other_details',$this->other_details,true);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * Logs login actions by users to keep track of logins
         * @param int $status
         * @param string $details
         */
        public static function log($status,$details){
            
           $model = new Login();
           $model->status = $status;
           $model->details = $details;
           $model->other_details = "User Agent: ".
                   Yii::app()->request->userAgent.
                   " IP Address: ".
                   Yii::app()->request->userHostAddress;
           if(Yii::app()->user->id){
               $model->user_id = Yii::app()->user->id;
           }
           $model->save();
              
        }
        
        /**
         * 
         * @param int $id
         * @return string status description
         */
        public function getStatus(){
            switch ($this->status) {
                case self::FAILED_LOGIN:
                    return "Failed Login";
                    break;
                case self::SUCCESSFUL_LOGIN:
                    return "Successful Login";
                    break;
                case self::LOGGED_OUT:
                    return "Logged Out";
                    break;

                default:
                    return "Unknown";
                    break;
            }
            
        }
        
        /**
         * 
         * @return array an Array of status strings
         */
        public static function getStatusOptions(){
            return array(
                self::FAILED_LOGIN=>'Failed Logins',
                self::SUCCESSFUL_LOGIN=>'Successful Logins',
                self::LOGGED_OUT=>'Logged Out'
            );
        }

        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Login the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
