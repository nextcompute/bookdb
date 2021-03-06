<?php

require_once (LIB_PATH.DS.'database.php');

class Entry extends DatabaseObject {
   
    protected static $table_name="entries";
    protected static $db_fields = array('id', 'amount', 'debit_id', 'transaction_date','credit_id', 'created','description');
    protected static $order_by = 'transaction_date';
    
    public $id;
    public $amount;
    public $transaction_date;
    public $debit_id;
    public $credit_id;
    public $created;
    public $description;
    
    //Common database methods
    
//    public static function find_all() {
//        return self::find_by_sql("SELECT * FROM ".self::$table_name);
//    }
//    
//    public static function find_by_sql($sql="") {
//    global $database;
//    $result_set = $database->query($sql);
//    $object_array = array();
//    while ($row = $database->fetch_array($result_set)) {
//      $object_array[] = self::instantiate($row);
//    }
//    return $object_array;
//  }
//    
//    private static function instantiate($record) {
//    // Could check that $record exists and is an array
//        $object = new self;
//		
//        // More dynamic, short-form approach:
//        foreach($record as $attribute=>$value){
//            if($object->has_attribute($attribute)) {
//                $object->$attribute = $value;
//            }
//        }
//        return $object;
//    }
//    
//    private function has_attribute($attribute){
//    // We don't care about the value, we just want to know if the key exists
//    // Will return true or false
//        return array_key_exists($attribute, $this->attributes());
//    }
//    
//    protected function attributes() {
//    // return an array of attribute names and their values
//        $attributes = array();
//        foreach(self::$db_fields as $field) {
//            if(property_exists($this, $field)) {
//                $attributes[$field] = $this->$field;
//            }
//        }
//        return $attributes;
//    }
}
