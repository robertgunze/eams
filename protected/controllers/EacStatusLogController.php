<?php

class EacStatusLogController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
				'actions'=>array('create','update'),
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
	public function actionCreate($id)
	{
		$model=new EacStatusLog;
		$decision = EacDecision::model()->findByPk($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['EacStatusLog'])) {
			$model->attributes=$_POST['EacStatusLog'];
                        $model->decision_id = $id;
                        $model->approved = 0;//not approved
                        $model->create_user_id = Yii::app()->user->id;
                        $model->date_created = date('Y-m-d H:i:s');
                        $model->date_updated = date('Y-m-d H:i:s');
			if ($model->save()) {
                if($decision){
                    $decision->implementation_status_id = $model->status_id;
                    $decision->save();
                    Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'Status updated successfully.');
                }
                $criteria = new CDbCriteria;
                $criteria->addColumnCondition(array('is_mda'=>0),'OR');
                $mdas = $decision->getAssignedMdasIds();
                $criteria->addInCondition('mda_id',$mdas);
                $recipients = User::getNotificationSubscribers($criteria);
                $loggedInUser =User::model()->findByPk(Yii::app()->user->user_id);
                $from = "";
                if(Yii::app()->user->is_mda){
                	$mda = $loggedInUser->mda;
                	$from = $mda->description;
                }else{
                	$meacOffice = $loggedInUser->meacOffice;
                	$from = $meacOffice->description;
                }
                $message = "Decision {$decision->decision_reference}-({$decision->description}) has been updated by ".Yii::app()->user->getState('loggedInUser').
                        " from {$from}<br />";
                $message.= $model->status_narrative."<br />";
                $message.="For more information click ".TbHtml::link("here",Yii::app()->getBaseUrl(true)."/index.php?r=eacDecision/view&id={$decision->id}");
                $this->notify($recipients,'Decision Update',$message);
				$this->redirect(array('/eacDecision/view','id'=>$id));
			}
		}

		$this->render('create',array(
			'model'=>$model,'decision'=>$decision
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

		if (isset($_POST['EacStatusLog'])) {
			$model->attributes=$_POST['EacStatusLog'];
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
		$dataProvider=new CActiveDataProvider('EacStatusLog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EacStatusLog('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['EacStatusLog'])) {
			$model->attributes=$_GET['EacStatusLog'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EacStatusLog the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EacStatusLog::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EacStatusLog $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='eac-status-log-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}