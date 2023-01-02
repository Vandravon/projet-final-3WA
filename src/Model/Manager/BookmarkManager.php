<?php

namespace App\Model\Manager;

use Symfonette\Manager;
use App\Model\Entity\Bookmark;
use App\Model\Entity\User;
use App\Model\Entity\Category;

class BookmarkManager extends Manager {
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Trouve tous les favoris appartenant à un utilisateur
    // Model: UserManager
    // Vue: bookmark/index.php
    // Controller: BookmarkController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function findAllByUser($userId): array {
        $sql = 'SELECT 
        bookmarks.id, bookmarks.title, bookmarks.picture_url, bookmarks.url, bookmarks.created_at, bookmarks.user_id 
        FROM bookmarks WHERE bookmarks.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute([
	        'userId' => $userId
        ]);
        $bookmarks = $query->fetchAll();
        $bookmarksObjects = [];
        $categoryManager = new CategoryManager();
        $userManager = new UserManager();
	    foreach ($bookmarks as $bookmark) {
	        $bookmark['user'] = $userManager->find($bookmark['user_id']);
	        $bookmark['categories'] = $categoryManager->findAllByBookmark($bookmark['id']);
			array_push($bookmarksObjects, new Bookmark($bookmark));
		}
        return $bookmarksObjects;
    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de trouver un favori d'après son id, afin de l'éditer par la suite
    // Model: Bookmark, CategoryManager
    // Vue: bookmark/edit.php
    // Controller: BookmarkController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function find(int $id): ?Bookmark {
        $sql = 'SELECT 
        bookmarks.id, bookmarks.title, bookmarks.picture_url, bookmarks.url, bookmarks.user_id 
        FROM bookmarks WHERE bookmarks.id = :id';
        $query = $this->connection->prepare($sql);
        $query->execute([
	        'id' => $id
        ]);
        $bookmark = $query->fetch();
        if (!$bookmark || empty($bookmark)) {
            return null;
        }
        return new Bookmark($bookmark);
    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet d'ajouter un favori
    // Model: Bookmark
    // Vue: bookmark/add.php
    // Controller: BookmarkController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
        
    public function add(int $userId, Bookmark $bookmark): void {
        $sql = 'INSERT INTO bookmarks (title, picture_url, url, created_at, user_id)
                VALUES (:title, :picture_url, :url, :created_at, :user_id)';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'title' => $bookmark->getTitle(),
		    'picture_url' => $bookmark->getPictureUrl(),
			'url' => $bookmark->getUrl(),
			'created_at' => date_format(new \DateTime('NOW'), 'Y-m-d H:i:s'),
			'user_id' => $userId
		]);
    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de supprimer un favori
    // Model: /
    // Vue: bookmark/index.php
    // Controller: BookmarkController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function delete(int $id): void {
        $sql = "DELETE FROM bookmarks WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([
        'id' => $id
        ]);
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de nettoyer la table de liaison bookmarks_categories lors de suppression d'un favori
    // Model: /
    // Vue: bookmark/index.php
    // Controller: BookmarkController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function cleanJunctionTable(int $id): void {
        $sql = "DELETE FROM bookmarks_categories where bookmarks_id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([
        'id' => $id
        ]);
    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet d'éditer les favoris
    // Model: Bookmark
    // Vue: bookmark/edit.php
    // Controller: BookmarkController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function update(Bookmark $bookmark): void {
        $sql = 'UPDATE bookmarks SET title = :title, picture_url = :picture_url, url = :url WHERE id = :id';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $bookmark->getId(),
            'title' => $bookmark->getTitle(),
		    'picture_url' => $bookmark->getPictureUrl(),
			'url' => $bookmark->getUrl()
		]);
    }
      
}