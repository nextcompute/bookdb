<?php
class Navigation extends DatabaseObject {
    
    protected static $table_name = "navigation";
    protected static $db_fields = array('id', 'name' ,'location',);
    
    public $id;
    public $name;
    public $location;
}
