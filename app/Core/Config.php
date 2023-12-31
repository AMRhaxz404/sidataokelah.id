<?php

class Config {
	private static $_instance = null;

	/* Database Configuration [ MySql ]
	*
	* This is configuration of your database connection
	* Please Complete this part
	*
	*/

	public function dbConfig(){
	    $this->host  = "localhost";
	    $this->db    = "u783402573_sidata";
	    $this->user  = "u783402573_okelah";
	    $this->pass  = "#i;X[YCw6";
	    return $this;
	}

 	/* Auth Configuration
 	*
 	* tableUser is the name of your table which become auth
 	* fieldId is the field which is Primary Key of tableUser
 	* id is the name of Session which is your declare when you are login,
 	* and id will become index of fieldId as well.
 	*
 	*/

	public function authConfig(){

		$this->tableUser = 'organizations';
		$this->fieldId   = 'id';
		$this->id        = (isset($_SESSION['id'])) ? $_SESSION['id'] : null;
		return $this;

	}


	// ------------------------------------------------------------- //
	

	/*
	* The Configuration has finished.
	*
	* If you need help you can call us.
	*
	* If you found some bugs you can report to us as well.
	*
	* Documentation :
	* https://mwiguna.github.io/delavix
	*
	* Github :
	* https//github.com/mwiguna/delavix
	*
	*
	* Delavix PHP Framework
	* Copyright (c) 2016 - 2018 Delavix
	* Author : M. Wiguna Saputra
	*
	*
	*/

	public static function getInstance(){
    	if(!isset(self::$_instance)) self::$_instance = new Config();
    	return self::$_instance;
 	}

}