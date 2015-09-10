<?php

class Field extends DatabaseObject {
    
    protected static $db_fields = array('Field', 'Type', 'Key');
    
    public $Field;
    public $Type;
    public $Key;
    
    protected static function show_fields(){
        return NULL;
    }
}

