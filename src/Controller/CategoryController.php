<?php

namespace App\Controller;

use Symfonette\Controller;
use Symfonette\Authenticator;
use App\Model\Manager\CategoryManager;
use App\Model\Entity\Category;

class CategoryController extends Controller {

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet d'éditer les tags d'un favori
    // Model: CategoryManager, Category
    // Vue: bookmark/editTag.php
    // Controller: /
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function editTag(): void {
        Authenticator::firewall();
        if (isset($_GET['bookmarkId']) && is_numeric($_GET['bookmarkId'])) {
            $bookmarkId = $_GET['bookmarkId'];
            $categoryManager = new CategoryManager();
            $getBookmarkNames = $categoryManager->findAllByBookmark($bookmarkId);
            $getAllCategories = $categoryManager->findAll();
            
            if (!empty($_POST)) {
                foreach($getAllCategories as $categoryId) {
                    $categoryManager->deleteJunctionBookmarkCategory($bookmarkId, $categoryId->getId());
                }
                
                foreach($_POST as $name => $id) {
                    $id = intval($id);
                    $categoryManager->addJunctionBookmarkCategory($bookmarkId, $id);
                }
            $this->redirectToRoute('app_bookmark_index');
            }
        
        $this->renderView('bookmark/editTag.php', [
        'title' => 'Editer les tags',
        'getBookmarkNames' => $getBookmarkNames,
        'getAllCategories' => $getAllCategories
        ]);
        }
    }
}