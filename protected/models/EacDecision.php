<?php

/**
 * This is the model class for table "tbl_eac_decision".
 *
 * The followings are the available columns in table 'tbl_eac_decision':
 * @property integer $id
 * @property integer $eams_central_id
 * @property string $decision_reference
 * @property string $decision_date
 * @property string $deadline
 * @property string $description
 * @property string $budgetary_implications
 * @property string $time_frame
 * @property string $performance_indicators
 * @property string $responsibility_center
 * @property integer $meeting_no
 * @property integer $sectoral_council_id
 * @property integer $implementation_status_id
 * @property integer $responsible_mda_id
 * @property string $date_created
 * @property integer $create_user_id
 * @property string $date_updated
 * @property integer $update_user_id
 */
class EacDecision extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_eac_decision';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eams_central_id, decision_date, description, time_frame, performance_indicators, meeting_no, date_created, create_user_id', 'required'),
			array('id, eams_central_id, meeting_no, sectoral_council_id, implementation_status_id, responsible_mda_id,create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			//array('decision_reference', 'length', 'max'=>100),
			array('description, budgetary_implications, time_frame, performance_indicators', 'length', 'max'=>5000),
			array('deadline','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, eams_central_id, decision_reference, decision_date,deadline,decision_source_id, description, budgetary_implications, time_frame, performance_indicators, responsibility_center, meeting_no, sectoral_council_id, implementation_status_id,responsible_mda_id, date_created, create_user_id, date_updated, update_user_id', 'safe', 'on'=>'search'),
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
                    'status'=>array(self::BELONGS_TO,'EacLookup','implementation_status_id'),
                    'statusLogs'=>array(self::HAS_MANY,'EacStatusLog','decision_id'),
                    'responsibleMda'=>array(self::BELONGS_TO,'Mda','responsible_mda_id'),
                    'responsibleMdas'=>array(self::MANY_MANY,'Mda','tbl_mda_decision_mapping(mda_id,decision_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'eams_central_id' => 'Eams Central',
                        'decision_source_id' => 'Decision Source',
			'decision_reference' => 'Decision Reference',
			'decision_date' => 'Decision Date',
			'deadline' => 'Deadline',
			'description' => 'Description',
			'budgetary_implications' => 'Budgetary Implications',
			'time_frame' => 'Time Frame',
			'performance_indicators' => 'Performance Indicators',
			'responsibility_center' => 'Responsibility Center',
			'meeting_no' => 'Meeting No',
			'sectoral_council_id' => 'Sectoral Council',
			'implementation_status_id' => 'Implementation Status',
                        'responsible_mda_id'=>'Responsible MDA',
			'date_created' => 'Date Created',
			'create_user_id' => 'Create User',
			'date_updated' => 'Date Updated',
			'update_user_id' => 'Update User',
		);
	}
        
        
        public function getStatusColor($data){
            
            if(!isset($data->implementation_status_id)){
                    return TbHtml::LABEL_COLOR_IMPORTANT;
                }
            
            $model = EacLookup::model()->find('type=:type AND id=:status_id',
                    array(
                        ':type'=>  EacLookup::IMPLEMENTATION_STATUS,
                        ':status_id' =>$data->implementation_status_id
                    ));
            
            if($model){
                if($model->color=='#468847'){
                    return TbHtml::LABEL_COLOR_SUCCESS;
                }if($model->color=='#D24842'){
                    return TbHtml::LABEL_COLOR_IMPORTANT;
                }if($model->color=='#F89406'){
                    return TbHtml::LABEL_COLOR_WARNING;
                }
                
            }
            
            return '';
        }
        
        public static function getImplementationStatusDistribution(){
            $totalDecisions = self::model()->count();
            if($totalDecisions!=0){
                $pending = 100 * self::model()->count('implementation_status_id=:id',array(':id'=>1))/$totalDecisions;
                $partial = 100 * self::model()->count('implementation_status_id=:id',array(':id'=>2))/$totalDecisions;
                $fully = 100 * self::model()->count('implementation_status_id=:id',array(':id'=>3))/$totalDecisions;
                
                return array(
                             array('Pending',$pending),
                             array('Fully Implementated',$fully),
                             array('Partially Implemented',$partial),
                       );
            }
            
            return null;
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
		$criteria->compare('eams_central_id',$this->eams_central_id);
		$criteria->compare('decision_reference',$this->decision_reference,true);
                $criteria->compare('decision_source_id',$this->decision_source_id);
		$criteria->compare('decision_date',$this->decision_date);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('budgetary_implications',$this->budgetary_implications,true);
		$criteria->compare('time_frame',$this->time_frame,true);
		$criteria->compare('performance_indicators',$this->performance_indicators,true);
		$criteria->compare('responsibility_center',$this->responsibility_center,true);
		$criteria->compare('meeting_no',$this->meeting_no);
		$criteria->compare('sectoral_council_id',$this->sectoral_council_id);
		if(Yii::app()->user->is_mda){
           $criteria->compare('responsible_mda_id',Yii::app()->user->mda_id);
        }
        $criteria->compare('responsible_mda_id',$this->responsible_mda_id);
		$criteria->compare('implementation_status_id',$this->implementation_status_id);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function decisionExists(){
		if(self::model()->exists('eams_central_id=:id',array(':id'=>$this->eams_central_id))){
			return true;
		}
		return false;
	}

	public function getStatusLogs(){
                $logs = $this->statusLogs;
		$thread = "";
		$thread.= "<div>";
                if($logs){
                    $logs = array(end($logs));
                    foreach ($logs as $key => $log) {
                            $thread.="<p>".$log->status_narrative;
                            $thread.="<br /><span><b><i>--".$log->createUser->first_name." ".$log->createUser->middle_name." ".$log->createUser->last_name."</i></b>";
                            $thread.= "</p>";
                    }
                }
		$thread.= "</div>";

		return $thread;
	}

	public static function getDecisionsApproachingDeadline(){
            return self::model()->count('datediff(deadline,now()) < 7');
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EacDecision the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
