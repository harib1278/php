	<?php

	class Error extends Controller{
		function __construct(){
			parent::__construct();
			//echo 'Error! Not found<br>';

			
		}

		public function index(){
			//assigning a value to the view using the inbuilt object variable: msg
			$this->view->msg = 'This page doesnt exist 404';
			$this->view->render('error/index');
			
		}
	}