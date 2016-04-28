<?php

/**
 * Description of DecisionsDeadlineNotificationCommand
 *
 * @author robert
 */
class DecisionsDeadlineNotificationCommand extends CConsoleCommand{
    //put your code here
    
    public function run($args){
        $this->triggerNotification();
    }
    
    public function triggerNotification(){
      $this->sendNotifications();
      echo "SUCCESSFUL";
    }

    public function sendNotifications(){
      foreach ($this->getMDAs() as $key => $mda) {
        $assignees = $this->getAssignees($mda->id);
        $recipients = $this->getAssigneesContacts($assignees);
        $decisions = $this->getDecisionsApproachingDeadlineByMda($mda->id);
        
        $subject = "EAMS-TANZANIA:Decisions Approaching Deadline";
        $title = $this->getTitleTemplate();
        $header = $this->getHeaderTemplate();
        $body = $this->getBodyTemplate($decisions);
        $footer = $this->getFooterTemplate();

        $message = $title.$header.$body.$footer;

        $this->notify($recipients,$subject,$message);

      }
    }

    public function  getTitleTemplate(){
        return "<h3>Decisions Approaching Deadline</h3>";
    }

    public function  getHeaderTemplate(){
      return "<table border='1' style='border-collapse: collapse;border: 1px solid #ddd;'>
          <tr style='background-color:#EB9A20'>
          <th style='border: 1px solid #ddd;'>Decision Reference #</th>
          <th style='border: 1px solid #ddd;'>Description</th>
          <th style='border: 1px solid #ddd;'>Due date</th>
          <th style='border: 1px solid #ddd;'>Status</th>
          </tr>";
    }

    public function getBodyTemplate($decisions){
      $body = "";
      if(NULL != $decisions)
        foreach ($decisions as $decision) {
            $body.= "
            <tr>
            <td style='border: 1px solid #ddd;'>{$decision->decision_reference}</td>
            <td style='border: 1px solid #ddd;'>{$decision->description}</td>
            <td style='border: 1px solid #ddd;'>{$decision->deadline}</td>
            <td style='border: 1px solid #ddd;'>{$decision->status->description}</td>
            </tr>
            ";
        }
      
      return $body;
    }

    public function getFooterTemplate(){
        return "</table>";
    }

    public function getMDAs(){
      return Mda::model()->findAll();
    }

    public function getAssignees($mda_id){
      $users = User::model()->find(
          'is_mda = :is_mda AND mda_id = :mda_id',
          [':is_mda'=>1,':mda_id'=>$mda_id]
        );

      return $users;
    }

    public function getAssigneesContacts($users){
      $recipients = array();
          if(NULL != $users)
           foreach ($users as $key => $user) {
            if(!empty($user->email)){
              array_push($recipients,$user->email);
            }
           }
           
           return $recipients;
    }

    public function getDecisionsApproachingDeadlineByMda($mda_id){
        
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id',EacDecision::model()->getDecisionIdsFromResponsibleMdaMappings($mda_id));
        $criteria->addInCondition("datediff(deadline,now())",[14,7,3]);
        $decisions =  EacDecision::model()->find($criteria);
        return $decisions;
    }

    public function notify($recipients,$subject, $message) {
          Yii::import('application.extensions.phpmailer.JPhpMailer');
          $mail = new JPhpMailer;
          $mail->IsSMTP();
          //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
          $mail->Host = Yii::app()->params['mailHost']; // using google smtp
          $mail->Port = 465; // or 587/465
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = "ssl";  //only gor gmail
          $mail->Username = Yii::app()->params['adminEmail']; //host login name or email
          $mail->Password = Yii::app()->params['hostPassword'];
          $mail->SetFrom('noreply@eams.go.tz',Yii::app()->name);
          $mail->Subject = $subject;
          //$mail->AltBody = $message;
          $mail->Body = $message;
          $mail->MsgHTML($message);
          foreach ($recipients as $recipient) {
            $mail->AddAddress($recipient);
          }
          return $mail->Send();
    }
    
    
}

?>
