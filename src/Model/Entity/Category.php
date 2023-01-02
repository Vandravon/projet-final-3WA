<?php

namespace App\Model\Entity;

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // 
    // Utilisé par:
    // CategoryController, CategoryManager, BookmarkManager
    // 
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

class Category {

    private int $id;
    private string $name;
    
    private Bookmark $bookmark;

    public function __construct(?array $category = []) {
        if (isset($category['id'])) 
            $this->id = (int) $category['id'];
        if (isset($category['name']))
            $this->name = (string) $category['name'];
        if (isset($category['bookmark'])) 
            $this->bookmark = $category['bookmark'];
    }

    public function getId(): int {
        return $this->id;
    }
    
    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }
    
    public function getBookmark(): Bookmark {
        return $this->bookmark;
    }
    
    public function setBookmark($bookmark): void {
        $this->bookmark = $bookmark;
    }

    
}