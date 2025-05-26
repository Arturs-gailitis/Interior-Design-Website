<?php

require_once "Database.php";

class Message {

    private $connection;

    public function __construct() {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    public function create($name, $email, $message) {
        $stmt = $this->connection->prepare("
            INSERT INTO messages (name, email, message) 
            VALUES (:name, :email, :message)
        ");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        return $stmt->execute();
    }

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT * FROM messages ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM messages WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     public function update($id, $message, $status) {
    $stmt = $this->connection->prepare("
        UPDATE messages SET message = :message, status = :status WHERE id = :id");
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM messages WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getMessageById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM messages WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>
