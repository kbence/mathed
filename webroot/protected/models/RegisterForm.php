<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CFormModel
{
	public $username;
	public $email;
	public $password;
	public $passwordRepeated;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, email, password, passwordRepeated', 'required'),
			array('email', 'email'),
			array('password, passwordRepeated', 'length', 'min' => 6),
			array('passwordRepeated', 'compare', 'compareAttribute' => 'password')
		);
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 *
	 * @return boolean whether login is successful
	 */
	public function register()
	{
		if (User::existsWithName($this->username)) {
			$this->addError('username', 'Username has already been taken!');
			return false;
		}

		$success = User::create($this->username, $this->email, $this->password);

		if (!$success) {
			$this->addError('username', 'Registration failed!');
			return false;
		}

		return true;
	}
}
