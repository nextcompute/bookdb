<?php

require_once (LIB_PATH.DS.'database.php');

class DatabaseObject {

    public static function find_all() {
        $sql = "SELECT * FROM " . static::$table_name . self::sql_order();
        return self::find_by_sql($sql);
    }
    
    public static function find_by_id($id) {
        $result_array = self::find_by_sql("SELECT * FROM ". static::$table_name 
                . " WHERE id={$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
        return $object_array;
    }
    
    public static function count_all() {
        global $database;
        $sql = "SELECT COUNT(*) FROM ".static::$table_name;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    private static function instantiate($record) {
    // Could check that $record exists and is an array
        $object = new static;
        // More dynamic, short-form approach:
        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute){
    // We don't care about the value, we just want to know if the key exists
    // Will return true or false
        return array_key_exists($attribute, $this->attributes());
    }

    protected function attributes() {
    // return an array of attribute names and their values
        $attributes = array();
        foreach(static::$db_fields as $field) {
            if(property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }
    
    protected function sanitized_attributes() {
        global $database;
        $clean_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach($this->attributes() as $key => $value){
          $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }
    
    public function create() {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO ".static::$table_name." (";
              $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
              $sql .= join("', '", array_values($attributes));
              $sql .= "')";
        if($database->query($sql)) {
          $this->id = $database->insert_id();
          return true;
        } else {
          return false;
        }
    }
    
    protected static function show_fields() {
        //require_once (LIB_PATH.DS.'field.php');
        $sql = "SHOW FIELDS FROM " . static::$table_name;
        $result_set = Field::find_by_sql($sql);
        return $result_set;
    }
    
    
    //return default order by $order_by
    public static function sql_order (){
        if (isset(static::$order_by)){
            return ' ORDER BY ' .static::$order_by;
            }
        return "";
    }
    
    //return $table_name
    public static function table_name(){
        return static::$table_name;
    }

    //returns db_fields
    public static function table_fields(){
        return static::$db_fields;
    }
    
    //return associative array from object
    public function object_to_assoc($fields){
        $assoc = [];
        if (!(is_array($fields))){ return $assoc; }
        foreach ($fields as $field){
            $assoc[$field] = $this->$field;
        }
        return $assoc;
        
    }
    
}
