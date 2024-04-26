<?php

class UserValidator {
	
	protected $data;
	protected $errors = [];
	protected static $fields = ['name', 'email', 'password'];

	public function __construct($postData)
	{
		$this->data = $postData;
	}

	public function validateForm()
	{
		foreach(self::$fields as $field) {
			if (!array_key_exists($field, $this->data)) {
				trigger_error($field . 'is not present in data');
				return;
			}
		}
		$this->validateName();
		$this->validateEmail();
		$this->validatePassword();
		return $this->errors;
	}

	protected function validateName() 
	{
		$val = trim($this->data['name']);
		if (empty($val)) {
			$this->addError('name', 'name cannot be empty');
		}
	}


	protected function validateEmail() 
	{
		$val = trim($this->data['email']);
		if (empty($val)) {
			$this->addError('email', 'email cannot be empty');
		} else {
			if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
				$this->addError('email', 'email is not valid');
			}
		}
	}


	protected function addError($key, $val) {
		$this->errors[$key] = $val;
	}


	protected function validatePassword()
	{
		$val = trim($this->data['password']);
		if (empty($val)) {
			$this->addError('password', 'password cannot be empty');
		} else if ($val !== trim($this->data['password_confirm'])) {
			$this->addError('password', 'passwords do not match');
		} else {
			if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $val)) {
				$this->addError('password', 'password should have minimum length 8 and contain at least: one lowercase letter, one uppercase letter and one digit');
			}
		}
	}

}