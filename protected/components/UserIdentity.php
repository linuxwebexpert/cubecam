<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
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

		/**
		 * Removing default yii framework authentication
		 *
		
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
		
		*/
		
		/**
		 * Inserting new adLDAP Active Directory authentication
		 */
		
		require_once('protected/vendors/adLDAP/adLDAP.php');
		
		$adldap = new adLDAP();
		
		$authUser = $adldap->authenticate($this->username, $this->password);
		if ($authUser == true) {
			$this->errorCode=self::ERROR_NONE;
		  	echo "User authenticated successfully";
		}
		else {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		  	echo "User authentication unsuccessful";
		}
		return !$this->errorCode;
	}
}