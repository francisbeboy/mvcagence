<?php

require "config.php";

class Router {

    public function routeRequest(){

// Récupérer l'URL de la requête, par défaut '/'
        $url = isset($_GET['url']) ? $_GET['url'] : '/';

// Diviser l'URL en parties en utilisant '/' comme séparateur
        $urlParts = explode('/', trim($url, '/'));

 // Construire le nom du contrôleur en fonction de la première partie de l'URL
        $controllerName = (!empty($urlParts[0])) ? ucfirst($urlParts[0]).'Controller' : 'HomeController';

// Déterminer l'action en fonction de la deuxième partie de l'URL, par défaut 'index'
        $action = (!empty($urlParts[1])) ? $urlParts[1] : 'index';

// Construire le chemin vers le fichier du contrôleur
        $controllerFile = 'controllers/'.$controllerName.'.php';

// Vérifier si le fichier du contrôleur existe
        if(file_exists($controllerFile)){

    // Inclure le fichier du contrôleur
            require_once($controllerFile);

    // Vérifier si la classe du contrôleur existe
            if(class_exists($controllerName)){

        // Instancier le contrôleur
                $controller = new $controllerName();

        // Vérifier si la méthode/action existe dans le contrôleur
                if(method_exists($controller, $action)){
                // Récupérer les paramètres de l'URL (à partir de la troisième partie)
                    $params = array_slice($urlParts, 2);

                    // Récupérer la réflexion (informations) de la méthode
                    $reflectionMethod = new ReflectionMethod($controller, $action);

                    // Récupérer les paramètres de la méthode
                    $methodParams = $reflectionMethod->getParameters();

                    // Vérifier si des paramètres sont nécessaires au fonctionnement de la méthode
                    if(count($methodParams) > 0){

                        // S'assurer que le nombre de paramètres fournis en URL est suffisant pour l'exécution de la méthode
                        if(count($params) >= count($methodParams)){

                            // Appeler la méthode/action du contrôleur avec les paramètres
                            call_user_func_array([$controller,$action], $params);


                        }else{

                            echo "Erreur 404 - Page non trouvée! - Paramètres passés en URL insuffisants";
                        }

                    }else{

                // Appeler la méthode/action du contrôleur sans spécifier de paramètres
                        $controller->$action();
                    }


                }else{
                    echo "Erreur 404 - Page non trouvée! - Méthode non trouvée";
                }

            }else{
                echo "Erreur 404 - Page non trouvée! - Classe non trouvée!";
            }

        }else{
            echo "Erreur 404 - Page non trouvée! - contrôleur non trouvé!";
        }


    }


}