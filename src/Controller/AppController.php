<?php

namespace App\Controller;

use Symfonette\Controller;

class AppController extends Controller {
    
    /////////////////////////////////////////////////////
    // Fonction: Page d'accueil du site: sert à la présentation et à la connexion; également page par défaut
    // Model: /
    // Vue: app/index.php
    // Controller: /
    /////////////////////////////////////////////////////

    public function index(): void {
        $this->renderView('app/index.php', [
        'title' => 'Accueil'
        ]);
    }
    
}