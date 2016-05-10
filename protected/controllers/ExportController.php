<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExportController
 *
 * @author robert
 */
class ExportController extends Controller{
    
    public function actionAdmin(){
        $model = new ExportModel();
        
        if(isset($_POST['ExportModel'])){
           $model->attributes = $_POST['ExportModel'];
           if($model->validate()){
              $export_key = $model->export_type;
              if($export_key != 'cm'){
                 $this->exportDecisions($export_key);
              }else{
                 $this->exportCommonMarket();
              }
           }
        }
        $this->render('export_data',['model'=>$model]);
    }
    
    public function  exportDecisions($export_key){
            if(!Yii::app()->user->checkAccess("Export Decisions")){
                throw new CHttpException(403,'You are not authorized to access this feature');
            }

            if(isset($export_key)){
              $export_key = $export_key;
            }else{
                throw new CHttpException(404,'Invalid request'); 
            }
            //get decision source
            $decisionSourceModel = EacLookup::model()->find('`key` = :key',[':key'=>$export_key]);   
        
            $models = EacDecision::model()->findAll('decision_source_id = :id',[':id'=>$decisionSourceModel->id]);
            spl_autoload_unregister(array('YiiBase','autoload'));
            $phpExcelPath = Yii::getPathOfAlias('application.vendor.phpoffice');
            include($phpExcelPath.DIRECTORY_SEPARATOR.'PHPExcel.php');
        // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

            // Set properties
            $objPHPExcel->getProperties()->setCreator("EAMS Country TZ")
                                         ->setLastModifiedBy("EAMs")
                                         ->setTitle("EAMS TZ Decisions Export")
                                         ->setSubject("EAMS TZ Decisions Export")
                                         ->setDescription("EAMS TZ Decisions Export")
                                         ->setKeywords("office 2007 openxml php")
                                         ->setCategory("decisions");

            $objPHPExcel->getActiveSheet()->setTitle('decisions');
            // Add heading row
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'Decision Reference')
                        ->setCellValue('B1', 'Description')
                        ->setCellValue('C1', 'Responsibility Center')
                        ->setCellValue('D1', 'Time Frame')
                        ->setCellValue('E1', 'Performance Indicators')
                        ->setCellValue('F1', 'Implementation Status')
                        ->setCellValue('G1', 'Status / Comments')
                        ->setCellValue('H1', 'ImplementationStatusID')
                        ->setCellValue('I1', 'id');
                $rowCount = 2;
                foreach($models as $model){
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("A$rowCount",$model->decision_reference)
                        ->setCellValue("B$rowCount",$model->description)
                        ->setCellValue("C$rowCount",$model->responsibility_center)
                        ->setCellValue("D$rowCount",$model->time_frame)
                        ->setCellValue("E$rowCount",$model->performance_indicators)
                        ->setCellValue("F$rowCount",$model->implementation_status_id)
                        ->setCellValue("G$rowCount",$model->sectoral_council_id.'Status / Comments')
                        ->setCellValue("H$rowCount",$model->implementation_status_id)
                        ->setCellValue("I$rowCount",$model->eams_central_id);
                        $rowCount++;
                }
            
            // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            // header('Content-Disposition: attachment;filename="template.xlsx"');
            // header('Cache-Control: max-age=0');
            
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            //$objWriter->save('php://output');
            $targetDir = Yii::getPathOfAlias('webroot').'/uploads/exports/';
            $filename = 'desicion_export_'.md5(time().uniqid('export',true)).'.xlsx';
            $objWriter->save($targetDir.$filename);
            spl_autoload_register(array('YiiBase','autoload'));

            $fileExportModel = new EamsFilesExport();
            $fileExportModel->name = $filename;
            $fileExportModel->export_key = $export_key;
            $fileExportModel->mime_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            $fileExportModel->file_extension = 'xlsx';
            $fileExportModel->file_size = filesize($targetDir.$filename);
            $fileExportModel->date_created = date('Y-m-d H:i:s');
            $fileExportModel->save();

            $this->sendFileToEamsCentral($fileExportModel);
            
    }
    
    public function  exportCommonMarket(){
            if(!Yii::app()->user->checkAccess("Export Decisions")){
                throw new CHttpException(403,'You are not authorized to access this feature');
            } 
            $export_key = 'cm';
            $models = EacFacts::model()->findAll();
            spl_autoload_unregister(array('YiiBase','autoload'));
            $phpExcelPath = Yii::getPathOfAlias('application.vendor.phpoffice');
            include($phpExcelPath.DIRECTORY_SEPARATOR.'PHPExcel.php');
        // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

            // Set properties
            $objPHPExcel->getProperties()->setCreator("EAMS Country TZ")
                                         ->setLastModifiedBy("EAMs")
                                         ->setTitle("EAMS TZ  Export")
                                         ->setSubject("EAMS TZ Export")
                                         ->setDescription("EAMS TZ Export")
                                         ->setKeywords("office 2007 openxml php")
                                         ->setCategory("common market");

            $objPHPExcel->getActiveSheet()->setTitle('Common Market');
            // Add heading row
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'Freedoms / Rights')
                        ->setCellValue('B1', 'Provision')
                        ->setCellValue('C1', 'Indicator')
                        ->setCellValue('D1', 'Data Collection Guidelines')
                        ->setCellValue('E1', 'Numeric Data')
                        ->setCellValue('F1', 'Alphanumeric Data')
                        ->setCellValue('G1', 'Indicator_ID')
                        ->setCellValue('H1', 'data_field_code')
                        ->setCellValue('I1', 'reporting_period')
                        ->setCellValue('J1', 'financial_year');
                $rowCount = 2;
                foreach($models as $model){
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("A$rowCount",$model->protocol_details)
                        ->setCellValue("B$rowCount",$model->protocol_provision_description)
                        ->setCellValue("C$rowCount",$model->indicator_description)
                        ->setCellValue("D$rowCount",$model->data_collection_guidelines)
                        ->setCellValue("E$rowCount",$model->numeric_data)
                        ->setCellValue("F$rowCount",$model->alphanumeric_data)
                        ->setCellValue("G$rowCount",$model->indicator_id)
                        ->setCellValue("H$rowCount",$model->data_field_code)
                        ->setCellValue("I$rowCount",'reporting period')
                        ->setCellValue("J$rowCount",'financial year');
                        $rowCount++;
                }
            
            // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            // header('Content-Disposition: attachment;filename="template.xlsx"');
            // header('Cache-Control: max-age=0');
            
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $targetDir = Yii::getPathOfAlias('webroot').'/uploads/exports/';
            $filename = 'common_market_export_'.md5(time().uniqid('export',true)).'.xlsx';
            $objWriter->save($targetDir.$filename);
            spl_autoload_register(array('YiiBase','autoload'));

            $fileExportModel = new EamsFilesExport();
            $fileExportModel->name = $filename;
            $fileExportModel->export_key = $export_key;
            $fileExportModel->mime_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            $fileExportModel->file_extension = 'xlsx';
            $fileExportModel->file_size = filesize($targetDir.$filename);
            $fileExportModel->date_created = date('Y-m-d H:i:s');
            $fileExportModel->save();

            $this->sendFileToEamsCentral($fileExportModel);
            
    }

    public function sendFileToEamsCentral($model){
        $targetDir = Yii::getPathOfAlias('webroot').'/uploads/exports/';

        $cfile = new CURLFile($targetDir.$model->name);
        $cfile->setMimeType($model->mime_type);
        $cfile->setPostFilename($model->name);

        $fields = [
           //'file'=>'@'.$targetDir.$model->name,//@ symbolizes a file field
           'file'=>$cfile,
           'filename'=>$model->name,
        ];

        switch ($model->export_key){
            case 'dc':
                $url = 'http://www.eamscentral.org/admin_import_tmp_depository/admin_import_tmp_dc.aspx';
                break;
            case 'exdc':
                $url = 'http://www.eamscentral.org/admin_import_tmp_depository/admin_import_tmp_exdc.aspx';
                
                break;
            case 'su':
                $url = 'http://www.eamscentral.org/admin_import_tmp_depository/admin_import_tmp_su.aspx';
                
                break;
            case 'exsu':
                $url = 'http://www.eamscentral.org/admin_import_tmp_depository/admin_import_tmp_exsu.aspx';
                
                break;
            case 'sc':
                $url = 'http://www.eamscentral.org/admin_import_tmp_depository/admin_import_tmp_sc.aspx';
                
                break;
            case 'cm':
                $url = 'http://www.eamscentral.org/admin_import_tmp_depository/admin_import_tmp_cm.aspx';
                break;
            
            default:
                break;
        }

        try{
            //post data to eams central
            echo $this->httpPost($url,$fields);

        }catch(Exception $ex){
            //update send status
            echo "Operation unsuccessful";
        }
        
    }
}

?>
