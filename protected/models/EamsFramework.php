<?php

/**
 * This is the model class for table "tbl_eams_framework".
 *
 * The followings are the available columns in table 'tbl_eams_framework':
 * @property integer $id
 * @property string $framework_description
 * @property integer $type_id
 * @property integer $parent_id
 * @property string $guid
 *
 * The followings are the available model relations:
 * @property EamsFrameworkType $type
 * @property EamsFrameworkIndicatorMapping[] $eamsFrameworkIndicatorMappings
 */
class EamsFramework extends CActiveRecord
{
        const EAC_OUTCOME = 2;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_eams_framework';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('framework_description, type_id, guid', 'required'),
			array('type_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('framework_description', 'length', 'max'=>255),
			array('guid', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, framework_description, type_id, parent_id, guid', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'EamsFrameworkType', 'type_id'),
			'indicatorMappings' => array(self::HAS_MANY, 'EamsFrameworkIndicatorMapping', 'framework_id'),
                        'parent'=> array(self::BELONGS_TO,'EamsFramework','parent_id'),
                        'indicators' => array(self::MANY_MANY, 'Indicator', 'tbl_eams_framework_indicator_mapping(indicator_id,framework_id)'),
                        
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'framework_description' => 'Framework Description',
			'type_id' => 'Type',
			'parent_id' => 'Parent',
			'guid' => 'Guid',
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
	public function search($parent_id=null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                
                if($parent_id != null){
                    $criteria->condition = "parent_id={$parent_id}";
                }

		$criteria->compare('id',$this->id);
		$criteria->compare('framework_description',$this->framework_description,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('guid',$this->guid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EamsFramework the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
