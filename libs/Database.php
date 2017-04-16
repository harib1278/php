<?php
class Database extends PDO{

	private $db_name = DB_NAME;
	private $db_user = DB_USER;
	private $db_pass = DB_PASS;
	private $db_host = DB_HOST;

	public function __construct(){
		parent::__construct("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
	}
}