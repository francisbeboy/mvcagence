<?php

class Database {
	private static $instance;
	private $connexion;

	private function __construct($host, $username, $password, $database){
		try {
			$this->connexion = new PDO("mysql:host = $host; dbname=$database", $username, $password);
			$this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			die("Erreur de la connexion à la base de données: ".$e->getMessage());
		}
	}

	public static function getInstance(){

		require_once 'config.php';
		
		if(!self::$instance){
			self::$instance = new Database(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
		}
		return self::$instance;
	}


	public function getConnection(){
		return $this->connexion;
	}

}

























