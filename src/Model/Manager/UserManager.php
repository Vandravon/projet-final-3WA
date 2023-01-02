<?php

namespace App\Model\Manager;

use Symfonette\Manager;
use App\Model\Entity\User;

class UserManager extends Manager {
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet d'ajouter un utilisateur avec la page d'inscription
    // Model: User
    // Vue: user/signup.php
    // Controller: UserManager
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function add(User $user): void {
        $sql = 'INSERT INTO users (nickname, email, password, created_at, role) 
                VALUES (:nickname, :email, :password, :created_at, :role)';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'nickname' => $user->getNickname(),
		    'email' => $user->getEmail(),
			'password' => $user->getPassword(),
			// Rappel, on met \DateTime parce qu'on fait appel à une classe de PHP
			'created_at' => date_format(new \DateTime('NOW'), 'Y-m-d H:i:s'),
            'role' => 0
		]);
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de trouver un utilisateur d'après son user.id
    // Model: User
    // Vue: Toutes les pages où l'utilisateur est connecté
    // Controller: Authenticator
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
	public function find(int $id): ?User {
        $sql = 'SELECT users.id, users.nickname, users.email, users.password, users.created_at, users.role 
                FROM users WHERE users.id = :id';
        $query = $this->connection->prepare($sql);
	    $query->execute([
            'id' => $id
		]);
        $user = $query->fetch();
        if (!$user || empty($user)) {
            return null;
		}
		return new User($user);
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de récupérer tous les utilisateurs dans l'interface admin
    // Model: User
    // Vue: user/administration.php
    // Controller: UserController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function findAll(): array {
        $sql = 'SELECT users.id, users.nickname, users.email
                FROM users WHERE users.role = 0';
        $query = $this->connection->query($sql);
        $users = $query->fetchAll();
        $userObjects = [];
        // On parcourt chaque ligne du tableau et on fait un objet pour chacune
	    foreach ($users as $user) {
			array_push($userObjects, new User($user));
		}
        return $userObjects;
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de trouver tous les formulaires de contact envoyés dans l'interface admin
    // Model: ContactManager, Contact
    // Vue: user/administration.php
    // Controller: UserController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function findAllContacts(): array {
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();
        return $contacts;
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de trouver un utilisateur d'après son pseudonyme
    // Model: User
    // Vue: user/signup.php
    // Controller: UserController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
	public function findByNickname(string $nickname): ?User {
        $sql = 'SELECT users.nickname 
                FROM users WHERE users.nickname = :nickname';
        $query = $this->connection->prepare($sql);
        $query->execute([
	        'nickname' => $nickname
        ]);
        $user = $query->fetch();
        if (!$user || empty($user)) {
            return null;
        }
        return new User($user);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de trouver un utilisateur d'après son Email
    // Model: User
    // Vue: user/signup.php
    // Controller: UserController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function findByEmail(string $email): ?User {
        $sql = 'SELECT users.id, users.email, users.password 
                FROM users WHERE users.email = :email';
        $query = $this->connection->prepare($sql);
        $query->execute([
	        'email' => $email
        ]);
        $user = $query->fetch();
        if (!$user || empty($user)) {
            return null;
        }
        return new User($user);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de supprimer un utilisateur et ce qu'il a créé, dans l'interface admin
    // Model: BookmarkManager
    // Vue: user/administration.php
    // Controller: UserController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function delete(int $id): void {
        
        $bookmarkManager = new BookmarkManager();
        $bookmarks = $bookmarkManager->findAllByUser($id);
        
        foreach($bookmarks as $bookmark) {
            $bookmarkManager->cleanJunctionTable($bookmark->getId());
            $bookmarkManager->delete($bookmark->getId());
        }
        $sql = "DELETE FROM users WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([
        'id' => $id
        ]);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet à un utilisateur de modifier ses paramètres
    // Model: User
    // Vue: user/setting.php
    // Controller: UserController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function update(User $userEntity): void {
        $sql = 'UPDATE users SET nickname = :nickname, email = :email, password = :password WHERE id = :id';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $userEntity->getId(),
            'nickname' => $userEntity->getNickname(),
		    'email' => $userEntity->getEmail(),
            'password' => $userEntity->getPassword()
		]);
    }
    
}