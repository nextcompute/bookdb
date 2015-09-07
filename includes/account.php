<?php

class Account {
    
    protected static $table_name="accounts";
    protected static $db_fields = array('id', 'name' ,'parent',);
    
    public $id;
    public $name;
    public $parent;
}

