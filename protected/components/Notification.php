<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notification
 *
 * @author robert
 */
class Notification {
    //put your code here
    
    
    public static function sendEmail($senderDetails, $receiverDetails, $subject, $message) {
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
        $mail->SetFrom($senderDetails['email'], $senderDetails['name']);
        $mail->Subject = $subject;
        //$mail->AltBody = $message;
        $mail->Body = $message;
        $mail->MsgHTML($message);
        $mail->AddAddress($receiverDetails['email'], $receiverDetails['name']);
        return $mail->Send();
    }

    
    public static function sendSMS(){
        
    }
}

?>
