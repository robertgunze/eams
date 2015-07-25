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
class CommonMarketUploadModel extends CFormModel{
    //fields
    public $upload_file;
    
    public function rules(){
        return array(
            array('upload_file','file','types'=>'xls,xlsx,csv'),
        );
    }
    
    public function attributeLabels(){
        return array(
            'upload_file'=>'File'
        );
    }
}

?>
