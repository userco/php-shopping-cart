<?php

require_once "User.php";

class Book extends User {
	protected $table = "books";

	public function decreaseAmount($id)
	{
		$amount = (!empty($this->read($id))) ? $this->read($id)->amount : 0;
		$params = [];
		if ($amount > 0)
		$sql = "UPDATE $this->table SET 
			amount = $amount - 1
			WHERE id = $id";
			$stmt = $this->conn->prepare($sql);
		$stmt->execute();
	}


	public function readAll()
	{
		$sql = "SELECT * FROM $this->table WHERE amount > 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return $stmt->fetchAll();
		} else {
			return null;
		}
	}
}