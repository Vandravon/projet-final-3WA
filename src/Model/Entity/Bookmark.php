<?php

namespace App\Model\Entity;

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // 
    // Utilisé par:
    // BookmarkController, BookmarkManager, Category
    // 
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

class Bookmark {
    
    
    private int $id;
    private string $title;
    private string $pictureUrl;
    private string $url;
    private \DateTime $createdAt;
    // Objet User, qui vient du manager éponyme
    private User $user;
    // Tableau contenant de multiples objets Category
    private array $categories;

    
    public function __construct(array $bookmark = []) {
        if (isset($bookmark['id'])) {
            $this->id = (int) $bookmark['id'];
        }
        if (isset($bookmark['title'])) {
            $this->title = (string) $bookmark['title'];
        }
        if (isset($bookmark['picture_url'])) {
            $this->pictureUrl = (string) $bookmark['picture_url'];
        }
        if (isset($bookmark['url'])) {
            $this->url = (string) $bookmark['url'];
        }
        if (isset($bookmark['created_at'])) {
            $this->createdAt = new \DateTime($bookmark['created_at']);
        }
        if (isset($bookmark['user'])) {
            $this->user = $bookmark['user'];
        }
        if (isset($bookmark['categories'])) {
            $this->categories = $bookmark['categories'];
        }

    }
    
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    } 
    
    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }
    
    public function getPictureUrl(): string {
        return $this->pictureUrl;
    }

    public function setPictureUrl(string $pictureUrl) {
        $this->pictureUrl = $pictureUrl;
    }
    
    public function getUrl(): string {
        return $this->url;
    }

    public function setUrl(string $url) {
        $this->url = $url;
    }
        
    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
    }
    
    public function getUser(): User {
        return $this->user;
    }
    
    public function getCategories(): array {
        return $this->categories;
    }
   
}