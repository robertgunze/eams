<?php

class EacDecisionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

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
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','AjaxUpdate'),
				'users'=>array('admin','@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new EacDecision;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['EacDecision'])) {
			$model->attributes=$_POST['EacDecision'];
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

		if (isset($_POST['EacDecision'])) {
			$model->attributes=$_POST['EacDecision'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
    public function actionAjaxUpdate(){
        $mdas = $_POST['value'];
        //print_r($mdas);exit;
        foreach($mdas as $mda){
            $mapping = new MdaDecisionMapping();
            $mapping->decision_id = $_POST['pk'];
            $mapping->mda_id = $mda;
            if(!$mapping->exists('decision_id=:id AND mda_id=:mda', 
                    array(
                        ':id'=>$mapping->decision_id,
                        ':mda'=>$mapping->mda_id
                    ))){
                $mapping->save();
            }else{
                echo "Unable to assign";
            }
        }
        
        //Notify subscribers
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array('is_mda'=>1));
        $criteria->addInCondition('mda_id', $mdas);
        $recipients = User::getNotificationSubscribers($criteria);
        $message = "You have been assigned to report on decision ".$this->loadModel($_POST['pk'])->decision_reference." by the Ministry of East African Cooperation - (MEAC)<br />";
        $message.="For more information click ".TbHtml::link("here",Yii::app()->getBaseUrl(true)."/index.php?r=eacDecision/view&id={$_POST['pk']}");
        $this->notify($recipients,'Decision Update',$message);
       
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
		$dataProvider=new CActiveDataProvider('EacDecision');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($format="")
	{
		$model=new EacDecision('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['EacDecision'])) {
			$model->attributes=$_GET['EacDecision'];
		}

		if($format == 'pdf'){
			$this->widget('ext.eexcelview.EExcelView', array(
		     'dataProvider'=> $model->search(),
		     'title'=>'EAC Decisions/Directives',
		     'autoWidth'=>false,
		     'exportType' =>'PDF',
		     'grid_mode'=>'export',
		     'disablePaging'=>true,
		     'columns'=>array(
		     		'decision_reference',
			        'decision_date',
			        'description',
			        'budgetary_implications',
			        'time_frame',
			        'deadline',
			        'performance_indicators',
			        //'responsibility_center',
			        'meeting_no',
		     	),

			));
		}
		if($format == 'excel'){
			$this->widget('ext.eexcelview.EExcelView', array(
		     'dataProvider'=> $model->search(),
		     'title'=>'EAC Decisions/Directives',
		     'autoWidth'=>false,
		     'exportType' =>'Excel2007',
		     'grid_mode'=>'export',
		     'disablePaging'=>true

			));
		}
		if($format == 'csv'){
			$this->widget('ext.eexcelview.EExcelView', array(
		     'dataProvider'=> $model->search(),
		     'title'=>'EAC Decisions/Directives',
		     'autoWidth'=>false,
		     'exportType' =>'CSV',
		     'grid_mode'=>'export',
		     'disablePaging'=>true

			));
		}
		if($format == 'html'){
			$this->widget('ext.eexcelview.EExcelView', array(
		     'dataProvider'=> $model->search(),
		     'title'=>'EAC Decisions/Directives',
		     'autoWidth'=>false,
		     'exportType' =>'HTML',
		     'grid_mode'=>'export',
		     'disablePaging'=>true

			));
		}


		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EacDecision the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EacDecision::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EacDecision $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='eac-decision-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}