<?php

class Index_Model extends Model{

	function __construct(){
		parent::__construct();
	}

	/**
	*	Model method to upload image information into the images table
	*	@param file information - taken from the $_FILE super global
	*	@param user inputted text description
	*	@param auto generated thumbnail name
	*	@param location on server of image file
	*	@param array of x and y image dimenstions
	*	@return 1 if insert was successful
	*/
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

		//return 1 if insert was successful
		return $sth->rowCount();
	}
	
	/**
	*	Model method to select an image when passed in an image ID number
	*	@param Image id number
	*	@return the id, description, path, width and height of image from db
	*/
	public function selectImage($imageID = null){

		$sth = $this->db->prepare("SELECT id, description, path, width, height FROM images WHERE id = ? ");
		$values = array($imageID);

		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute($values);

		return $sth->fetchAll();
	}

	/**
	*	Model method to grab all images in the database
	*	@return array of all images
	*/
	public function selectAllImages(){

		$sth = $this->db->prepare("SELECT id, description, thumb FROM images ORDER BY id DESC");
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	*	Model method specific for the /index/api endpoint
	*	@return array of all images in the database along with all informaton
	*/ 
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