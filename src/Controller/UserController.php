<?php

namespace App\Controller;

use Symfonette\Controller;
use Symfonette\Authenticator;
use App\Model\Manager\UserManager;
use App\Model\Entity\User;

class UserController extends Controller {

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet l'inscription sur le site
    // Model: UserManager, User
    // Vue: user/signup.php
    // Controller: Authenticator
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function signup(): void {
        // On initie le tableau $error
        $errors = [];
        // On vérifie que la requête POST n'est pas vide
        if (!empty($_POST)) {
            // On vérifie que tous les champs sont bien remplis
            if (empty($_POST['email']) || empty($_POST['nickname']) || empty($_POST['password']) || 
                empty($_POST['confirm_password'])) {
                $errors[] = "Tous les champs doivent être saisis.";
            } else {
                // On vérifie 1 à 1 les champs, qu'ils respectent bien les critères
                
                // Vérifie que le pseudonyme fait minimum 4 caractères et au plus 255 caractères
                $nicknameLength = strlen($_POST['nickname']);
                if ($nicknameLength < 4 || $nicknameLength > 256) {
                    $errors[] = "Le pseudonyme doit faire au moins 4 caractères et être d'une taille raisonnable."; 
                }
                
                // Vérifie que mail n'est pas invalide; filter_var est une méthode magique de PHP
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Format de l'adresse email non valide.";
                }
                
                // Vérifie que le mail fait entre 5 et 255 caractères
                $emailLength = strlen($_POST['email']);
                if ($emailLength < 5 || $emailLength > 255) {
                    $errors[] = "L'adresse email est vraisemblablement fausse.";
                }
                // Vérifie que le mot de passe fait minimum 8 caractères
                if (strlen($_POST['password']) < 8) {
                    $errors[] = "Le mot de passe doit comporter au moins 8 caractères."; 
                }
                // Vérifie que les mots de passe correspondent
                if ($_POST['password'] !== $_POST['confirm_password']) {
                    $errors[] = "Les mots de passe saisis ne correspondent pas."; 
                }
            }
            // Ne se lance que si on n'a eu aucune erreur avant
            if (empty($errors)) {
                $userManager = new UserManager();
                // Vérifie si le pseudonyme et l'adresse mail n'existent pas déjà
                $nicknameAlreadyExists = $userManager->findByNickname(htmlspecialchars($_POST['nickname']));
                $mailAlreadyExists = $userManager->findByEmail(htmlspecialchars($_POST['email']));
                // Si la vérification a abouti, on empêche la création et on met un message d'erreur
                if ($nicknameAlreadyExists) {
                    $errors[] = "Ce pseudonyme existe déjà.";
                }
                elseif ($mailAlreadyExists) {
                    $errors[] = "Cette adresse email existe déjà.";
                } else {
                    // S'il n'y a pas d'erreur, on lance la création
                    $user = new User();
                    // On hydrate avec les set
                    $user->setNickname(htmlspecialchars($_POST['nickname']));
                    $user->setEmail(htmlspecialchars($_POST['email']));
                    // password_hash est une fonction de PHP
                    $passwordHash = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT);
                    $user->setPassword($passwordHash);
                    $userManager->add($user);
                    // On redirige vers la page de connexion
                    $this->redirectToRoute('app_user_login');
                }
            }
        }
        $this->renderView('user/signup.php', [
            'title' => 'Inscription',
            'errors' => $errors
        ]);
        
    }


    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de se connecter au site
    // Model: UserManager, User
    // Vue: user/login.php
    // Controller: Authenticator
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function login(): void {
        $errors = [];
        // Quand on arrive sur la page le $_POST n'existe pas, donc ça n'affiche pas les erreurs suivantes
        if (!empty($_POST)) {
            // On vérifie que le mail et le mot de passe ont été rentrés
            if (empty($_POST['email']) || empty($_POST['password'])) {
                $errors[] = "Tous les champs doivent être saisis.";
            } else {
                $userManager = new UserManager;
                // On utilise la méthode du manager pour récupérer le mail dans la base de donnée
                $user = $userManager->findByEmail($_POST['email']);
                if (!$user) {
                    // Si le mail rentré n'est pas dans la base de donnée on a une erreur
                    $errors[] = "Aucun compte n'est associé à cette adresse email.";
                } elseif (!password_verify($_POST['password'], $user->getPassword())) {
                    // Si le mot de passe rentré ne correspond pas à celui associé à l'email (findByEmail nous 
                    //  renvoie un objet $user contenant toutes les informations)
                    $errors[] = "Mauvais mot de passe.";
                }
            }
            if (empty($errors)) {
                // S'il n'y a pas d'erreur, on authentifie la personne et on redirige à l'index du site
                Authenticator::login($user->getId());
                $this->redirectToRoute('app_index');
            }
        }
        // De base on nous renvoie vers la page de connexion
        $this->renderView('user/login.php', [
            'title' => 'Connexion',
            'errors' => $errors
        ]);
    }


    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Déconnecte l'utilisateur
    // Model: /
    // Vue: _footer.php
    // Controller: Authenticator
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function logout(): void {
	    // On utilise la méthode logout dans l'Authenticator, qui est dans le répertoire lib
        Authenticator::logout();
        $this->redirectToRoute('app_index');
    }


    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet à l'utilisateur de modifier ses informations dans les paramètres
    // Model: UserManager, User
    // Vue: user/setting.php
    // Controller: Authenticator
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function setting(): void {
        $authenticator = new Authenticator;
        if ($authenticator->isAuthenticated()){
            $user = $authenticator->getUser();
            $errors = [];
            if (!empty($_POST)) {
                if (empty($_POST['nickname']) || empty($_POST['email']) || empty($_POST['password'])) {
                    $errors[] = "Tous les champs doivent être saisis.";
                } else {
                    // Vérifie que le pseudonyme fait minimum 4 caractères et au plus 255 caractères
                    $nicknameLength = strlen($_POST['nickname']);
                    if ($nicknameLength < 4 || $nicknameLength > 256) {
                        $errors[] = "Le pseudonyme doit faire entre 4 et 255 caractères."; 
                    }

                    // Vérifie que mail n'est pas invalide; filter_var est une méthode magique de PHP
                    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "Format de l'adresse email non valide.";
                    }

                    if (!password_verify($_POST['password'], $user->getPassword())) {
                    // Si le mot de passe rentré ne correspond pas à celui associé à l'email (findByEmail nous renvoie
                    //  un objet $user contenant toutes les informations)
                    $errors[] = "Mauvais mot de passe.";
                    }

                    // Vérifie que le champ n'est pas vide
                    if (!empty($_POST['newPassword'])) {
                        // Vérifie que le nouveau mot de passe fait minimum 8 caractères
                        if (strlen($_POST['newPassword']) < 8) {
                            $errors[] = "Le nouveau mot de passe doit comporter au moins 8 caractères."; 
                        }
                    }
                }

                if (empty($errors)) {
                    $userManager = new UserManager();
                    $userEntity = new User();
                    // On hydrate avec les set
                    $nicknameAlreadyExists = $userManager->findByNickname(htmlspecialchars($_POST['nickname']));
                    $mailAlreadyExists = $userManager->findByEmail(htmlspecialchars($_POST['email']));
                    if ($nicknameAlreadyExists && ($nicknameAlreadyExists->getNickname() != $user->getNickname())) {
                        $errors[] = "Ce pseudonyme existe déjà.";
                    }
                    elseif ($mailAlreadyExists && ($mailAlreadyExists->getEmail() != $user->getEmail())) {
                        $errors[] = "Cette adresse email existe déjà.";
                    } 
                    elseif (!empty($_POST['newPassword'])) {
                        // Cas où un nouveau mot de passe est défini
                        $userEntity->setId($user->getId());
                        $userEntity->setNickname(htmlspecialchars($_POST['nickname']));
                        $userEntity->setEmail(htmlspecialchars($_POST['email']));
                        $passwordHash = password_hash(htmlspecialchars($_POST['newPassword']), PASSWORD_BCRYPT);
                        $userEntity->setPassword($passwordHash);
                        $userManager->update($userEntity);
                        // On redirige vers la page index
                        $this->redirectToRoute('app_index');
                    } else {
                        // Cas où il n'y a pas de nouveau mot de passe
                        $userEntity->setId($user->getId());
                        $userEntity->setNickname(htmlspecialchars($_POST['nickname']));
                        $userEntity->setEmail(htmlspecialchars($_POST['email']));
                        $userEntity->setPassword($user->getPassword());
                        $userManager->update($userEntity);
                        // On redirige vers la page index
                        $this->redirectToRoute('app_index');
                    }
                }
            }
        } else {
            $this->redirectToRoute('app_index');
        }

        $this->renderView('user/setting.php', [
            'title' => 'Paramètres',
            'user' => $user,
            'errors' => $errors
        ]);
    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet d'accéder à l'interface administrateur; accessible uniquement aux administrateurs
    //              N'affiche que les personnes dont le rôle n'est pas Administrateur
    // Model: UserManager
    // Vue: user/administration.php
    // Controller: Authenticator
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function administration(): void {
        $authenticator = new Authenticator;
        // On vérifie que la personne est authentifiée
        if ($authenticator->isAuthenticated()){
            // On vérifie le rôle, si la personne est bien administrateur
            $role = $authenticator->getUser()->getRole();
            // Si la personne est bien administrateur
            if ($role === true) {
                $userManager = new UserManager;
                $users = $userManager->findAll();
                $contacts = $userManager->findAllContacts();
                $this->renderView('user/administration.php', [
                'title' => 'Liste des utilisateurs',
                'users' => $users,
                'contacts' => $contacts
                ]);
            } else {
                $this->redirectToRoute('app_index');
            }
        } else {
          $this->redirectToRoute('app_index');
        }
    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Page fantaisiste qui me permet de démontrer que je peux faire appel à des API en JS
    // Model: UserManager
    // Vue: user/boredAdmin.php
    // Controller: Authenticator
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function boredAdmin(): void {
        $authenticator = new Authenticator;
        if ($authenticator->isAuthenticated()){
            $role = $authenticator->getUser()->getRole();
            if ($role === true) {
                $this->renderView('user/boredAdmin.php', [
                'title' => 'Passer le temps'
                ]);
            } else {
                $this->redirectToRoute('app_index');
            }
        } else {
          $this->redirectToRoute('app_index');
        }
    }

    

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet la suppression des utilisateurs ainsi que de tous leurs contenus créés
    // Model: UserManager
    // Vue: user/administration.php
    // Controller: Authenticator
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function delete(): void {
        $authenticator = new Authenticator;
        // On reprend le même principe que pour la méthode administration() pour vérifier un administrateur
        if ($authenticator->isAuthenticated()){
            $role = $authenticator->getUser()->getRole();
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                if ($role === true) {
                    $userManager = new UserManager;
                    $userManager->delete($_GET['id']);
                    $this->redirectToRoute('app_user_administration');
                } else {
                    $this->redirectToRoute('app_index');
                }
            } else {
                $this->redirectToRoute('app_index');
            }
        } else {
            $this->redirectToRoute('app_index');
        }
    }
    
}