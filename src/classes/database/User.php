<?php

require_once "Database.php";

class User extends Database {
	protected $table = "users";

	/**
	 * Inserts user record into database. Hashes the password
	 * @param array $data
	 * @return User 
	 */
	public function insert($data) 
	{
		$params = [];
		
		$sql = "INSERT INTO $this->table SET " ;
		foreach ($data as $key => $value) {
			$sql .= "$key = :$key, ";
			if ($key == 'password') {
				$value = password_hash($value, PASSWORD_DEFAULT);
			}
			$params[$key] = $value;
		}
		//removes last comma
		$sql = substr($sql, 0, -2);
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($params);
		return $this->read($this->conn->lastInsertId());
	}
	
	/**
	 * Get user record from database
	 * @param int $id
	 * @return User|null 
	 */
	public function read($id)
	{
		$sql = "SELECT * FROM $this->table WHERE id=$id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return $stmt->fetchObject();
		} else {
			return null;
		}
	}

	/**
	 * Updates user record in database
	 * @param int $id
	 * @return User 
	 */
	public function update($id)
	{
		$params = [];
		$sql = "UPDATE $this->table SET ";
		foreach ($data as $key => $value) {
			$sql = "$key = :$key";
			$params[$key] = $value;
		}
		$sql = substr($sql, 0, -2 );
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($params);
		return $this->read($id);
	}

	/**
	 * Get user record from database
	 * @param array $data
	 * @param string $property
	 * @return User|null 
	 */
	public function getBy($data, $property)
	{
		$sql = "SELECT * FROM $this->table WHERE $property='". $data[$property] ."'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return $stmt->fetchObject();
		}
		return null;
	}
}