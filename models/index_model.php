<?php

class Index_Model extends Model{

	function __construct(){
		parent::__construct();
	}

	public function uploadImage($file){

		//grab image params

		//now insert
		$sth = $this->db->prepare('INSERT INTO data (`text`) VALUES (?)');
		$values = array($_POST['text']);

		$sth->execute($values);
		

		//$count = $sth->rowCount();
	}

	public function xhrGetListings($param = null){
		$sth = $this->db->prepare('SELECT * FROM data');
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();

		echo json_encode($data);
	}

}