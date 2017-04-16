	<?php

	class Dashboard extends Controller{
		function __construct(){
			parent::__construct();
			Session::init();
			$logged = Session::get('loggedIn');

			if($logged == false){
				Session::destroy();
				header('Location: ../login');
				exit;
			}
			//sending a localised js include to the dashboard view only,
			$this->view->js = array(
				'dashboard/js/default.js'
				);
		}

		public function index(){


			$this->view->render('dashboard/index');
			
		}


		public function logout(){
			Session::destroy();
			header('Location: ../login');
			exit;
		}

		public function xhrInsert(){
			$this->model->xhrInsert();
		}

		public function xhrGetListings(){
			$this->model->xhrGetListings();
		}

		public function xhrDeleteListing(){
			$this->model->xhrDeleteListing();
		}
	}