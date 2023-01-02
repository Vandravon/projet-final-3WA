<?php

namespace App\Model\Manager;

use Symfonette\Manager;
use App\Model\Entity\Contact;

class ContactManager extends Manager {

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet d'envoyer un formulaire de contact pour l'administrateur
    // Model: Contact
    // Vue: user/contact.php
    // Controller: ContactController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function add(Contact $contact):void {
        $sql = 'INSERT INTO contacts (title, content)
        VALUES (:title, :content)';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'title' => $contact->getTitle(),
            'content' => $contact->getContent()
        ]);
    }


    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet à l'administrateur de récupérer tous les formulaires de contact
    // Model: UserManager, Contact
    // Vue: user/administration.php
    // Controller: ContactController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function findAll(): array {
        $sql = 'SELECT contacts.id, contacts.title, contacts.content
                FROM contacts';
        $query = $this->connection->query($sql);
        $contacts = $query->fetchAll();
        $contactObjects = [];
        foreach ($contacts as $contact) {
			array_push($contactObjects, new Contact($contact));
		}
        return $contactObjects;
    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Fonction: Permet de supprimer les formulaires de contact dans le panneau administration 
    // Model: /
    // Vue: user/administration.php
    // Controller: ContactController
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    function delete(int $id): void {
        $sql = "DELETE FROM contacts WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([
        'id' => $id
        ]);
    }

}