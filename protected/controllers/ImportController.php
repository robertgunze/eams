<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImportController
 *
 * @author robert
 */
class ImportController extends Controller{
    //put your code here
    
    public function actionImportDecisions(){
        
        if(!Yii::app()->user->checkAccess("Import Decisions")){
            throw new CHttpException(403,'You are not authorized to access this feature');
        }
        
        $model = new DecisionsUploadModel();
        
        if(isset($_POST['DecisionsUploadModel'])){
            $model->attributes = $_POST['DecisionsUploadModel'];
            $file = CUploadedFile::getInstance($model,'upload_file');
            if($model->validate()){
                $message = "Decisions uploaded successfully...<br />";
                $message.="File Name:$file->name<br />";
                $message.="Size:$file->size<br />";
                Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,$message);
                
                $filename = Yii::getPathOfAlias('webroot').'/uploads/'.$file->getName();
                spl_autoload_unregister(array('YiiBase','autoload'));
                $phpExcelPath = Yii::getPathOfAlias('application.vendor.phpoffice');
                include($phpExcelPath.DIRECTORY_SEPARATOR.'PHPExcel.php');
                
                if($file->saveAs($filename)){
                    
                    
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
                            if($headingColsCount < 9){
                                if(preg_match('/id/i', $cellContent)){
                                    $headingRow = $cell->getRow();
                                    $idCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/Decision Reference/i', $cellContent)){
                                    $decisionReferenceCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/Decision Date/i', $cellContent)){
                                    $decisionDateCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/Description/i', $cellContent)){
                                    $descriptionCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/BudgetaryImplications/i', $cellContent)){
                                    $budgetaryImplicationCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/TimeFrame/i', $cellContent)){
                                    $timeFrameCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/Performance Indicators/i', $cellContent)){
                                    $performanceIndicatorsCols = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/Responsibility Center/i', $cellContent)){
                                    $responsibilityCenterCols = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/MeetingNo/i', $cellContent)){
                                    $meetingNoCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                            }
                        }

                      }
                }
                
//                echo "<pre>";
                unset($data[$headingRow]);
//                print_r($data);
                
                spl_autoload_register(array('YiiBase','autoload'));
                
                foreach($data as $dataItem){
                    $decision = new EacDecision;
                    $decision->eams_central_id = $dataItem[$idCol];
                    $decision->decision_reference = $dataItem[$decisionReferenceCol];
                    $decision->decision_source_id = $model->decision_source;
                    $formattedDate = $this->excelDateToPhp($dataItem[$decisionDateCol]);
                    $decision->decision_date = $formattedDate;
                    $decision->description = $dataItem[$descriptionCol];
                    $decision->budgetary_implications = $dataItem[$budgetaryImplicationCol];
                    $decision->time_frame = $dataItem[$timeFrameCol];
                    $decision->performance_indicators = $dataItem[$performanceIndicatorsCols];
                    $decision->responsibility_center = $dataItem[$responsibilityCenterCols];
                    $decision->meeting_no = $dataItem[$meetingNoCol];
                    $decision->date_created = date('Y-m-d H:i:s');
                    $decision->create_user_id = Yii::app()->user->id;
                    
                    if($decision->decisionExists()){
                        continue;
                    }
                    if($decision->save()){
                        
                    }else{
                        print_r($decision->errors);
                    }
                }
            }
        }
        $this->render('import_decisions',array('model'=>$model));
    }
    
    public function actionImportCommonMarket(){
        
        $model = new CommonMarketUploadModel();
        
        if(isset($_POST['CommonMarketUploadModel'])){
            $model->attributes = $_POST['CommonMarketUploadModel'];
            $file = CUploadedFile::getInstance($model,'upload_file');
            if($model->validate()){
                $message = "Uploaded successfully...<br />";
                $message.="File Name:$file->name<br />";
                $message.="Size:$file->size<br />";
                Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,$message);
                
                $filename = Yii::getPathOfAlias('webroot').'/uploads/'.$file->getName();
                spl_autoload_unregister(array('YiiBase','autoload'));
                $phpExcelPath = Yii::getPathOfAlias('application.vendor.phpoffice');
                include($phpExcelPath.DIRECTORY_SEPARATOR.'PHPExcel.php');
                
                if($file->saveAs($filename)){
                    
                    
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
                            if($headingColsCount < 9){
                                if(preg_match('/Protocol_ID/i', $cellContent)){
                                    $headingRow = $cell->getRow();
                                    $protocolIdCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/Protocol_Details/i', $cellContent)){
                                    $protocolDetailsCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/Protocol_Provision_ID/i', $cellContent)){
                                    $protocolProvisionCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/Provision/i', $cellContent)){
                                    $protocolProvisionDescCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/data_field_code/i', $cellContent)){
                                    $dataFieldCodeCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/data_field_desc/i', $cellContent)){
                                    $dataFieldDescCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/Indicator_ID/i', $cellContent)){
                                    $indicatorIdCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/Indicator/i', $cellContent)){
                                    $indicatorDescCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                                if(preg_match('/Data Collection Guidelines/i', $cellContent)){
                                    $dataColGuidelinesCol = $cell->getColumn();
                                    $headingColsCount++;
                                }
                            }
                        }

                      }
                }
                
//                echo "<pre>";
                unset($data[$headingRow]);
//                print_r($data);
                
                spl_autoload_register(array('YiiBase','autoload'));
                
                foreach($data as $dataItem){
                    $fact = new EacFacts;
                    $fact->protocol_id = $dataItem[$protocolIdCol];
                    //$fact->protocol_details = $dataItem[$protocolDetailsCol];
                    $fact->protocol_provision_id = $dataItem[$protocolProvisionCol];
                    $fact->protocol_provision_description = $dataItem[$protocolProvisionDescCol];
                    //$fact->data_field_code = $dataItem[$dataFieldCodeCol];
                    $fact->data_field_desc = $dataItem[$dataFieldDescCol];
                    $fact->indicator_id = $dataItem[$indicatorIdCol];
                    $fact->indicator_description = $dataItem[$indicatorDescCol];
                    $fact->data_collection_guidelines = $dataItem[$dataColGuidelinesCol];
                    $fact->date_created = date('Y-m-d H:i:s');
                    $fact->create_user_id = Yii::app()->user->id;
                    $fact->date_updated = date('Y-m-d H:i:s');
                    $fact->update_user_id = Yii::app()->user->id;
                    if($fact->save()){
                        
                    }else{
                        echo "<pre>";
                        print_r($fact->errors);
                    }
                }
            }
        }
        
        $this->render('import_common_market',array('model'=>$model));
        
    }


    public function actionReceiveExternalData(){
        if(Yii::app()->request->isPostRequest){
          $files = $_FILES;
          $targetDir = Yii::getPathOfAlias('webroot').'/uploads/imports/';
          foreach ($files as $key=>$file) {
            $name = $file['name'];
            $tempName = $file['tmp_name'];
            $type = $file['type'];
            $error = $file['error'];
            $size = $file['size'];
            if($error == 0){
                $targetFile = $targetDir.basename($name);
                $fileFormat = pathinfo($targetFile,PATHINFO_EXTENSION);
                if(!file_exists($targetFile)){
                   move_uploaded_file($tempName, $targetFile);
                   $fileImportModel = new EamsFilesImport();
                   $fileImportModel->name = $name;
                   $fileImportModel->mime_type = $type;
                   $fileImportModel->file_extension = $fileFormat;
                   $fileImportModel->file_size = $size;
                   $fileImportModel->date_created = date('Y-m-d H:i:s');
                   $fileImportModel->save();
                }else{
                    echo "File already exists";
                }
            }  
            
          }

        }
    }
}

?>
