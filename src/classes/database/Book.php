<?php

require_once "User.php";

class Book extends User {
	protected $table = "books";
	protected $resultsPerPage = 10;

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


	public function readAll($page)
	{
		$pageFirstResult = ($page - 1) * $this->resultsPerPage; 
		$totalNumberPages = $this->getTotalNumberPages(); 
		$sql = "SELECT * FROM $this->table WHERE amount > 0 LIMIT " . $pageFirstResult . ", " . $totalNumberPages;
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return $stmt->fetchAll();
		}
		return null;
	}


	public function getTotalNumberPages()
	{
		$sql = "SELECT * FROM $this->table WHERE amount > 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$numberOfResult = $stmt->rowCount();
		return ceil($numberOfResult / $this->resultsPerPage);
	}

}