<?php
//** this is the base controler - a parent of every other controller **/

class Controller {
	//private $view;
	
	function __construct(){
		//echo 'Main controller<br>';

		//the main controller has the view.
		$this->view = new View();

		
	}

	public function loadModel($name){

		$path = 'models/'.$name.'_model.php';

		if(file_exists($path)){
			require 'models/'.$name.'_model.php';
			$modelName = $name . '_Model';
			$this->model = new $modelName();
		}
	}
}