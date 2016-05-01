<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExportModel
 *
 * @author robert
 */
class ExportModel extends CFormModel{
    //fields
    public $export_type;
    
    public function rules(){
        return array(
            array('export_type','required'),
        );
    }
    
    public function attributeLabels(){
        return array(
            'export_type'=>'Export Type',
        );
    }

    public function getExportTypes(){
        return [
            'dc'=>'Council of Ministers',
            'exdc'=>'Extraordinary Council of Ministers',
            'su'=>'Summit',
            'exsu'=>'Extraordinary Summit',
            'sc'=>'Sectoral Council',
            'cm'=>'Common Market',
        ];
    }
}

?>
