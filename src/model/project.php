<?php
// src/Project.php

class Project
{
    private int $id;
    private string $name;
    private int $state;
    private DateTime $creationDate;
    private string $repoGit;
    private int $idAuthor;
    private string $thumbnail;
    private string $description;

    // Constructor
    public function __construct(
        string $name,
        int $state,
        string $repoGit,
        int $idAuthor,
        string $thumbnail,
        string $description
    ) {
        $this->name = $name;
        $this->state = $state;
        $this->repoGit = $repoGit;
        $this->idAuthor = $idAuthor;
        $this->thumbnail = $thumbnail;
        $this->description = $description;
        $this->creationDate = new DateTime();
    }

    // Getters and setters

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getState(): int
    {
        return $this->state;
    }

    public function setState(int $state): void
    {
        $this->state = $state;
    }

    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(DateTime $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    public function getRepoGit(): string
    {
        return $this->repoGit;
    }

    public function setRepoGit(string $repoGit): void
    {
        $this->repoGit = $repoGit;
    }

    public function getIdAuthor(): int
    {
        return $this->idAuthor;
    }

    public function setIdAuthor(int $idAuthor): void
    {
        $this->idAuthor = $idAuthor;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


}
    