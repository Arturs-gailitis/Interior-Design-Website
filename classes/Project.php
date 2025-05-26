<?php
require_once 'Database.php';

class Project {
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function create($title, $description, $location, $start_day, $end_day, $status, $image_path) {
    $stmt = $this->connection->prepare("
        INSERT INTO projects (title, description, location, start_day, end_day, status, image_path)
        VALUES (:title, :description, :location, :start_day, :end_day, :status, :image_path)
    ");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':start_day', $start_day);
    $stmt->bindParam(':end_day', $end_day);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':image_path', $image_path);
    return $stmt->execute();
}

    public function readAll() {
        $stmt = $this->connection->query("
            SELECT id, title, description, location, start_day, end_day, status, image_path FROM projects
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectById($id) {
    $stmt = $this->connection->prepare("
        SELECT id, title, description, location, start_day, end_day, status, image_path
        FROM projects WHERE id = :id
    ");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function update($id, $title, $description, $location, $start_day, $end_day, $status, $image_path) {
        $stmt = $this->connection->prepare("
            UPDATE projects SET 
                title = :title,
                description = :description,
                location = :location,
                start_day = :start_day,
                end_day = :end_day,
                status = :status,
                image_path = :image_path
            WHERE id = :id
        ");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':start_day', $start_day);
        $stmt->bindParam(':end_day', $end_day);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':image_path', $image_path);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM projects WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>