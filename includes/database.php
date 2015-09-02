<?php

class MYSQLDatabase {
    
    private $connection;
    
    public function __construct() {
        $this->open_connection();
    }

    public function open_connection() {
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (!$this->connection) {
                die("Database connection failed: " . mysqli_error($this->connection));
        } else {
                $db_select = mysqli_select_db(DB_NAME, $this->connection);
                if (!$db_select) {
                        die("Database selection failed: " . mysqli_error($this->connection));
                }
        }
    }
    
    public function close_connection() {
        if(isset($this->connection)) {
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }
    
    public function query($sql){
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }
}

$database = new MYSQLDatabase();
$db =& $database;
