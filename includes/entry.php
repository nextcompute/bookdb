<?php

require_once (LIB_PATH.DS.'database.php');

class Entry extends DatabaseObject {
   
    protected static $table_name="entries";
    protected static $db_fields = array('id', 'amount', 'debit_id', 'credit_id', 'created','description');
    
    public $id;
    public $amount;
    public $debit_id;
    public $credit_id;
    public $created;
    public $description;
    
    //Common database methods
    
    private static function instantiate($record) {
    // Could check that $record exists and is an array
        $object = new self;
		
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
        foreach(self::$db_fields as $field) {
            if(property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }
}
