<?php
class user {
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $git;
    private int $score;
    private int $nbt_project;
    private string $icon;
    
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
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of git
     */
    public function getGit(): string
    {
        return $this->git;
    }

    /**
     * Set the value of git
     */
    public function setGit(string $git): self
    {
        $this->git = $git;

        return $this;
    }

    /**
     * Get the value of score
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * Set the value of score
     */
    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get the value of nbt_project
     */
    public function getNbt_Project(): int
    {
        return $this->nbt_project;
    }

    /**
     * Set the value of nbt_project
     */
    public function setNbt_Project(int $nbt_project): self
    {
        $this->nbt_project = $nbt_project;

        return $this;
    }

    /**
     * Get the value of icon
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * Set the value of icon
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}