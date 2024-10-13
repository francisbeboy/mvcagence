<?php

require_once './Autoload.php';

class PrincipalModel {

	private $db;

	public function __construct(){
		$this->db = Database::getInstance();
	}

	protected function add($table, $data){
// Récupérer les noms de colonnes à partir des clés du tableau $data
		$columns = implode(',', array_keys($data));

//créer une chaîne de caractères contenant des paramètres de requête nommés, séparés par une virgule et un espace.
		$params = ':'.implode(',:',array_keys($data));

// Construire la requête SQL INSERT
		$query = "INSERT INTO $table($columns) VALUES($params)";

// Obtenir une connexion à la base de données
		$dbConnection = $this->db->getConnection();

// Préparer la requête SQL
		$req = $dbConnection->prepare($query);

// Lier les valeurs aux paramètres de la requête SQL
		foreach($data as $key => &$value){
			$req->bindParam(":$key", $value);
		}

// Exécuter la requête SQL
		$req->execute();
		
// Vérifier si au moins une ligne a été affectée
		return $req->rowcount()>0;

	}

//Méthode pour récupérer toutes les annonces
	protected function getAll($table){
		// Requête SQL pour récupérer toutes les données d'une table quelconque
		$query = "SELECT * FROM $table ORDER BY id DESC";

  		// Connexion à la base de données
		$dbConnection = $this->db->getConnection();

		// Préparation de la requête
		$req = $dbConnection->prepare($query);

		// Exécution de la requête
		$req->execute();

		// Récupération du résultat sous forme de tableau associatif
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}


	// Méthode pour récupérer les données d'un élément (d'une annonce) à partir d'une table de la base de données
	protected function getById($table, $id) {
	    // Requête SQL pour récupérer l'élément par son identifiant
	    $query = "SELECT * FROM $table WHERE id = :id";

	    // Connexion à la base de données
	    $dbConnection = $this->db->getConnection();

	    // Préparation de la requête
	    $req = $dbConnection->prepare($query);

	    // Liaison du paramètre :id
	    $req->bindParam(':id', $id, PDO::PARAM_INT);

	    // Exécution de la requête
	    $req->execute();

	    // Récupération du résultat sous forme de tableau associatif
	    $result = $req->fetch(PDO::FETCH_ASSOC);

	    // Retourne le résultat
	    return $result;
	}

// Méthode pour mettre à jour des données dans la base de données

/**
 * Méthode pour mettre à jour les données d'un élément dans une table donnée.
 *
 * @param string $table Le nom de la table dans laquelle effectuer la mise à jour.
 * @param int $id L'identifiant de l'élément à mettre à jour.
 * @param array $data Les données à mettre à jour sous forme de tableau associatif.
 * @return bool True si la mise à jour est réussie, sinon False.
 */

	protected function update($table, $id, $data) {
	    // Initialiser une chaîne pour contenir les paires clé-valeur des colonnes à mettre à jour
	    $setClause = '';

	    // Boucler à travers les données et construire la chaîne de mise à jour
	    foreach ($data as $key => $value) {
	        // Ajouter chaque paire clé-valeur à la chaîne de mise à jour
	        $setClause .= "$key = :$key, ";
	    }

	    // Supprimer la virgule supplémentaire à la fin de la chaîne de mise à jour
	    $setClause = rtrim($setClause, ', ');

	    // Construire la requête SQL de mise à jour
	    $query = "UPDATE $table SET $setClause WHERE id = :id";

	    // Récupérer la connexion à la base de données
	    $dbConnection = $this->db->getConnection();

	    // Préparer la requête SQL
	    $req = $dbConnection->prepare($query);

	    // Lier les paramètres
	    $req->bindParam(':id', $id);
	    
	    foreach ($data as $key => &$value) {
	        $req->bindParam(":$key", $value);
	    }

	    // Exécuter la requête SQL
	    $result = $req->execute();

	    // Retourner le résultat de la mise à jour
	    return $result;
	}


// Méthode générique pour supprimer des données de la base de données
	protected function delete($table, $id){

		// Construction de la requête SQL DELETE
		$query = "DELETE FROM $table WHERE id = :id";

		// Récupération de la connexion à la base de données
		$dbConnection = $this->db->getConnection();

		// Préparation de la requête SQL
		$req = $dbConnection->prepare($query);

		// Liaison du paramètre :id
		$req->bindParam(':id', $id, PDO::PARAM_INT);

		// Exécution de la requête SQL
		$req->execute();

		// Retourner true si la suppression a réussi, sinon false
		return $req->rowCount() > 0;

	}


	protected function getRecent($table){

		// Requête SQL pour récupérer toutes les données d'une table quelconque
		$query = "SELECT * FROM $table ORDER BY id DESC LIMIT 10";

  		// Connexion à la base de données
		$dbConnection = $this->db->getConnection();

		// Préparation de la requête
		$req = $dbConnection->prepare($query);

		// Exécution de la requête
		$req->execute();

		// Récupération du résultat sous forme de tableau associatif
		return $req->fetchAll(PDO::FETCH_ASSOC);

	}


}