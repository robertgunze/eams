<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndicatorReportingCommand
 *
 * @author robert
 */
class IndicatorReportingCommand extends CConsoleCommand{
    //put your code here
    
    public function run($args){
//        echo $args[0]."\r\n";
        if(empty($args[0])){
            $args[0]= 'unknown command';
            echo $args[0]."\r\n";
            Yii::app()->end();
        }
        
        switch($args[0]){
            case Frequency::DAILY:
                $this->triggerNotification(Frequency::DAILY);
                    break;
            case Frequency::WEEKLY:
                $this->triggerNotification(Frequency::WEEKLY);
                    break;
            case Frequency::MONTHLY:
                $this->triggerNotification(Frequency::MONTHLY);
                    break;
            case Frequency::QUARTERLY:
                $this->triggerNotification(Frequency::QUARTERLY);
                    break;
            case Frequency::BI_ANNUALY:
                $this->triggerNotification(Frequency::BI_ANNUALY);
                    break;
            case Frequency::ANNUALLY:
                $this->triggerNotification(Frequency::ANNUALLY);
                    break;
                    default :
                        break;
        }
    }
    
    public function triggerNotification($frequency){
        
        $indicators = Indicator::model()->findAll();
        foreach($indicators as $indicator){
            if($indicator->indicatorFrequency){
                if($indicator->indicatorFrequency[0]->code == $frequency){
                   echo 'found one: '.'indicator ID: '.$indicator->indicatorFrequency[0]->code."\r\n";
                   foreach($indicator->indicatorFramework as $framework){
                       
                       $mapper = EamsFrameworkIndicatorMapping::model()->find(
                               'indicator_id=:i AND framework_id=:f',
                               array(
                                   ':i'=>$indicator->id,
                                   ':f'=>$framework->id
                               ));
                       //Initialize facts table: indicator value to be filled after notification has been sent
                       $fact = new EamsFacts();
                       $fact->framework_ind_id = $mapper->id;
                       $fact->time_id = TimeDimension::getTimeIdByDate(date('dmy'));
                       echo '<pre>';
                       print_r($fact);
                       print_r($mapper);
                       echo "\r\n";
                       if($fact->save()){
                           echo "Saved\r\n";
                       }
                   }
                   
                }
            }
        }
        
    }
    
    
}
?>
