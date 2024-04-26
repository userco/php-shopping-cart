<?php

require_once __DIR__ . '/../../../config/database.php';


class Database {
	protected $host = DB_HOST;
	protected $db = DB_NAME;
	protected $user = DB_USER;
	protected $pass = DB_PASSWORD;

	protected $conn;

	function __construct() {
		try {
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$conn = null;
			echo "Connection";
		}
	}
}