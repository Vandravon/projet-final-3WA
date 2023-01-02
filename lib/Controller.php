<?php

namespace Symfonette;

//
// Classe abstraite qui nous sert de base pour tous les controllers, qui sont les chef-d'orchestres du MVC
//

abstract class Controller {
    
    // Methode qui nous permet d'afficher les vues ainsi que de lui transmettre des informations
    // Elle est définie dans la classe View 
    // Protected parce qu'on ne va l'appeler qu'à l'intérieur des classes (enfants compris)

    protected function renderView(string $template, array $data = []): void {

        View::renderView($template, $data);
        // appelle la méthode renderView de la classe View; :: = la méthode qui appartient à cette classe
        // $data est un tableau optionnel
    }
    
    // Methode qui nous permet la redirection vers une autre page, avec des paramètres supplémentaires si besoin
	protected function redirectToRoute(string $name, array $params = []): void {
        Router::redirectToRoute($name, $params);
    }
    
}