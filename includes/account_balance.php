<?php

class AccountBalance extends DatabaseObject {
    
    protected static $table_name="account_balances";
    protected static $db_fields = array('account_id', 'balance',);
    
    public $account_id;
    public $entry_id;
    public $amount;
    public $balance;
    
}

