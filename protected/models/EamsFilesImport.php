<?php

/**
 * This is the model class for table "tbl_eams_files_import".
 *
 * The followings are the available columns in table 'tbl_eams_files_import':
 * @property integer $id
 * @property string $name
 * @property string $import_key
 * @property string $mime_type
 * @property string $file_extension
 * @property integer $file_size
 * @property integer $archived
 * @property string $date_created
 * @property string $date_updated
 */
class EamsFilesImport extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_eams_files_import';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, mime_type, file_extension, date_created', 'required'),
			array('file_size', 'numerical', 'integerOnly'=>true),
			array('name, mime_type', 'length', 'max'=>255),
			array('file_extension', 'length', 'max'=>10),
			array('date_updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, import_key,mime_type, file_extension, file_size,archived, date_created, date_updated', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'import_key' => 'Import Key',
			'mime_type' => 'Mime Type',
			'file_extension' => 'File Extension',
			'file_size' => 'File Size',
			'archived' => 'Archived',
			'date_created' => 'Date Created',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('import_key',$this->import_key,true);
		$criteria->compare('mime_type',$this->mime_type,true);
		$criteria->compare('file_extension',$this->file_extension,true);
		$criteria->compare('file_size',$this->file_size);
		$criteria->compare('archived',$this->archived);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EamsFilesImport the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
