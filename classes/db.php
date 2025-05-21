<?php

require_once __DIR__ . "/../setup/connection.php";

class Database {

    private $host = "localhost";
    private $username = "root";
    private $password = "arturs2003";
    private $database = "design-database";
    private $port = 3306;
    private $conection;

    public function __construct() {

        try {

            $this->conection = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->database}", 
            $this->username, 
            $this->password);

        } catch (PDOException $error) {

            die("Connection failed: " . $error->getMessage());
        }

    }

    public function getConnection() {

        return $this->conection;
    }
}
?>