<?php

class Index_Model extends Model{

	function __construct(){
		parent::__construct();
	}

	public function uploadImage($file){

		//grab image params
		return 0;
		//now insert using prepared statement for security
		$sth = $this->db->prepare('INSERT INTO images (`text`) VALUES (?)');
		$values = array($_POST['text']);

		$sth->execute($values);

		//return if insert was successful
		return $sth->rowCount();
	}

	public function selectImage($imageID = null){

		$sth = $this->db->prepare("SELECT * FROM images WHERE id = ? ");
		$values = array($imageID);

		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute($values);

		return $data = $sth->fetchAll();
	}

	public function xhrGetListings(){

		$sth = $this->db->prepare('SELECT * FROM images');

		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();

		return $sth->fetchAll();		
	}

}