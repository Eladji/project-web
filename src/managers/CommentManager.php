<?php
// src/CommentManager.php

require_once 'model/comment.php';

class CommentManager {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    // Create a new comment
    public function create(Comment $comment): bool {
        $sql = "INSERT INTO comment (idProject, creationDate, idAuthor, content)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $idProject = $comment->getIdProject();
        $creationDate = $comment->getCreationDate()->format('Y-m-d H:i:s');
        $idAuthor = $comment->getIdAuthor();
        $content = $comment->getContent();
        $stmt->bind_param("isis", $idProject, $creationDate, $idAuthor, $content);
        return $stmt->execute();
    }

    // Read a comment by ID
    public function read(int $id): ?Comment {
        $sql = "SELECT * FROM comment WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $comment = new Comment(
                $row['idProject'],
                $row['idAuthor'],
                new DateTime($row['creationDate']), // Ensure creationDate is DateTime
                $row['content']
            );
            $commentReflection = new ReflectionObject($comment);
            $idProperty = $commentReflection->getProperty('id');
            $idProperty->setAccessible(true);
            $idProperty->setValue($comment, $row['id']);
            return $comment;
        }
        return null;
    }

    // Update a comment
    public function update(Comment $comment): bool {
        $sql = "UPDATE comment SET idProject = ?, creationDate = ?, idAuthor = ?, content = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $id = $comment->getId();
        $idProject = $comment->getIdProject();
        $creationDate = $comment->getCreationDate()->format('Y-m-d H:i:s');
        $idAuthor = $comment->getIdAuthor();
        $content = $comment->getContent();
        $stmt->bind_param("isisi", $idProject, $creationDate, $idAuthor, $content, $id);
        return $stmt->execute();
    }

    // Delete a comment
    public function delete(int $id): bool {
        $sql = "DELETE FROM comment WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // List all comments
    public function list(): array {
        $sql = "SELECT * FROM comment";
        $result = $this->conn->query($sql);
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comment = new Comment(
                $row['idProject'],
                $row['idAuthor'],
                new DateTime($row['creationDate']), // Ensure creationDate is DateTime
                $row['content']
            );
            $commentReflection = new ReflectionObject($comment);
            $idProperty = $commentReflection->getProperty('id');
            $idProperty->setAccessible(true);
            $idProperty->setValue($comment, $row['id']);
            $comments[] = $comment;
        }
        return $comments;
    }
}
?>
