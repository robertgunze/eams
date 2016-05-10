<?php

class EamsFilesImportController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','archive'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function loadCommonMarketDataFromFile($model){

        $filename = Yii::getPathOfAlias('webroot').'/uploads/imports/'.$model->name;
        spl_autoload_unregister(array('YiiBase','autoload'));
        $phpExcelPath = Yii::getPathOfAlias('application.vendor.phpoffice');
        include($phpExcelPath.DIRECTORY_SEPARATOR.'PHPExcel.php');
                
                    
        $objPHPExcel = PHPExcel_IOFactory::load($filename);
        $worksheet = $objPHPExcel->getSheet(0);
        $objPHPExcel->getActiveSheet()->getStyle('C2')
            ->getNumberFormat()
            ->setFormatCode(
                'mm-dd-yyyy'  // my own personal preferred format that isn't predefined
            );
        $headingColsCount = 0;
        foreach($worksheet->getRowIterator() as $row){
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);
            foreach($cellIterator as $cell){
                $cellContent = $cell->getValue();
                $data[$cell->getRow()][$cell->getColumn()] = $cellContent;
                if($headingColsCount < 15){
                    if(preg_match('/^Protocol_ID$/i', $cellContent)){
                        $headingRow = $cell->getRow();
                        $protocolIdCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if(preg_match('/^Freedoms \/ Rights$/i', $cellContent)){
                        $protocolDetailsCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if(preg_match('/^Protocol_Provision_ID$/i', $cellContent)){
                        $protocolProvisionCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if(preg_match('/^Provision$/i', $cellContent)){
                        $protocolProvisionDescCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if(preg_match('/^data_field_code$/i', $cellContent)){
                        $dataFieldCodeCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if(preg_match('/^data_field_desc$/i', $cellContent)){
                        $dataFieldDescCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if(preg_match('/^Indicator_ID$/i', $cellContent)){
                        $indicatorIdCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if(preg_match('/^Indicator$/i', $cellContent)){
                        $indicatorDescCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if(preg_match('/^Data Collection Guidelines$/i', $cellContent)){
                        $dataColGuidelinesCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                }
            }

          }
             
                
        unset($data[$headingRow]);
        
        spl_autoload_register(array('YiiBase','autoload'));
        
        $readData = [];
        foreach($data as $dataItem){
            $fact = [];
            $fact['protocol_id'] = $dataItem[$protocolIdCol];
            $fact['protocol_details'] = $dataItem[$protocolDetailsCol];
            $fact['protocol_provision_id'] = $dataItem[$protocolProvisionCol];
            $fact['protocol_provision_description'] = $dataItem[$protocolProvisionDescCol];
            $fact['data_field_code'] = $dataItem[$dataFieldCodeCol];
            $fact['data_field_desc'] = $dataItem[$dataFieldDescCol];
            $fact['indicator_id'] = $dataItem[$indicatorIdCol];
            $fact['indicator_description'] = $dataItem[$indicatorDescCol];
            $fact['data_collection_guidelines'] = $dataItem[$dataColGuidelinesCol];
            $fact['date_created'] = date('Y-m-d H:i:s');
            $fact['create_user_id'] = Yii::app()->user->id;
            $fact['date_updated'] = date('Y-m-d H:i:s');
            $fact['update_user_id'] = Yii::app()->user->id;
            $readData[] = $fact;
            
        }

        return $readData;
	}

	public function loadDecisionDataFromFile($model){
		//get decision source
		$decisionSourceModel = EacLookup::model()->find('`key` = :key',[':key'=>$model->import_key]);	
		//extract data fro file
		spl_autoload_unregister(array('YiiBase', 'autoload'));
        $phpExcelPath = Yii::getPathOfAlias('application.vendor.phpoffice');
        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
        spl_autoload_register(array('YiiBase', 'autoload'));
        $filename = Yii::getPathOfAlias('webroot') . '/uploads/imports/'.$model->name;
        $objPHPExcel = PHPExcel_IOFactory::load($filename);
        $worksheet = $objPHPExcel->getSheet(0);
        $objPHPExcel->getActiveSheet()->getStyle('C2')
                ->getNumberFormat()
                ->setFormatCode(
                        'mm-dd-yyyy'  // my own personal preferred format that isn't predefined
        );
        $headingColsCount = 0;
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);
            foreach ($cellIterator as $cell) {
                $cellContent = $cell->getValue();
                $data[$cell->getRow()][$cell->getColumn()] = $cellContent;
                if ($headingColsCount < 15) {
                    if (preg_match('/^id$/i', $cellContent)) {
                        $headingRow = $cell->getRow();
                        $idCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if (preg_match('/^Decision Reference$/i', $cellContent)) {
                        $decisionReferenceCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if (preg_match('/^Decision Date$/i', $cellContent)) {
                        $decisionDateCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if (preg_match('/^Description$/i', $cellContent)) {
                        $descriptionCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if (preg_match('/^BudgetaryImplications$/i', $cellContent)) {
                        $budgetaryImplicationCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if (preg_match('/^TimeFrame$/i', $cellContent)) {
                        $timeFrameCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if (preg_match('/^Performance Indicators$/i', $cellContent)) {
                        $performanceIndicatorsCols = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if (preg_match('/^Responsibility Center$/i', $cellContent)) {
                        $responsibilityCenterCols = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if (preg_match('/^MeetingNo$/i', $cellContent)) {
                        $meetingNoCol = $cell->getColumn();
                        $headingColsCount++;
                    }
                    if($model->import_key === 'sc'){//sectoral council decisions
                    	if (preg_match('/^sectoral_council_id$/i', $cellContent)) {
	                        $sectoralCouncilIdCol = $cell->getColumn();
	                        $headingColsCount++;
                        }
                    }
                }
            }
        }


        unset($data[$headingRow]);
        
        $readData = [];
        foreach($data as $dataItem){
            $decision = [];
            $decision['eams_central_id'] = $dataItem[$idCol];
            $decision['decision_reference'] = $dataItem[$decisionReferenceCol];
            $decision['decision_source_id'] = $decisionSourceModel->id;
            $decision['sectoral_council_id'] = @$sectoralCouncilIdCol;//save null if not present
            $formattedDate = $this->excelDateToPhp($dataItem[$decisionDateCol]);
            $decision['decision_date'] = $formattedDate;
            $decision['description'] = $dataItem[$descriptionCol];
            $decision['budgetary_implications'] = $dataItem[$budgetaryImplicationCol];
            $decision['time_frame'] = $dataItem[$timeFrameCol];
            $decision['performance_indicators'] = $dataItem[$performanceIndicatorsCols];
            $decision['responsibility_center'] = $dataItem[$responsibilityCenterCols];
            $decision['meeting_no'] = $dataItem[$meetingNoCol];
            $decision['date_created'] = date('Y-m-d H:i:s');
            $decision['create_user_id'] = Yii::app()->user->id;
            $readData[] = $decision;
        }

        return $readData;
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{   
		$model = $this->loadModel($id);

		if($model->import_key === 'cm'){
           $readData = $this->loadCommonMarketDataFromFile($model);
           $view = 'cm_view';
           $keyField = 'indicator_id';
		}else{
		   $readData = $this->loadDecisionDataFromFile($model);
		   $view = 'view';
		   $keyField = 'eams_central_id';
		}

        $arrayDataProvider = new CArrayDataProvider($readData, array(
	        'id' => 'excelDatProvider',
	        'keyField' =>$keyField,
	        'pagination' => array(
	        'pageSize' => 10,
	        ),
        ));
      
		$this->render($view,array(
			'model'=>$model, 'arrayDataProvider' => $arrayDataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new EamsFilesImport;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['EamsFilesImport'])) {
			$model->attributes=$_POST['EamsFilesImport'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['EamsFilesImport'])) {
			$model->attributes=$_POST['EamsFilesImport'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('EamsFilesImport');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EamsFilesImport('search');
		$model->unsetAttributes();  // clear any default values
		//$model->archived = 0; //not archived
		if (isset($_GET['EamsFilesImport'])) {
			$model->attributes=$_GET['EamsFilesImport'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Archive import files
	 */
	public function actionArchive($id){
		$model = $this->loadModel($id);
		$model->archived = true;
		if($model->save()){
		   $this->redirect(array('admin'));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EamsFilesImport the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EamsFilesImport::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EamsFilesImport $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='eams-files-import-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}