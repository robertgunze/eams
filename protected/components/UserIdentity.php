<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    
    private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
                $user = User::model()->find('username=:username',array(':username'=>$this->username));
                if($user){
                    if($user->username !== $this->username)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
                    elseif($user->password!==$user->hashPassword($this->password))
                            $this->errorCode=self::ERROR_PASSWORD_INVALID;
                    else{
                            $this->errorCode=self::ERROR_NONE;
                            $this->_id= $user->id;
                            Yii::app()->user->setState('user_id',$user->id);
                            $loggedInUser = $user->first_name.' '.$user->middle_name.' '.$user->last_name;
                            Yii::app()->user->setState('loggedInUser',$loggedInUser);
                            if($user->is_mda){
                               Yii::app()->user->setState('is_mda',true);
                               Yii::app()->user->setState('mda_id',$user->mda_id);
                            }else{
                                Yii::app()->user->setState('is_mda',false);
                            }
                        }
                }
		
		return !$this->errorCode;
	}
        
        public function getId(){
            return $this->_id;
                    
        }
}