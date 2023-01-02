<?php

namespace Symfonette;

//
// Classe qui va servir de base à tous nos Managers, qui nous permettent les intéractions avec la base de donnée
//

abstract class Manager {

    // Cet attribut est un objet de la classe PDO; donc on ajoute devant \PDO 
    //  pour indiquer qu'on cherche dans ce namespace (Symfonette\PDO)
    protected \PDO $connection;

    public function __construct() {
        // On récupère la configuration de la BDD
        $dbConfig = require './config/database.php';
        $db = new \PDO(
            "mysql:host=" . $dbConfig['host'] . ";port=" . $dbConfig['port'] . ";dbname=" . $dbConfig['dbname'],
            $dbConfig['username'],
            $dbConfig['password']
        );
        // Ca affiche les erreurs quand on fait les requêtes SQL
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        // C'est le mode de récupération (sous forme de tableau associatif uniquement)
        $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        // Requête tirée par les cheveux qui permet d'utiliser Execute sans avoir à passer par la méthode bind
		$db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, FALSE);
        $db->exec('SET NAMES utf8');
        $this->connection = $db;
    }

}