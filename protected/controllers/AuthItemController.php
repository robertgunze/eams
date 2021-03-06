<?php

class AuthItemController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow priveldged user  to perform user groups operations
                'actions' => array('index', 'view', 'createRole', 'createAction','update', 'admin', 'delete', 'roles', 'assignItems','GrantAccess','deactivate'),
//                'roles' => array('System Settings:-User Groups Management'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateRole() {
        $model = new AuthItem;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['AuthItem'])) {
            $model->attributes = $_POST['AuthItem'];
            if ($model->save()){
                $this->logAudit("Role ".$model->name." was created ");
                $this->redirect(array('view', 'id' => $model->name));
            }
        }

        $this->render('createRole', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['AuthItem'])) {
            $model->attributes = $_POST['AuthItem'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->name));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('AuthItem');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new AuthItem('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['AuthItem']))
            $model->attributes = $_GET['AuthItem'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */

    /**
     * Manages all Roles.
     */
    public function actionRoles() {
        $dataProvider = AuthItem::getRoles();
        $this->render('role', array('dataProvider' => $dataProvider));
        /* 	$model=new AuthItem('search');
          $model->unsetAttributes();  // clear any default values
          if(isset($_GET['AuthItem']))
          $model->attributes=$_GET['AuthItem'];
          $this->render('role',array(
          'model'=>$model,
          ));
         * 
         */
    }

    public function loadModel($id) {
        $model = AuthItem::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'auth-item-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Assigning Operations/Tasks to the User Roles/Groups of the Sysytem
     */
    public function actionAssignItems($name) {

        if (isset($_POST['submit'])) {
            $clear = AuthItemChild::clearAll($name);
            $auth = Yii::app()->authManager; //Initialing The Authentication Manager
            $role = $auth->getAuthItem($name);
            if (isset($_POST['name'])) {
                foreach ($_POST['name'] as $var) {
                    if ($var != 1){
                        $role->addChild($var); //Elements Checked
                        $this->logAudit("Action ".$var." was assigned to role ".$name);
                    }
                }
            }
            $success = "<div class='success'><p class='success'>Actions were added successfully...</p></div>";
            Yii::app()->user->setFlash('success', $success);
        }
        else {
            $success = "<div class='failure'><p class='failure'>Please,select atleast one action for the Group...</p></div>";
            Yii::app()->user->setFlash('success', $success);
        }

        $dataProvider = AuthItem::getItems();
        $this->render('batch', array(
            'dataProvider' => $dataProvider, 'name' => $name
        ));
    }
    
    
    /**
     * 
     * @param int $id the id of the user to be given access
     */
    public function actionGrantAccess($id){
        $user = User::model()->findByPk($id);
        if (isset($_POST['submit'])) {
            
            $clear = AuthAssignment::clearAll($id);
            $auth = Yii::app()->authManager; //Initialing The Authentication Manager
            if (isset($_POST['name'])) {
                foreach ($_POST['name'] as $value) {
                    if ($value != 1){//skipping select all
                        $auth->assign($value,$id);
                        $this->logAudit("Action ".$value." was assigned to user ".$user->username);
                        
                    }
                    
                }
                
            }
            $success = "<div class='success'><p class='success'>Roles were added successfully...</p></div>";
            Yii::app()->user->setFlash('success', $success);
        }
        else {
            $success = "<div class='failure'><p class='failure'>Please,select at least one role for the user...</p></div>";
            Yii::app()->user->setFlash('success', $success);
        }
        
        $this->render('_roles_batch',array(
            'dataProvider'=>  AuthItem::getRoles(),
            'model'=>  $user
        ));
    }
    
    
     /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateAction() {
        $model = new AuthItem;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['AuthItem'])) {
            $model->attributes = $_POST['AuthItem'];
            if ($model->save()){
                $this->logAudit("Action ".$model->name." was created ");
                $this->redirect(array('view', 'id' => $model->name));
            }
        }

        $this->render('createAction', array(
            'model' => $model,
        ));
    }

}

