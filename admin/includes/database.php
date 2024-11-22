<?php 
require_once("new_config.php");

class Database {

    public $connection;
    public $db;

    function __construct() {
        
        // With this our DB will open automatically in every page
       $this->db = $this->open_db_connection();
    }

    // Procedural way of connection to the DB
    // public function open_db_connection() {

    // $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    //     if(mysqli_connect_errno()) {
    //         die("Database connection failed" . mysqli_error($connection));
    //     }
    // }


    // OOP way of connection to the DB
    public function open_db_connection() {
        // mysqli object will be applied to the connection property
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
            if(mysqli_connect_errno()) {
                die("Database connection failed" . $this->connection->connect_error);
            }

            return $this->connection;
        }

    public function query($sql) {
        // Same as in CMS BLOG project
        // $result = mysqli_query($this->connection, $sql);
        $result = $this->db->query($sql);
        $this->confirm_query($result);

        return $result;
    }

    private function confirm_query($result) {
        if(!$result) {
            die("Query failed!") . $this->db->error;
        }
    }

    public function escape_string($string){
        // $escaped_string = mysqli_real_escape_string($this->connection, $string);
        return $this->db->real_escape_string($string);
    }

    public function  the_inserted_id() {
        return $this->db->insert_id;
        // return mysqli_insert_id($this->connection);
    }
} // End of Class

$database = new Database();



?>