<?php 
class Connection{
    //create a new connection
    private $servername="localhost";
    private $admin="root";
    private $adminPassword="";
    public $conn;
    
        public function __construct() {
            // Create connection
            $this->conn = new mysqli($this->servername, $this->admin, $this->adminPassword);
    
            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }
        //create a database connection
        function createDatabase($dbName) {
            $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
            
            $this->conn->query($sql);
            
        }
        
        function selectDatabase($dbName) {
            $this->conn->select_db($dbName);
        }
        
        function createTable($query) {
            $this->conn->query($query);
            
        }
    }









?>