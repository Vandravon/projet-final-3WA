<?php

namespace App\Model\Manager;

use Symfonette\Manager;
use App\Model\Entity\Category;

class CategoryManager extends Manager {

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de récupérer tous les tags d'un favori d'après l'id du favori
    // Model: CategoryManager, BookmarkManager
    // Vue: bookmark/index.php, bookmark/editTag.php
    // Controller: CategoryController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function findAllByBookmark(int $bookmarkId): array {
        $sql = 'SELECT 
        bookmarks.id, bookmarks.title, bookmarks.picture_url, bookmarks.url, bookmarks.created_at, bookmarks.user_id,
        bookmarks_categories.bookmarks_id, bookmarks_categories.categories_id,
        categories.id, categories.name
        FROM bookmarks
        INNER JOIN bookmarks_categories ON bookmarks_categories.bookmarks_id = bookmarks.id
        INNER JOIN categories ON bookmarks_categories.categories_id = categories.id
        WHERE bookmarks.id = :bookmarkId'; 
        $query = $this->connection->prepare($sql);
	    $query->execute([
            'bookmarkId' => $bookmarkId
		]);
        $categories = $query->fetchAll();
        $categoriesObjects = [];
        $bookmarkManager = new BookmarkManager();
	    foreach ($categories as $category) {
	        $category['bookmark'] = $bookmarkManager->find($bookmarkId);
			array_push($categoriesObjects, new Category($category));
		}
        return $categoriesObjects;
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de récupérer tous les tags, afin de les lister dans la vue editTag.php
    // Model: Category
    // Vue: bookmark/editTag.php
    // Controller: CategoryController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function findAll(): array {
        $sql = 'SELECT categories.id, categories.name FROM categories';
        $query = $this->connection->query($sql);
        $categories = $query->fetchAll();
        $userObjects = [];
        // On parcourt chaque ligne du tableau et on fait un objet pour chacune
	    foreach ($categories as $category) {
			array_push($userObjects, new Category($category));
		}
        return $userObjects;
    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet d'ajouter les informations dans la table de liaison bookmarks_categories quand on
    //              modifie les tags d'un favori
    // Model: /
    // Vue: /
    // Controller: CategoryController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function addJunctionBookmarkCategory(int $bookmarkId, int $nameId): void {
        $sql = 'INSERT INTO bookmarks_categories (bookmarks_id, categories_id) VALUES (:bookmarks_id, :categories_id)';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'bookmarks_id' => $bookmarkId,
		    'categories_id' => $nameId
		]);
    }

    
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de supprimer les informations de la table de jonction bookmarks_categories quand on
    //              les modifie
    // Model: /
    // Vue: /
    // Controller: CategoryController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function deleteJunctionBookmarkCategory(int $bookmarkId, int $nameId): void {
        $sql = "DELETE FROM bookmarks_categories WHERE bookmarks_id = :bookmarkId AND categories_id = :nameId";
        $query = $this->connection->prepare($sql);
        $query->execute([
        'bookmarkId' => $bookmarkId,
        'nameId' => $nameId
        ]);
    }
    
}