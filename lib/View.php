<?php

namespace Symfonette;

//
// Classe qui permet d'afficher les vues en allant les chercher dans le répertoire ./views/pages
// Permet également de faire appel à l'Authenticator dans les vues avec la variable $auth 
//

abstract class View {

    private const PAGES_PATH = "./views/pages/";
    private const LAYOUT_PATH = "./views/layout.php";

    public static function renderView(string $template, array $data = []) {
        // self fait appel à la classe courante
      $templatePath =  self::PAGES_PATH . $template;
      $data = $data;
      $auth = new Authenticator();
      require self::LAYOUT_PATH;
    }

}