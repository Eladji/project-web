<?php
class comment {
    private int $id;
    private string $content;
    private $creation_date;
    private int $id_author;
    private int $id_project;

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of creation_date
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * Set the value of creation_date
     */
    public function setCreationDate($creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    /**
     * Get the value of id_author
     */
    public function getIdAuthor(): int
    {
        return $this->id_author;
    }

    /**
     * Set the value of id_author
     */
    public function setIdAuthor(int $id_author): self
    {
        $this->id_author = $id_author;

        return $this;
    }

    /**
     * Get the value of id_project
     */
    public function getIdProject(): int
    {
        return $this->id_project;
    }

    /**
     * Set the value of id_project
     */
    public function setIdProject(int $id_project): self
    {
        $this->id_project = $id_project;

        return $this;
    }
}