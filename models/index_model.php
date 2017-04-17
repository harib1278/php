<?php

class Index_Model extends Model{

	function __construct(){
		parent::__construct();
	}

	public function uploadImage($file, $description, $thumbName, $target_file, $dimensions){

		//insert using prepared statement for security
		$sth = $this->db->prepare('INSERT INTO images (`title`, `description`, `filename`, `width`, `height`, `path`, `thumb`) VALUES (?,?,?,?,?,?,?)');

		//grab image params
		$values = array(
			preg_replace('/\\.[^.\\s]{3,4}$/', '', $file['fileToUpload']['name']), // trim the image extension from the end of the name
			htmlentities($description), // htmlentities to stop XSS
			$file['fileToUpload']['name'],
			$dimensions['x'],
			$dimensions['y'],
			$target_file,
			$thumbName
		);

		$sth->execute($values);

		//return if insert was successful
		return $sth->rowCount();
	}
	

	public function selectImage($imageID = null){

		$sth = $this->db->prepare("SELECT id, description, path, width, height FROM images WHERE id = ? ");
		$values = array($imageID);

		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute($values);

		return $sth->fetchAll();
	}

	public function selectAllImages(){

		$sth = $this->db->prepare("SELECT id, description, thumb FROM images ORDER BY id DESC");
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();

		return $sth->fetchAll();
	}

	public function getImageInfo($imageID = null){

		$sth = $this->db->prepare("SELECT * FROM images WHERE id = ? ORDER BY id DESC ");
		$values = array($imageID);

		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute($values);

		if($sth->rowCount() > 0){
			return $sth->fetchAll();
		} else {
			return 'Error: image ID not found.';
		}

				
	}

}