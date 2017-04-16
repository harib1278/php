<?php

class Bootstrap {

	function __construct(){
		$url = isset($_GET['url']) ? $_GET['url'] : null;

		$url = rtrim($url, '/'); 
		
		$url = explode('/', $url);

		//if there is no trailing directory in url handle in the correct way
		if (empty($url[0])){
			require CONTROLLERS_PATH.'/'.INDEX_PATH.'.php';
			$controller = new Index();
			$controller->index();
			//returning false on this condition will stop the rest of the consteructor from being loaded.
			return false;
		}

		//check file exists
		//first argument will always be the controller hence url[0]

		$file = CONTROLLERS_PATH.'/' . $url[0] . '.php';
		if(file_exists($file)){
			require $file;
		} else {
			require CONTROLLERS_PATH.'/'.ERROR_PATH. '.php';
			$controller = new Error();
			$controller->index();
			//returning false on this condition will stop the rest of the consteructor from being loaded.
			return false;
		}
		
		$controller = new $url[0];
		$controller->loadModel($url[0]);

		//to pass url parameter as method parameter check for url[2]
		if (isset($url[2])){
			if(method_exists($controller, $url[1])){
				//dynamic function name call
				$controller->{$url[1]}($url[2]);
			} else {
				$this->error();
			}

			
		} else {
			if (isset($url[1])){
				if(method_exists($controller, $url[1])){
					$controller->{$url[1]}();
				} else {
					$this->error();
				}
				
			} else {
				$controller->index();
			}
		}

		
	}

	private function error(){
		require CONTROLLERS_PATH.'/'.ERROR_PATH. '.php';
		$controller = new Error();
		$controller->index();
		return false;
	}
}