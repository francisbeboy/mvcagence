<?php

class AnnonceController {
    
    public function index(){
        
        $this->getAllAnnonces();
    }

    public function addAnnonce(){

        include('views/annonces/addAnnonce.php');
    }

     public function registerAnnonce(){
        // Vérifier si le formulaire a été soumis
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(empty($_POST['titre'])){
                $message = "Veuillez saisir un titre à votre annonce!";

            }elseif (empty($_POST['description'])) {
                $message = "Veuillez saisir une description à votre annonce!";

            }elseif(empty($_POST['nombre_pieces']) || $_POST['nombre_pieces'] <=0 || intval($_POST['nombre_pieces']) != $_POST['nombre_pieces']){

                $message = "Veuillez saisir un nombre de pièces valide!";

            }elseif (empty($_POST['tarif_mensuel']) || !is_numeric($_POST['tarif_mensuel']) || $_POST['tarif_mensuel'] <=0) {
                $message = "Veuillez saisir un tarif mensuel valide!";

            }elseif(!isset($_FILES['image']) || !preg_match("#jpeg|jpg|png#", $_FILES['image']['type'])){
                $message = "Veuillez choisir une image de type jpg, png ou jpeg!";
            }else{

                // Récupérer les données du formulaire
                $data = [
                    'titre' => $_POST['titre'],
                    'description' => $_POST['description'],
                    'nombre_pieces' => $_POST['nombre_pieces'],
                    'tarif_mensuel' => $_POST['tarif_mensuel']
                ];

                // Construction du nom du fichier image
                $dateHeure = date("Y-m-d-H-i-s");
                $image = $dateHeure."_".$_FILES['image']['name'];
                $path = "public/img/";

                // Déplacement du fichier image vers le répertoire approprié
                move_uploaded_file($_FILES['image']['tmp_name'], $path.$image);

                // Ajouter le nom de l'image dans le tableau de données
                $data['image'] = $image;

                // Instancier le modèle Annonces avec le nom de la table 'annonces'
                $annonceModel = new Annonces('annonces');

                // Appeler la méthode pour enregistrer l'annonce dans la base de données
                $result = $annonceModel->registerAnnonceBdd($data);


            if($result){

                // Redirection vers la page d'accueil
                header("Location:/mvcagency");
            }else{
                // Afficher un message d'erreur en cas d'échec de l'enregistrement
                $message = "Une erreur s'est produite lors de l'enregistrement de l'annonce!";
            }

            }
          
        }else{
            require_once  './views/annonces/addAnnonce.php';
        }

        require_once  './views/annonces/addAnnonce.php';

       
    }


    public  function getAllAnnonces()
    {
        // Instanciation de la classe Annonces avec le nom de la table 'annonces'
        $annonceModel = new Annonces('annonces');

        // Récupération de toutes les annonces depuis la base de données

        $annonces = $annonceModel->getAllAnnonces();

        // Vérification si des annonces ont été récupérées
        if($annonces){

            // Affichage de la vue des annonces si des annonces sont trouvées
            require_once './views/annonces/annonces.php';

        }else{
            // Message à afficher s'il n'y a aucune annonce trouvée
            $message = "Aucune annonce trouvée!";

            // Affichage de la vue des annonces avec le message
            require_once './views/annonces/annonces.php';
        }
    }


    public function getAnnonceById($id){

// Instanciation de la classe Annonces avec le nom de la table 'annonces'
        $annonceModel = new Annonces('annonces');

        // Récupération de l'annonce par son identifiant depuis la base de données
        $annonce = $annonceModel->getAnnonceById($id);

        // Vérification si une annonce a été récupérée
        if($annonce){

            // Affichage de la vue de l'annonce si une annonce est trouvée      
            require_once './views/annonces/annonce.php';

        }else{
            // Message à afficher s'il n'y a aucune annonce trouvée pour l'identifiant spécifié
            $message = "Aucune annonce trouvée pour l'identifiant $id.";

            // Affichage de la vue de l'annonce avec le message
            require_once './views/annonces/annonce.php';
        }
    }


    public function updateAnnonce($id){

        // Vérifier si le formulaire a été soumis
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(empty($_POST['titre'])){
                $message = "Veuillez saisir un titre à votre annonce!";

            }elseif (empty($_POST['description'])) {
                $message = "Veuillez saisir une description à votre annonce!";

            }elseif(empty($_POST['nombre_pieces']) || $_POST['nombre_pieces'] <=0 || intval($_POST['nombre_pieces']) != $_POST['nombre_pieces']){

                $message = "Veuillez saisir un nombre de pièces valide!";

            }elseif (empty($_POST['tarif_mensuel']) || !is_numeric($_POST['tarif_mensuel']) || $_POST['tarif_mensuel'] <=0) {
                $message = "Veuillez saisir un tarif mensuel valide!";

            }elseif(!isset($_FILES['image']) || !preg_match("#jpeg|jpg|png#", $_FILES['image']['type'])){
                $message = "Veuillez choisir une image de type jpg, png ou jpeg!";
            }else{

                // Récupérer les données du formulaire dans un tableau
                $data = [
                    'titre' => $_POST['titre'],
                    'description' => $_POST['description'],
                    'nombre_pieces' => $_POST['nombre_pieces'],
                    'tarif_mensuel' => $_POST['tarif_mensuel']
                ];

                // Construction du nom du fichier image
                $dateHeure = date("Y-m-d-H-i-s");
                $image = $dateHeure."_".$_FILES['image']['name'];
                $path = "public/img/";

                // Déplacement du fichier image vers le répertoire approprié
                move_uploaded_file($_FILES['image']['tmp_name'], $path.$image);

                // Ajouter le nom de l'image dans le tableau de données
                $data['image'] = $image;

                // Instancier le modèle Annonces avec le nom de la table 'annonces'
                $annonceModel = new Annonces('annonces');

                // Appeler la méthode pour enregistrer l'annonce dans la base de données
                $result = $annonceModel->updateAnnonce($id, $data);


            if($result){

                // Redirection vers la page d'accueil
                header("Location:/mvcagency");
                exit();
            }else{
                // Afficher un message d'erreur en cas d'échec de l'enregistrement
                $message = "Une erreur s'est produite lors de la mise à jour de l'annonce!";
            }

            }
          
        }else{
            // Instanciation de la classe Annonces avec le nom de la table 'annonces'
            $annonceModel = new Annonces('annonces');

            // Récupération de l'annonce par son identifiant depuis la base de données
            $annonce = $annonceModel->getAnnonceById($id);

            // Récupération des données de l'annonce
            $id = $annonce['id'];
            $titre = $annonce['titre'];
            $description = $annonce['description'];
            $nombre_pieces = $annonce['nombre_pieces'];
            $tarif_mensuel = $annonce['tarif_mensuel'];
            $image = $annonce['image'];

            // Inclure le fichier de vue pour afficher le formulaire de mise à jour
            require_once './views/annonces/updateAnnonce.php';

        }


    }


    public function deleteAnnonce($id){

        $annonceModel = new Annonces('annonces');
        $result = $annonceModel->deleteAnnonce($id);

        if($result){
             // Redirection vers la page d'accueil
                header("Location:/mvcagency");
                exit();
        }else{
            $message = "Une erreur s'est produite lors de la suppression de l'annonce!";
        }
    }


    public function getRecentAnnonces(){

         $annonceModel = new Annonces('annonces');

        $annonces = $annonceModel->getRecentAnnonces();

        if($annonces){

            require_once './views/annonces/annonces.php';

        }else{

            $message = "Aucune annonce trouvée!";

            require_once './views/annonces/annonces.php';
        }
    }



}