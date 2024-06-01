<?php
class project
{
    private int $id;
    private string $name;
    private string $description;
    private $creation_date;
    private bool $state;
    private int $id_creator;
    private string $thumbnail;
    private string $repo_git;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
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
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

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
     * Get the value of state
     */
    public function isState(): bool
    {
        return $this->state;
    }

    /**
     * Set the value of state
     */
    public function setState(bool $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of id_creator
     */
    public function getIdCreator(): int
    {
        return $this->id_creator;
    }

    /**
     * Set the value of id_creator
     */
    public function setIdCreator(int $id_creator): self
    {
        $this->id_creator = $id_creator;

        return $this;
    }

    /**
     * Get the value of thumbnail
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * Set the value of thumbnail
     */
    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get the value of repo_git
     */
    public function getRepoGit(): string
    {
        return $this->repo_git;
    }

    /**
     * Set the value of repo_git
     */
    public function setRepoGit(string $repo_git): self
    {
        $this->repo_git = $repo_git;

        return $this;
    }
}
