<?php
// User.php

class User {
    private int $id;
    private string $name;
    private string $password;
    private string $email;
    private string $git;
    private int $score;
    private int $nbt_project;
    private string $icon;

    public function __construct(string $name, string $password, string $email, string $git, int $score, int $nbt_project, string $icon) {
        $this->name = $name;
        $this->password = password_hash($password, PASSWORD_BCRYPT); // Hash the password
        $this->email = $email;
        $this->git = $git;
        $this->score = $score;
        $this->nbt_project = $nbt_project;
        $this->icon = $icon;
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getPassword(): string { return $this->password; }
    public function getEmail(): string { return $this->email; }
    public function getGit(): string { return $this->git; }
    public function getScore(): int { return $this->score; }
    public function getNbtProject(): int { return $this->nbt_project; }
    public function getIcon(): string { return $this->icon; }

    // Setters
    public function setId(int $id) : void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setPassword(string $password): void { $this->password = password_hash($password, PASSWORD_BCRYPT); }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setGit(string $git): void { $this->git = $git; }
    public function setScore(int $score): void { $this->score = $score; }
    public function setNbtProject(int $nbt_project): void { $this->nbt_project = $nbt_project; }
    public function setIcon(string $icon): void { $this->icon = $icon; }
}


