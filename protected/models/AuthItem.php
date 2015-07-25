<?php

/**
 * This is the model class for table "AuthItem".
 *
 * The followings are the available columns in table 'AuthItem':
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $bizrule
 * @property string $data
 *
 * The followings are the available model relations:
 * @property AuthAssignment[] $authAssignments
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren1
 */
class AuthItem extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return AuthItem the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'AuthItem';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, type,description', 'required'),
            array('name', 'unique'),
            array('type', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('description, bizrule, data', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('name, type, description, bizrule, data', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'authAssignments' => array(self::HAS_MANY, 'AuthAssignment', 'itemname'),
            'authItemChildren' => array(self::HAS_MANY, 'AuthItemChild', 'parent'),
            'authItemChildren1' => array(self::HAS_MANY, 'AuthItemChild', 'child'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'bizrule' => 'Bizrule',
            'data' => 'Data',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->compare('type', $this->type);
        $criteria->addCondition('type NOT IN (0,2)'); //Operations and Roles are Not Required to show up in Here.....
        $criteria->compare('description', $this->description, true);
        $criteria->compare('bizrule', $this->bizrule, true);
        $criteria->compare('data', $this->data, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function getItems() {
        $criteria = new CDbCriteria;
        $criteria->addCondition('type NOT IN (0)'); //Operations are Not Required to show up in Here.....
        $criteria->addCondition('type NOT IN (2)'); //Roles are Not Required to show up in Here.....
        return new CActiveDataProvider(self::model(), array(
                    'criteria' => $criteria, 'pagination' => array('pageSize' => 100)
                ));
    }

    public static function getRoles() {
        $criteria = new CDbCriteria;
        $criteria->addCondition('type=2'); //Roles are Not Required to show up in Here.....
        return new CActiveDataProvider(self::model(), array(
                    'criteria' => $criteria,
                ));
    }

}