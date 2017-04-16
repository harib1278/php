<?php
/* index page controller **/

class Login extends Controller{

	function __construct(){
		parent::__construct();
		
	}

	public function index(){
		//$this->view->msg = 'This is the index, welcome!';


		$this->view->render('login/index');
		
	}

	public function run(){
		$this->model->run();
	}
}

?>