<?php

class MYSQLDatabase {
    
    private $connection;
    public $last_query;
    
    public function __construct() {
        $this->open_connection();
    }

    public function open_connection() {
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (!$this->connection) {
                die("Database connection failed: " . mysqli_error($this->connection));
        } else {
                $db_select = mysqli_select_db($this->connection, DB_NAME );
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
        $this->last_query = $sql;
        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }
    
    public function escape_value( $value ) {
       return mysqli_real_escape_string($this->connection,$value);
    }
    
    private function confirm_query($result) {
	if (!$result) {
                $output = "Database query failed: " ;
                $output .= mysqli_error($this->connection);
                $output .= "<br><br>";
                $output .= "Last SQL Query: " . $this->last_query;
                die($output);              
        }
    }
    
    // "database-neutral" methods
    public function fetch_array($result_set) {
        return mysqli_fetch_array($result_set);
    }
}

$database = new MYSQLDatabase();
$db =& $database;
