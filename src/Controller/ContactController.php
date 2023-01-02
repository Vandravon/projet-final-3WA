<?php

namespace App\Controller;

use Symfonette\Controller;
use Symfonette\Authenticator;
use App\Model\Manager\ContactManager;
use App\Model\Entity\Contact;

class ContactController extends Controller {

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet d'afficher le formulaire de contact puis de l'envoyer
    // Model: ContactManager, Contact
    // Vue: app/contact.php, app/submit.php (redirection)
    // Controller: /
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function contact(): void {

        $contactManager = new ContactManager;
        $contacts = $contactManager->findAll();

        $errors = [];
        // On vérifie que la requête POST n'est pas vide
        if (!empty($_POST)) {
            if (empty($_POST['title']) || empty($_POST['content'])) {
                $errors[] = "Tous les champs doivent être saisis.";
            } else {
                // Maximum 60 caractères pour le titre
                $titleLength = strlen($_POST['title']);
                if ($titleLength > 60) {
                    $errors[] = "Le titre ne doit pas faire plus de 60 caractères."; 
                }
                // Maximum 8192 caractères pour le contenu
                $contentLength = strlen($_POST['content']);
                if ($contentLength > 8192) {
                    $errors[] = "Le contenu est beaucoup trop long."; 
                }
            }

            if (empty($errors)) {
                $contactManager = new ContactManager;
                $contact = new Contact;
                $contact->setTitle(htmlspecialchars($_POST['title']));
                $contact->setContent(htmlspecialchars($_POST['content']));
                $contactManager->add($contact);
                $this->redirectToRoute('app_contact_submit');

            }
        }
        $this->renderView('app/contact.php', [
        'title' => 'Formulaire de contact',
        'errors' => $errors,
        'contacts' => $contacts
        ]);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Pour supprimer des formulaires de contact, via l'interface administrateur
    // Model: ContactManager
    // Vue: user/administration.php
    // Controller: /
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

        public function delete(): void {
            $authenticator = new Authenticator;
            // On reprend le même principe que pour la méthode administration() pour vérifier un administrateur
            if ($authenticator->isAuthenticated()){
                $role = $authenticator->getUser()->getRole();
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    if ($role === true) {
                        $contactManager = new ContactManager;
                        $contactManager->delete($_GET['id']);
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

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Page de remerciement affichée lorsque le formulaire de contact a été envoyé
    // Model: /
    // Vue: app/submit.php, app/contact.php
    // Controller: /
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

        public function submit(): void {
            $this->renderView('app/submit.php', [
                'title' => 'Merci pour votre contribution !'
            ]);
        }
    
}