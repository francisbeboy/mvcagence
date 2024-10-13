
<?php

require_once './Autoload.php';

class HomeController {

    public function index(){
       $annonces = new AnnonceController();
       $annonces->getAllAnnonces();
      
    }
}