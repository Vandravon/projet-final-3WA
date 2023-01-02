<?php

namespace Symfonette;

//
// Classe qui nous permet de faire le lien entre les url et les methodes qui y sont associées
// Permet également la redirection
//

class Router {
    
    private $routes;
    
    public function __construct() {
        // c'est la raison pour laquelle on a fait un return dans le fichier config
        $this->routes = require_once './config/routes.php';
        // la méthode routing est définie dessous
        $this->routing();
    }
    
    //
    // Methode qui nous permet d'aller chercher précisément une methode d'un controller, d'après
    //  le fichier ./config/routes.php
    //
    
    public function routing(): void {
        //On vérifie que la route appelée est bien une clé du tableau dans routes.php (app_index, app_add, ...)
        $availableRouteNames = array_keys($this->routes);

        // si $_GET['page'] existe et qu'il est dans le tableau
        if (isset($_GET['page']) && in_array($_GET['page'], $availableRouteNames, true)) {
            $route = $this->routes[$_GET['page']];
            
            if (
                !isset($route['controller'])
                || !isset($route['method'])
                // class_exist est une fonction de PHP, elle vérifie si une classe... existe bien
                || !class_exists($route['controller'])
                || !method_exists($route['controller'], $route['method'])
            ) {
                // Redirige vers l'index
                header("Location: index.php?page=app_index");
                }
            } else {
                // Redirige vers l'index
                header("Location: index.php?page=app_index");
            }
            
        // On aurait pu faire un $authenticator = new Authenticator puis $authenticator->startSession()
        // mais ça n'a pas d'intérêt de faire une nouvelle instance, on n'a pas de données à ajouter
        // C'est pourquoi nous utilisons une fonction statique
        Authenticator::startSession();

        // Si on n'a pas été redirigé, on instancie un controlleur
        $controller = new $route['controller'];
        // Permet d'appeler la méthode, la syntaxe est particulière!!
        $controller->{$route['method']}();
    }

    //
    // Méthode qui nous permet de faire une redirection, avec éventuellement des paramètres que l'on fait passer
    // Utilisée par Controller.php
    //

    // Méthode statique = ne peut être appelée que par une classe
    public static function redirectToRoute(string $name, array $params = []): void {
        // $_SERVER['SCRIPT_NAME'] = fait appel au chemin complet et au nom du fichier
        // et on rajoute la route vers laquelle on redirige
        $uri = $_SERVER['SCRIPT_NAME'] . "?page=" . $name;

        if (!empty($params)) {
            //On parcourt le tableau $param et on applique la fonction
            
            array_walk($params, function(&$val, $key) {
                $val = urlencode((string) $key) . '=' . urlencode((string) $val);
            });
            // Permet de faire passer plusieurs paramètres GET et de les ajouter à l'url avec &
            $uri .= '&' . implode('&', $params);
        }
        // On fait la redirection avec header
        header("Location: " . $uri);
        die;
    }
}