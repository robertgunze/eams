<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        public function excelDateToPhp($excelDate){
        	$excelDate = $excelDate - 25569; //offet to UNIX epoch
            $date = strtotime("+$excelDate days",mktime(0,0,0,1,1,1970));
            $formattedDate = date('Y-m-d',$date);
            return $formattedDate;
        }
        
        public function logAudit($action) {
            $model = new AuditTrail();
            if (Yii::app()->user->id) {
                $model->user_id = Yii::app()->user->id;
            }
            $model->details = $action;
            $model->activity_group = 1;
            $model->save();
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

        public function httpPost($url,$fields = NULL){
		$ch = curl_init($url);
			  curl_setopt($ch, CURLOPT_POST, true);
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			if(is_array($fields)){
			  curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
			}
			//$ch = curl_setopt($ch, CURLOPT_USERPWD, 'username:password');
			$result = curl_exec($ch);
			if ($result === FALSE) {
			   die(curl_error($ch));
			}

         		curl_close($ch);
			return $result;
        }
}
