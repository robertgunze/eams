<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DecisionsUploadModel
 *
 * @author robert
 */
class DecisionsUploadModel extends CFormModel{
    //fields
    public $decision_source;
    public $upload_file;
    
    public function rules(){
        return array(
            array('decision_source','required'),
            array('upload_file','file','types'=>'xls,xlsx,csv'),
        );
    }
    
    public function attributeLabels(){
        return array(
            'decision_source'=>'Decision Source',
            'upload_file'=>'File'
        );
    }
}

?>
