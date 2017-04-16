<?php

class Dashboard_Model extends Model{
	function __construct(){
		parent::__construct();
	}

	public function xhrInsert(){
		$text =  $_POST['text'];

		$sth = $this->db->prepare('INSERT INTO data (`text`) VALUES (?)');
		$values = array($_POST['text']);

		$sth->execute($values);
		

		$data = array(
				'text' => $text,
				'id' => $this->db->lastInsertID()
			);
		
		//$data = $sth->fetchAll();
		echo json_encode($data);
		//$count = $sth->rowCount();
	}

	public function xhrGetListings(){
		$sth = $this->db->prepare('SELECT * FROM data');
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();

		echo json_encode($data);
	}

	public function xhrDeleteListing(){

		
		$sth = $this->db->prepare("DELETE FROM data WHERE id = ?");
		$values = array($_POST['id']);

		$sth->execute($values);
	}
}