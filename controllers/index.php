<?php
/* index page controller **/

class Index extends Controller{

	function __construct(){
		parent::__construct();

		
	}
	public function index(){
		//assigning a value to the view using the inbuilt object variable: msg
		$this->view->msg = '<h2>This is the homepage. Welcome!</h2>';

		//echo 'INDEX INDEX';
		$this->view->render('index/index');
		
	}

	public function upload(){

		$this->view->render('index/upload');
		
	}

	public function image_upload(){
		//move to constants
		$target_dir = "images/";
		
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
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}

		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		// Check for error flag before attempting upload
		if ($uploadOk == 0) {
			$this->view->msg = "Sorry, your file was not uploaded.";
		} else {
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
	*	Maintain aspect ratio formula: original height / original width x new width = new height
	*	@param path string for image file location on the server
	*	@return boolean value depending on success or failure of thumbnail save
	*/
	private function uploadThumbnail($target_file){

		//move to constants file
		$newWidth   = 250;
		$newHeight  = 250;
		$up_dir 	= "images/thumbs/";

		
		// Check if directory exists
		if (is_dir($up_dir) && is_writable($up_dir)) {

			$mime = getimagesize($target_file);

			if($mime['mime']=='image/png')  { $src_img = imagecreatefrompng($target_file);  }
			if($mime['mime']=='image/jpg')  { $src_img = imagecreatefromjpeg($target_file); }
			if($mime['mime']=='image/jpeg') { $src_img = imagecreatefromjpeg($target_file); }
			if($mime['mime']=='image/pjpeg'){ $src_img = imagecreatefromjpeg($target_file); }

			$old_x = imageSX($src_img);
			$old_y = imageSY($src_img);

			//preserve aspect ratio algo			
			if($old_x > $old_y) {

				$thumb_w = $newWidth;
				$thumb_h = $old_y / $old_x * $newWidth;

			}

			if($old_x < $old_y) {

				$thumb_w = $old_x / $old_y * $newHeight;
				$thumb_h = $newHeight;

			}

			if($old_x == $old_y) {

				$thumb_w = $newWidth;
				$thumb_h = $newHeight;

			}

			$dst_img 	 = ImageCreateTrueColor($thumb_w,$thumb_h);

			imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

			// New save location
			$new_thumb_loc = $up_dir . '/' . $this->uniqueFileName();

			if($mime['mime']=='image/png')  { $result = imagepng($dst_img,$new_thumb_loc,8);   }
			if($mime['mime']=='image/jpg')  { $result = imagejpeg($dst_img,$new_thumb_loc,80); }
			if($mime['mime']=='image/jpeg') { $result = imagejpeg($dst_img,$new_thumb_loc,80); }
			if($mime['mime']=='image/pjpeg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }

			//free the buffer
			imagedestroy($dst_img);
			imagedestroy($src_img);

		    return $result;
		}
		
		return false;
	}

	private function uniqueFileName() {	
		return date("YmdHis") . substr((string)microtime(), 1, 8) . ".jpg";
	}

	public function images(){		

		$this->view->msg = '<h2>All Images:</h2>';

		$this->view->render('index/images');
	}

	public function image($param = null){		

		if($param){
			$this->view->param = $param;
		}
		$this->view->msg = 'Image number: '. $param;

		$this->view->render('index/image');
	}

	public function api(){
		$this->model->xhrGetListings();
	}

	
}