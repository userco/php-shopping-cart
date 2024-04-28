<?php

require 'UserValidator.php';

class LoginValidator extends UserValidator {
	protected static $fields =  ['email', 'password'];


	/**
	 * Validates login user input
	 * @return array 
	 */
	public function validateForm()
	{
		foreach(self::$fields as $field) {
			if (!array_key_exists($field, $this->data)) {
				trigger_error($field . 'is not present in data');
				return;
			}
		}
		$this->validateEmail();
		$this->validatePassword();
		return $this->errors;
	}

	/**
	 * Validates password from user input
	 * @return void
	 */
	protected function validatePassword()
	{
		$val = trim($this->data['password']);
		if (empty($val)) {
			$this->addError('password', 'password cannot be empty');
		} else {
			if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $val)) {
				$this->addError('password', 'password should have minimum length 8 and contain at least: one lowercase letter, one uppercase letter and one digit');
			}
		}
	}
}
