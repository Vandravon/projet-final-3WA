<?php

namespace App\Model\Entity;

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Utilisé par: 
    // ContactController, ContactManager
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

class Contact {

    private int $id;
    private string $title;
    private string $content;

    public function __construct(?array $contact = []) {
        if (isset($contact['id'])) 
            $this->id = (int) $contact['id'];
        if (isset($contact['title'])) 
            $this->title = (string) $contact['title'];
        if (isset($contact['content'])) 
            $this->content = (string) $contact['content'];
    }

    public function getId(): int {
        return $this->id;
    }
    
    public function setId(string $id): void {
        $this->id = $id;
    }
    
    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

}