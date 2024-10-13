<?php

class TestController{
	public function index(){
		
		$setClause = '';

		$data = [
			'titre'=>'Appartement 1',
			'description'=>"Du n'importe quoi",
			'image'=>'app1.jpg',
			'nombre_pieces'=> 5,
			'tarif_mensuel'=> 1300

		];

		foreach ($data as $key => $value){
			$setClause .= "$key = :$key, ";
		}

		$setClause = rtrim($setClause, ', ');


		echo $setClause;

	


	}
}