<?php
// src/ProjectManager.php

require_once 'model/Project.php';

class ProjectManager
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    // Create a new project
    public function create(Project $project): bool
    {
        $sql = "INSERT INTO Project (name, state, creation_date, repo_git, id_author, thumbnail, description)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $name = $project->getName();
        $state = $project->getState();
        $creationDate = $project->getCreationDate()->format('Y-m-d H:i:s');
        $repoGit = $project->getRepoGit();
        $idAuthor = $project->getIdAuthor();
        $thumbnail = $project->getThumbnail();
        
        $description = $project->getDescription();
        $stmt->bind_param("sississ", $name, $state, $creationDate, $repoGit, $idAuthor, $thumbnail,$description);
        return $stmt->execute();
    }

    // Read a project by ID
    public function read(int $id): ?Project
    {
        $sql = "SELECT * FROM Project WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $project = new Project(
                $row['name'],
                $row['state'],
                $row['repo_git'],
                $row['id_author'],
                $row['thumbnail'],
                $row['description'],
                
            );
            $projectReflection = new ReflectionObject($project);
            $idProperty = $projectReflection->getProperty('id');
            $idProperty->setAccessible(true);
            $idProperty->setValue($project, $row['id']);
            return $project;
        }
        return null;
    }

    // Update a project
    public function update(Project $project): bool
    {
        $sql = "UPDATE Project SET name = ?, state = ?, repo_git = ?, id_author = ?, thumbnail = ?,  description = ? 
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $id = $project->getId();
        $name = $project->getName();
        $state = $project->getState();
        $repoGit = $project->getRepoGit();
        $idAuthor = $project->getIdAuthor();
        $thumbnail = $project->getThumbnail();
        
        
        $description = $project->getDescription();
        $stmt->bind_param("sissisi", $name, $state, $repoGit, $idAuthor, $thumbnail,  $description, $id);
        return $stmt->execute();
    }

    // Delete a project
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM Project WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // List all projects
    public function list(): array
    {
        $sql = "SELECT * FROM Project";
        $result = $this->conn->query($sql);
        $projects = [];
        while ($row = $result->fetch_assoc()) {
            $project = new Project(
                $row['name'],
                $row['state'],
                $row['repo_git'],
                $row['id_author'],
                $row['thumbnail'],
                $row['description'],
                
            );
            $projectReflection = new ReflectionObject($project);
            $idProperty = $projectReflection->getProperty('id');
            $idProperty->setAccessible(true);
            $idProperty->setValue($project, $row['id']);
            $projects[] = $project;
        }
        return $projects;
    }
}
