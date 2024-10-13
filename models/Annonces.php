<?php

require_once './Autoload.php';

class Annonces extends PrincipalModel{

	protected $table;

	public function __construct($table){
		parent::__construct();

 		// Initialisation de la propriété $table avec le nom de la table
		$this->table = $table;
	}

//Méthode pour enregistrer une annonce
	public function registerAnnonceBdd($data){
		return $this->add($this->table, $data);
	}

//Méthode pour récupérer toutes les annonces
	public function getAllAnnonces(){
		return $this->getAll($this->table);

	}

	// Méthode pour récupérer une annonce par son ID
	public function getAnnonceById($id){
		return $this->getById($this->table, $id);

	}

	// Méthode pour mettre à jour une annonce
	public function updateAnnonce($id,$data){

		return $this->update($this->table, $id, $data);
	}

	// Méthode pour supprimer une annonce
	public function deleteAnnonce($id){
		return $this->delete($this->table, $id);
	}

	// Méthode pour récupérer les annonces récentes
	public function getRecentAnnonces(){
		return $this->getRecent($this->table);
	}

}