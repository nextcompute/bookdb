<?php

require_once (LIB_PATH.DS.'database.php');

class DatabaseObject {

    public static function find_all() {
        return self::find_by_sql("SELECT * FROM " . static::$table_name);
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
