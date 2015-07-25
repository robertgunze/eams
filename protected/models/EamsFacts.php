<?php

/**
 * This is the model class for table "tbl_eams_facts".
 *
 * The followings are the available columns in table 'tbl_eams_facts':
 * @property string $id
 * @property string $framework_ind_id
 * @property integer $time_id
 * @property integer $is_reported
 * @property string $data_ref_date
 * @property string $indicator_value
 * @property integer $created_by
 * @property string $timestamp
 */
class EamsFacts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_eams_facts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('framework_ind_id', 'required'),
			array('time_id, is_reported,created_by', 'numerical', 'integerOnly'=>true),
			array('framework_ind_id', 'length', 'max'=>20),
			array('indicator_value', 'length', 'max'=>50),
			array('timestamp,data_ref_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, framework_ind_id, time_id, data_ref_date, indicator_value, created_by, timestamp', 'safe', 'on'=>'search'),
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
                    'eamsFrameworkIndicatorMapping' => array(self::BELONGS_TO, 'EamsFrameworkIndicatorMapping', 'framework_ind_id'),
                    'timeDimension' => array(self::BELONGS_TO, 'TimeDimension', 'time_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'framework_ind_id' => 'Framework Ind',
			'time_id' => 'Time',
			'data_ref_date' => 'Data Ref Date',
			'indicator_value' => 'Indicator Value',
			'created_by' => 'Created By',
			'timestamp' => 'Timestamp',
		);
	}
        
        public static function getIndicatorsToReport(){
            $criteria = new CDbCriteria();
            $criteria->compare('is_reported',0);
            
            return new CActiveDataProvider('EamsFacts',array(
                'criteria'=>$criteria
            ));
        }
        
        public static function getIndicatorsToReportCount(){
            $criteria = new CDbCriteria();
            $criteria->compare('is_reported',0);
            
            return self::model()->count($criteria);
        }
        
        public static function loadNotifier(){
        
        $pending = self::getIndicatorsToReportCount();
        $badgeStyle = "badge badge-default";
        if($pending > 0){
            $badgeStyle = "badge badge-success";
        }
        return '<ul class="nav pull-right">
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                       
                        <span class="notification-icon">
                          <span class="icon-globe large"></span>
                          <span class="'.$badgeStyle.'">'.$pending.'</span>
                        </span>
                        <strong class="caret"></strong></a>
                       </li>
                      </ul>';
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
		$criteria->compare('framework_ind_id',$this->framework_ind_id,true);
		$criteria->compare('time_id',$this->time_id);
		$criteria->compare('data_ref_date',$this->data_ref_date,true);
		$criteria->compare('indicator_value',$this->indicator_value,true);
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
	 * @return EamsFacts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
