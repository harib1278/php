<?php
class Database extends PDO{

	private $db_name = 'mvc';
	private $db_user = 'root';
	private $db_pass = '';
	private $db_host = 'localhost';

	public function __construct(){
		parent::__construct("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
	}
}