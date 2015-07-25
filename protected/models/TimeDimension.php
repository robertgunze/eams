<?php

/**
 * This is the model class for table "tbl_time_dimension".
 *
 * The followings are the available columns in table 'tbl_time_dimension':
 * @property integer $id
 * @property string $daytimekey
 * @property string $daymonth
 * @property string $dayquarter
 * @property string $dayyear
 */
class TimeDimension extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_time_dimension';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('daytimekey', 'required'),
			array('daytimekey', 'length', 'max'=>10),
			array('daymonth', 'length', 'max'=>3),
			array('dayquarter', 'length', 'max'=>2),
			array('dayyear', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, daytimekey, daymonth, dayquarter, dayyear', 'safe', 'on'=>'search'),
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
			'daytimekey' => 'Daytimekey',
			'daymonth' => 'Daymonth',
			'dayquarter' => 'Dayquarter',
			'dayyear' => 'Dayyear',
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
		$criteria->compare('daytimekey',$this->daytimekey,true);
		$criteria->compare('daymonth',$this->daymonth,true);
		$criteria->compare('dayquarter',$this->dayquarter,true);
		$criteria->compare('dayyear',$this->dayyear,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getTimeIdByDate($date){
           $dateKey = date("dmy");
           $model = TimeDimension::model()->find('daytimekey=:key',array(':key'=>$dateKey));
           if($model){
               return $model->id;
           }
           return NULL;
        }

        public static function generateTimeline($seed='2013-07-01'){
                for($i=0; $i < 1826 ; $i++){
                    $date = strtotime("+$i day", strtotime($seed));
                   
                    $month = date("M", $date);
                    if($month=='Jul'||$month=='Aug'||$month=='Sep'){
                        $quarter = 'Q1';
                    }elseif($month=='Oct'||$month=='Nov'||$month=='Dec'){
                        $quarter = 'Q2';
                    }elseif($month=='Jan'||$month=='Feb'||$month=='Mar'){
                        $quarter = 'Q3';
                    }elseif($month=='Apr'||$month=='May'||$month=='Jun'){
                        $quarter = 'Q4';
                    }
                    
                     $year = date('Y',$date);
//                     echo date("dmy", $date);
//                     echo $month;
//                     echo $quarter;
//                     echo $year;
                     
                     $model = new TimeDimension();
                     $model->daytimekey = date("dmy", $date);
                     $model->daymonth = $month;
                     $model->dayquarter = $quarter;
                     $model->dayyear = $year;
                     $model->save();
                     
                     }
                     
                 echo 'Done generating timeline!';
                
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TimeDimension the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
