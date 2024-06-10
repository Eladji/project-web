<?php
// UserManager.php

require 'config.php';
require 'model/user.php';

class UserManager {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    // Create a new user
    public function createUser(User $user): int|false {
        $sql = "INSERT INTO user (name, password, email, git, score, nbt_project, icon) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssiis",
            $user->getName(),
            $user->getPassword(),
            $user->getEmail(),
            $user->getGit(),
            $user->getScore(),
            $user->getNbtProject(),
            $user->getIcon()
        );
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        } else {
            return false;
        }
    }

    // Read a user by ID
    public function getUserById(int $id): ?array {
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Update a user
    public function updateUser(User $user, int $id): bool {
        $sql = "UPDATE user SET name = ?, password = ?, email = ?, git = ?, score = ?, nbt_project = ?, icon = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssiisi",
            $user->getName(),
            $user->getPassword(),
            $user->getEmail(),
            $user->getGit(),
            $user->getScore(),
            $user->getNbtProject(),
            $user->getIcon(),
            $id
        );
        return $stmt->execute();
    }

    // Delete a user
    public function deleteUser(int $id): bool {
        $sql = "DELETE FROM user WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // List all users
    public function listUsers(): array {
        $sql = "SELECT * FROM user";
        $result = $this->conn->query($sql);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }
}
?>
