<?php

class Autoload {

    // Méthode pour enregistrer la fonction d'autochargement
    public static function register(){
        spl_autoload_register([__CLASS__,'load']);
    }

    // Méthode pour charger la classe spécifiée
    public static function load($className){

        // Répertoire de base où se trouvent les fichiers de classe
        $baseDir = __DIR__.'/';

        // Liste des répertoires où chercher les fichiers de classe
        $directories = [
            'controllers/',
            'models/',
            'views/',
            'core/',
            'core/db/',
            '/'
        ];

         // Parcourir tous les répertoires
        foreach ($directories as $directory) {

            // Chemin complet du fichier de classe
            $file =$baseDir . $directory .$className.'.php';

            // Vérifier si le fichier existe
            if(file_exists($file)){
                // Inclure le fichier de classe
                include $file;
                return;
            }
        }
    }
}

// Enregistrement de la fonction d'autochargement lors de l'inclusion du fichier Autoload.php
Autoload::register();

