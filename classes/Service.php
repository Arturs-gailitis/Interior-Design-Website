<?php
require_once 'Database.php';

class Service {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function create($title, $desc, $image) {
        $uploadDir = 'images/services/';
        $fileName = basename($image['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($image['tmp_name'], $targetPath)) {
            $stmt = $this->db->prepare("INSERT INTO services (title, description, image) VALUES (:title, :desc, :image)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':desc', $desc);
            $stmt->bindParam(':image', $fileName);
            return $stmt->execute();
        }
        return false;
    }

    public function readAll() {
        $stmt = $this->db->query("SELECT * FROM services");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $desc, $image = null) {
        if ($image) {
            $uploadDir = 'images/services/';
            $fileName = uniqid() . '_' . basename($image['name']);
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                $oldImage = $this->getServiceById($id)['image'];
                if ($oldImage && file_exists($uploadDir . $oldImage)) {
                    unlink($uploadDir . $oldImage);
                }
                
                $stmt = $this->db->prepare("UPDATE services SET title = :title, description = :desc, image = :image WHERE id = :id");
                $stmt->bindParam(':image', $fileName);
            } else {
                return false;
            }
        } else {
            $stmt = $this->db->prepare("UPDATE services SET title = :title, description = :desc WHERE id = :id");
        }
        
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id) {
        $service = $this->getServiceById($id);
        if ($service && $service['image']) {
            $imagePath = 'images/services/' . $service['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        $stmt = $this->db->prepare("DELETE FROM services WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getServiceById($id) {
        $stmt = $this->db->prepare("SELECT * FROM services WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function searchByKeyword($keyword) {
        $stmt = $this->db->prepare("SELECT * FROM services WHERE title LIKE :kw OR description LIKE :kw");
        $kw = '%' . $keyword . '%';
        $stmt->bindParam(':kw', $kw);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>