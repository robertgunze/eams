<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view','PasswordReset'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','PasswordChange','AjaxUpdate','mdas'),
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
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
                        $model->password = $model->hashPassword($model->password);
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

		if (isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        /*
         * Updates user model via ajax
         */
        
        public function actionAjaxUpdate()
	{
		$es = new EditableSaver('User');
                $es->update();
	}
        
        /*
         * Changes password for a logged in user
         */
        
        public function actionPasswordChange(){
            
            $model = $this->loadModel(Yii::app()->user->id);
            
            if(isset($_POST['new_password'])){
                $newPassword = $model->hashPassword($_POST['new_password']);
                $model->password = $newPassword;
                if($model->save()){
                    Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'Password changed.');
                }else{
                    Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR,'Password change failed.');
                }
                
            }
            $this->render('_password_change',
                    array(
                        'model'=>$model
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
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['User'])) {
			$model->attributes=$_GET['User'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionMdas(){
                $model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['User'])) {
			$model->attributes=$_GET['User'];
		}
                 
                $model->is_mda = true;
		$this->render('mda_admin',array(
			'model'=>$model,
		));
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='user-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionPasswordReset(){
            if(isset($_POST['email'])){
               $email = $_POST['email'];
               $user = User::model()->find('email=:email',array(':email'=>$email));
               if($user){
                   $newPassword =rand(10000,99999);
                   $user->password = $user->hashPassword($newPassword);
                   $user->save();
                   //send email
                   $senderDetails['name'] = Yii::app()->name;
                   $senderDetails['email'] = Yii::app()->params['eamsEmail'];
                   $receiverDetails['name'] = $user->first_name;
                   $receiverDetails['email'] = $email;
                   $subject = "Password Reset";
                   $message = "Dear {$user->first_name}\r\n".
                           "Your new password is: {$newPassword} \r\n".
                           "Please login and remember to change your password";
                   Notification::sendEmail($senderDetails, $receiverDetails, $subject, $message);
                   Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'The new password has been sent to your email');
               }else{
                   Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR,'Email supplied doesn\'t match any user account in the database');
               }
               
            }
            
            $this->render('_password_reset_form');
        }
}