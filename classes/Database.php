<?php

require_once __DIR__ . '/../includes/db.php';

class Database {

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "design-database";
    private $port = 3306;
    private $con;

    public function __construct() {
        try{
            $this->con = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->database}", 
                $this->username, 
                $this->password
            );
        } catch (PDOException $e) {
            die("Connection faled: " . $e->getMessage());
        }

    }

    public function getConnection() {
        return $this->con;
    }

}
?>