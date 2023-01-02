<?php

namespace App\Controller;

use Symfonette\Controller;
use Symfonette\Authenticator;
use App\Model\Manager\BookmarkManager;
use App\Model\Entity\Bookmark;

class BookmarkController extends Controller {

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Page d'accueil des favoris, liste tous les favoris de l'utilisateur
    // Model: Authenticator, BookmarkManager, Bookmark
    // Vue: bookmark/index.php
    // Controller: /
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function index(): void {
        $authenticator = new Authenticator();
        if ($authenticator->isAuthenticated()) {
            $userId = $authenticator->getUser()->getId();
            $bookmarkManager = new BookmarkManager();
            $bookmarks = $bookmarkManager->findAllByUser($userId);
            $this->renderView('bookmark/index.php', [
            'title' => 'Favoris',
            'bookmarks' => $bookmarks
            ]);
        } else {
            $this->redirectToRoute('app_index');
        }
    } 
    
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet d'ajouter un favori
    // Model: Authenticator, BookmarkManager, Bookmark
    // Vue: bookmark/add.php
    // Controller: /
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function add(): void {

        $authenticator = new Authenticator();
            if ($authenticator->isAuthenticated()) {
                // On initie le tableau $error
                $errors = [];
                // On vérifie que la requête POST n'est pas vide
                if (!empty($_POST)) {
                    // On vérifie que tous les champs sont bien remplis
                    if (empty($_POST['addUrl']) || empty($_POST['addTitle']) || empty($_POST['addPicture_url'])) {
                        $errors[] = "Tous les champs doivent être saisis.";
                    } else {
                        // On vérifie 1 à 1 les champs, qu'ils respectent bien les critères
                        $urlLength = strlen($_POST['addUrl']);
                        if ($urlLength > 255) {
                            $errors[] = "L'url du favori ne doit pas dépasser 255 caractères."; 
                        } 
                        $titleLength = strlen($_POST['addTitle']);
                        if ($titleLength > 255) {
                            $errors[] = "Le titre est beaucoup trop long."; 
                        }
                        $pictureUrlLength = strlen($_POST['addPicture_url']);
                        if ($pictureUrlLength > 255) {
                            $errors[] = "L'url de l'image ne doit pas dépasser 255 caractères."; 
                        }       
                    }
                    // Ne se lance que si on n'a eu aucune erreur avant
                    if (empty($errors)) {
                        $bookmarkManager = new BookmarkManager();
                        $bookmark = new Bookmark();
                        // On hydrate avec les set
                        $bookmark->setUrl(htmlspecialchars($_POST['addUrl']));
                        $bookmark->setTitle(htmlspecialchars($_POST['addTitle']));
                        $bookmark->setPictureUrl(htmlspecialchars($_POST['addPicture_url']));
                        $userId = $authenticator->getUser()->getId();
                        $bookmarkManager->add($userId, $bookmark);
                        // On redirige vers la page des favoris
                        $this->redirectToRoute('app_bookmark_index');
                        }
                    }
                $this->renderView('bookmark/add.php', [
                'title' => 'Ajouter un favori',
                'errors' => $errors
                ]);
        
        } else {
            $this->redirectToRoute('app_bookmark_index');
        }
    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Etape intermédiaire qui permet de préremplir les champs pour ajouter un favori
    // Model: Authenticator
    // Vue: bookmark/addApi.php, bookmark/add.php
    // Controller: /
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function addApi(): void {
        Authenticator::firewall();
        $errors = [];
        if (!empty($_POST)) {
            if (empty($_POST['urlApi'])) {
                $errors[] = "Tous les champs doivent être saisis.";
            }
            elseif (filter_var($_POST['urlApi'], FILTER_VALIDATE_URL) === FALSE) {
                $errors[] = "Ceci n'est pas une URL valide!";
            }
            else {
                $api_url = 'https://jsonlink.io/api/extract?url=' . (htmlspecialchars($_POST['urlApi']));
                $json_metadata = file_get_contents($api_url);
                $metadata = json_decode($json_metadata);
                $infos = [
                    'url' => $metadata->url,
                    'title' => $metadata->title,
                    'image' => $metadata->images[0]
                ];
                $this->redirectToRoute('app_bookmark_add', $infos);
            }
        }
        
        $this->renderView('bookmark/addApi.php', [
                'title' => "Préparer avec l'API",
                'errors' => $errors
                ]);
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet d'éditer un favori
    // Model: BookmarkManager, Bookmark
    // Vue: bookmark/edit.php
    // Controller: 
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function edit(): void {
        Authenticator::firewall();
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $bookmarkId = $_GET['id'];
            $bookmarkManager = new BookmarkManager();
            $bookmarkView = $bookmarkManager->find($bookmarkId);
            
            $errors = [];
            if (!empty($_POST)) {
                // On vérifie que tous les champs sont bien remplis
                if (empty($_POST['title']) || empty($_POST['picture_url']) || empty($_POST['url'])) {
                    $errors[] = "Tous les champs doivent être saisis.";
                } else {
                    // On vérifie 1 à 1 les champs, qu'ils respectent bien les critères
                    $titleLength = strlen($_POST['title']);
                    if ($titleLength > 255) {
                        $errors[] = "Le titre est beaucoup trop long."; 
                    }
                    $pictureUrlLength = strlen($_POST['picture_url']);
                    if ($pictureUrlLength > 255) {
                        $errors[] = "L'url de l'image ne doit pas dépasser 255 caractères."; 
                    }
                    $urlLength = strlen($_POST['url']);
                    if ($urlLength > 255) {
                        $errors[] = "L'url du favori ne doit pas dépasser 255 caractères."; 
                    }
                }
                if (empty($errors)) {
                    $bookmarkManager = new BookmarkManager();
                    $bookmark = new Bookmark();
                    // On hydrate avec les set
                    $bookmark->setId(htmlspecialchars($_GET['id']));
                    $bookmark->setTitle(htmlspecialchars($_POST['title']));
                    $bookmark->setPictureUrl(htmlspecialchars($_POST['picture_url']));
                    $bookmark->setUrl(htmlspecialchars($_POST['url']));
                    $bookmarkManager->update($bookmark);
                    // On redirige vers la page des favoris
                    $this->redirectToRoute('app_bookmark_index');
                }
            }
        }
        $this->renderView('bookmark/edit.php', [
        'title' => 'Editer un favori',
        'bookmarkView' => $bookmarkView
        ]);
    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet à un utilisateur de supprimer un de ses favoris
    // Model: BookmarkManager
    // Vue: bookmark/index.php
    // Controller: /
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function delete(): void {
        Authenticator::firewall();
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $bookmarkManager = new BookmarkManager();
                $bookmarkManager->cleanJunctionTable($_GET['id']);
                $bookmarkManager->delete($_GET['id']);
                $this->redirectToRoute('app_bookmark_index');
        } else {
            $this->redirectToRoute('app_bookmark_index');
        }
    }

    
}