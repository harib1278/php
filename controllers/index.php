<?php
/* index page controller **/
class Index extends Controller{

	function __construct(){
		parent::__construct();		
	}

	/*
	*	Controller method to render the / index page
	*/
	public function index(){
		//assigning a value to the view using the inbuilt object variable: msg
		$this->view->msg = '<h2>This is the homepage. Welcome!</h2>';

		$this->view->render('index/index');		
	}

	/*
	*	Controller method to render the /upload page
	*/
	public function upload(){
		$this->view->render('index/upload');		
	}

	/*
	*	Controller method to process the image upload form and initiate thumbnail generation and save info to DB
	*/
	public function image_upload(){
		//move to constants
		$target_dir = TARGET_DIRECTORY;

		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			$this->view->msg = "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > FILE_SIZE_LIMIT) {
			$this->view->msg = "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			$this->view->msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		// Check for error flag before attempting upload
		if ($uploadOk != 0) {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

				//generate thumbnail and save into /thumb folder
				$this->uploadThumbnail($target_file);

				//save the image info to the database
				$this->model->uploadImage($_FILES);

				$this->view->msg = " The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				$this->view->msg = "Sorry, there was an error uploading your file.";
			}
		}
		
		$this->view->render('index/upload');
	}

	/**
	*	Private Method to generate thumbnail and upload it whilst maintaining the aspect ratio.
	*	Formula: original height / original width * new width = new height
	*	@param path string for image file location on the server
	*	@return boolean value depending on success or failure of thumbnail save
	*/
	private function uploadThumbnail($target_file){
		
		//Check if directory exists
		if (is_dir(THUMB_DIRECTORY) && is_writable(THUMB_DIRECTORY)) {

			$mime = getimagesize($target_file);

			if($mime['mime']=='image/png')  { $src_img = imagecreatefrompng($target_file);  }
			if($mime['mime']=='image/jpg')  { $src_img = imagecreatefromjpeg($target_file); }
			if($mime['mime']=='image/jpeg') { $src_img = imagecreatefromjpeg($target_file); }
			if($mime['mime']=='image/pjpeg'){ $src_img = imagecreatefromjpeg($target_file); }

			$old_x = imageSX($src_img);
			$old_y = imageSY($src_img);

			//Preserve aspect ratio algo			
			if($old_x > $old_y) {

				$thumb_w = THUMB_WIDTH;
				$thumb_h = $old_y / $old_x * THUMB_WIDTH;

			}

			if($old_x < $old_y) {

				$thumb_w = $old_x / $old_y * THUMB_HEIGHT;
				$thumb_h = THUMB_HEIGHT;

			}

			if($old_x == $old_y) {

				$thumb_w = THUMB_WIDTH;
				$thumb_h = THUMB_HEIGHT;

			}

			$dst_img 	 = ImageCreateTrueColor($thumb_w,$thumb_h);

			imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

			//New save location
			$new_thumb_loc = THUMB_DIRECTORY . '/' . $this->uniqueFileName();

			if($mime['mime']=='image/png')  { $result = imagepng($dst_img,$new_thumb_loc,8);   }
			if($mime['mime']=='image/jpg')  { $result = imagejpeg($dst_img,$new_thumb_loc,80); }
			if($mime['mime']=='image/jpeg') { $result = imagejpeg($dst_img,$new_thumb_loc,80); }
			if($mime['mime']=='image/pjpeg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }

			//Free the buffer
			imagedestroy($dst_img);
			imagedestroy($src_img);

			return $result;
		}
		
		return false;
	}

	/**
	*	Private Method to generate a unique filename string
	*	@return string
	*/
	private function uniqueFileName(){	
		return date("YmdHis") . substr((string)microtime(), 1, 8) . ".jpg";
	}

	/*
	*	Controller method to render the /images page and load all image thumbnails
	*/
	public function images(){		

		$this->view->msg = '<h2>All Images:</h2>';

		$this->view->render('index/images');
	}

	/**
	*	Controller method to render a single image
	*	@param image ID number
	*/
	public function image($param = null){		

		if($param){
			$this->view->param = $param;
		}

		$this->view->msg = 'Image number: '. $param;
		$this->view->img = $this->model->selectImage($param);

		$this->view->render('index/image');
	}

	/**
	*	Controller method to render the image info as JSON
	*/
	public function api(){
		$this->model->xhrGetListings();
	}

}