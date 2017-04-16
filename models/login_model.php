<?php

class Login_Model extends Model{
	function __construct(){
		parent::__construct();
	}

	public function run(){

		//query() is a pdo method
		$sth = $this->db->prepare("SELECT id FROM users WHERE login = ? AND password = ?");
		$values = array($_POST['login'], md5($_POST['password']));
		$sth->execute($values);

		//$data = $sth->fetchAll();
		$count = $sth->rowCount();

		if ($count > 0){
			//login
			Session::init();
			Session::set('loggedIn',true);

			//if logged in correctly direct todashboard
			header('Location: ../dashboard');
		} else {
			//display eerror
			header('Location: ../login');
		}
	}

	
}