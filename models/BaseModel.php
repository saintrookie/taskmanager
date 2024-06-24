<?php 
require 'config.php';
class BaseModel {

    protected $db;

    //get database from config.php
    public function __construct() {
        $this->db = new Database();
    }

   //function for query
    public function query($sql) {
        return $this->db->conn->query($sql);
    }

    //functionto fetch data
    public function fetch($result) {
        if ($result === false) {
            die("Error executing query: " .  $this->db->conn->error);
        }

        return $result->fetch_assoc();
    }

    //function to fetch data all
    public function fetchAll($result) {
        if ($result === false) {
            die("Error executing query: " .  $this->db->conn->error);
        }

        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getErrorInfo() {
        return $this->db->conn->error;
    }
    

    public function close() {
        $this->db->conn->close();
    }

    
}


?>