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
