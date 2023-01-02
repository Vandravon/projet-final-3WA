<?php

namespace App\Model\Entity;

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    // Utilisé par:
    // Authenticator, UserController
    //
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

class User {

    private int $id;
    private string $nickname;
    private string $email;
    private string $password;
    private \DateTime $createdAt;
    private bool $role;

    public function __construct(?array $user = []) {
        if (isset($user['id'])) 
            $this->id = (int) $user['id'];
        if (isset($user['nickname'])) 
            $this->nickname = (string) $user['nickname'];
        if (isset($user['email'])) 
            $this->email = (string) $user['email'];
        if (isset($user['password'])) 
            $this->password = (string) $user['password'];
        if (isset($user['created_at'])) 
            $this->createdAt = new \DateTime($user['created_at']);
        if (isset($user['role'])) 
            $this->role = (bool) $user['role'];
    }

    public function getId(): int {
        return $this->id;
    }
    
    public function setId(string $id): void {
        $this->id = $id;
    }
    
    public function getNickname(): string {
        return $this->nickname;
    }

    public function setNickname(string $nickname): void {
        $this->nickname = $nickname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getCreatedAt(): \Datetime {
        return $this->createdAt;
    }

    public function setCreatedAt(\Datetime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getRole(): bool {
        return $this->role;
    }
    
    public function setRole(bool $role): void {
        $this->role = $role;
    }
    
}