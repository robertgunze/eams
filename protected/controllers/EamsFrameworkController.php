<?php

class EamsFrameworkController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
//	public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update','loadParents','EACOutcomesAdmin','SPAdmin','LoadSPFramework','ViewSP'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
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
    
     public function actionViewSP($id) {
        $this->render('view_sp_report', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new EamsFramework;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['EamsFramework'])) {
            $model->attributes = $_POST['EamsFramework'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
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

        if (isset($_POST['EamsFramework'])) {
            $model->attributes = $_POST['EamsFramework'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
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
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('EamsFramework');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin($parent_id = null) {
        $model = new EamsFramework('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['EamsFramework'])) {
            $model->attributes = $_GET['EamsFramework'];
        }

        $this->render('admin', array(
            'model' => $model,
            'parent_id' => $parent_id
        ));
    }
    
     /**
     * Manages all models.
     */
    public function actionSPAdmin() {
        $model = new EamsFramework('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['EamsFramework'])) {
            $model->attributes = $_GET['EamsFramework'];
        }

        $this->render('sp_admin', array(
            'model' => $model,
        ));
    }
    
    public function actionLoadSPFramework(){
        $models = EamsFramework::model()->findAll();
        $treedata = array(
            'total'=>EamsFramework::model()->count(),
            'rows'=>array(),
            'footer'=>array('name'=>'SP Items','items'=>EamsFramework::model()->count(),'iconCls'=>'icon-sum')
        );
        foreach($models as $model){
            $treedata['rows'][] = array(
                'id'=>$model->id,
                'name'=> CHtml::link(
                        $model->framework_description,
                        $this->createUrl('eamsFramework/view',array('id'=>$model->id)),
                            array(
                                'target'=>'_blank'
                            )
                        ),
                'type'=>$model->type->description,
                '_parentId'=>$model->parent_id, 
                'state'=>'closed'
                
            );
        }
        
        echo CJSON::encode($treedata);
    }
    
    /**
     * Manages all models.
     */
    public function actionEACOutcomesAdmin($parent_id = null) {
        $criteria = new CDbCriteria();
        $criteria->compare('type_id', EamsFramework::EAC_OUTCOME );
        $dataProvider = new CActiveDataProvider('EamsFramework',array(
            'criteria'=>$criteria
        ));
        $this->render('eac_outcomes_admin', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return EamsFramework the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = EamsFramework::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param EamsFramework $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'eams-framework-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /* Function for loading types' parents */

    public function actionLoadParents() {
        $data = self::model()->findAll('type_id=:type', array(':type' => (int) $_POST['type']));

        $data = CHtml::listData($data, 'id', 'framework_description');

        echo "<option value=''>--select--</option>";
        foreach ($data as $value => $parent)
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($parent), true);
    }

}
