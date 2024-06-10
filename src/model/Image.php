<?php 
class Image
{
    private int $id;
    private string $path;
    private int $idProject;

    public function __construct(string $path, int $idProject)
    {
        $this->path = $path;
        $this->idProject = $idProject;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setPath(string $path): void
    {
        $this->path = $path;
    }
    public function setIdProject(int $idProject): void
    {
        $this->idProject = $idProject;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getIdProject(): int
    {
        return $this->idProject;
    }
}