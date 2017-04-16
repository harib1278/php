<?php

/** base model for all others **/

class Model{

	protected $db;

	function __construct(){
		$this->db = new Database();
	}
}