<?php
//config database
class Database {
    private $dbHost = 'localhost';
    private $dbName = 'task_manager';
    private $dbUser = 'root';
    private $dbPassword = '';

    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $this->conn->set_charset("utf8mb4");
    }
}
