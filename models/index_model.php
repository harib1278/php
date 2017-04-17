<?php

class Index_Model extends Model{

	function __construct(){
		parent::__construct();
	}

	public function uploadImage($file, $thumbName, $target_file, $dimensions){

		

		echo '<pre>';
		var_dump($file);
		var_dump($thumbName);
		var_dump($target_file);
		var_dump($dimensions);
		echo '</pre>';


		//grab image params
		//id, title , description, filename, width, height, path, thumb_path
		//return 0;
		//now insert using prepared statement for security
		$sth = $this->db->prepare('INSERT INTO images (`title`, `description`, `filename`, `width`, `height`, `path`, `thumb`) VALUES (?,?,?,?,?,?,?)');
		$values = array(
			preg_replace('/\\.[^.\\s]{3,4}$/', '', $file['fileToUpload']['name']), // trim the image extension from the end of the name
			$file['fileToUpload']['type'],
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

		$sth = $this->db->prepare("SELECT * FROM images WHERE id = ? ");
		$values = array($imageID);

		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute($values);

		return $data = $sth->fetchAll();
	}

	public function getListings(){

		$sth = $this->db->prepare('SELECT * FROM images');

		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();

		return $sth->fetchAll();		
	}

}