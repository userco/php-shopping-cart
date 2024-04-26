<?php

require_once "Database.php";

class User extends Database {
	protected $table = "users";


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
		$sql = substr($sql, 0, -2);
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($params);
		return $this->read($this->conn->lastInsertId());
	}
	
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