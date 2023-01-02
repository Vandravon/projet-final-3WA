<?php

namespace Symfonette;

use App\Model\Manager\UserManager;
use App\Model\Entity\User;
use Symfonette\Controller;

//
// L'authenticator nous permet de gérer la session de l'utilisateur quand il est connecté
//

class Authenticator {

    // Permet de lancer la session de l'utilisateur dans le Router (methode Routing)
    //      Une fonction statique permet d'y accéder sans instancier la classe
    static public function startSession(): void {
        session_start();
    }

    // Permet de lier le user_id de la SESSION à l'id de l'utilisateur, lors de la connexion
    static public function login(int $id): void {
        // $_SESSION est une Superglobale! (comme $_GET ou $_POST)
        $_SESSION['user_id'] = $id;
    }
    
    // Permet de déconnecter l'utilisateur
    static public function logout(): void {
        $_SESSION['user_id'] = null;
        session_destroy();
    }

    // Permet de vérifier si l'utilisateur est connecté, pour authoriser l'affichage ou non d'une page
    public function isAuthenticated(): bool {
        // Fonction ternaire: s'il existe une varriable de session, on return True autrement on return false
        return isset($_SESSION['user_id']) ? true : false;
    }
    
    // Methode qui vérifie si l'utilisateur est connecté; si ça n'est pas le cas il est redirigé vers l'index
    static public function firewall(): void {
        if (!isset($_SESSION['user_id'])) {
            Router::redirectToRoute('app_index');
        }
    }

    // Permet de retourner un objet User contenant les information de l'utilisateur connecté
    public function getUser(): User {
        $userManager = new UserManager();
        return $userManager->find($_SESSION['user_id']);
    }

}