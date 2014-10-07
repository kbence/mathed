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
		if($this->getUser($this->username, $this->password))
			$this->errorCode = self::ERROR_NONE;
		else
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;

		return !$this->errorCode;
	}

    protected function getUser($username, $password)
    {
        /** @var CDbConnection $db */
        $db = Yii::app()->db;

        $command = $db->createCommand('SELECT * FROM user WHERE name = :username AND ' .
                'password = MD5(:password)');
        $command->bindParam('username', $username);
        $command->bindParam('password', $password);

        return $command->queryRow();
    }
}