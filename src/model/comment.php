<?php
// src/Comment.php

class Comment {
    private int $id;
    private int $idProject;
    private int $idAuthor;
    private DateTime $creationDate;
    private string $content;

    public function __construct(int $idProject, int $idAuthor, DateTime $creationDate, string $content) {
        $this->idProject = $idProject;
        $this->idAuthor = $idAuthor;
        $this->creationDate = $creationDate;
        $this->content = $content;
    }

    // Getter methods
    public function getId(): int {
        return $this->id;
    }

    public function getIdProject(): int {
        return $this->idProject;
    }

    public function getIdAuthor(): int {
        return $this->idAuthor;
    }

    public function getCreationDate(): DateTime {
        return $this->creationDate;
    }

    public function getContent(): string {
        return $this->content;
    }

    // Setter methods (if needed)
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setIdProject(int $idProject): void {
        $this->idProject = $idProject;
    }

    public function setIdAuthor(int $idAuthor): void {
        $this->idAuthor = $idAuthor;
    }

    public function setCreationDate(DateTime $creationDate): void {
        $this->creationDate = $creationDate;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }
}
?>
