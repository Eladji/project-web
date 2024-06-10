<?php
 require_once 'model/Image.php';

 class ImagesManager
 {
     private mysqli $conn;
 
     public function __construct(mysqli $conn)
     {
         $this->conn = $conn;
     }
 
     // Create a new project
     public function create(Image $image): bool
     {
         $sql = "INSERT INTO Image (path, id_project)
                 VALUES (?, ?)";
         $stmt = $this->conn->prepare($sql);
            $path = $image->getPath();
            $id_project = $image->getIdProject();
  
         $stmt->bind_param("si", $path, $id_project);
         return $stmt->execute();
     }

     public function update(Image $image): bool
     {
         $sql = "UPDATE Image SET path = ?
                 WHERE id = ?";
         $stmt = $this->conn->prepare($sql);
         $id = $image->getId();
         $path = $image->getPath();
         $id_project = $image->getIdProject();
        
         
            $stmt->bind_param("si", $path, $id_project, $id);
        
         return $stmt->execute();
     }

     public function delete(int $id): bool
     {
         $sql = "DELETE FROM Image WHERE id = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param("i", $id);
         return $stmt->execute();
     }

     public function list(): array
    {
        $sql = "SELECT * FROM Image";
        $result = $this->conn->query($sql);
        $projects = [];
        while ($row = $result->fetch_assoc()) {
            $image = new Image(
                $row['path'],
                $row['id_project'],       
            );
            $ImageReflection = new ReflectionObject($image);
            $idProperty = $ImageReflection->getProperty('id');
            $idProperty->setAccessible(true);
            $idProperty->setValue($image, $row['id']);
            $projects[] = $image;
        }
        return $projects;
    }
    }
