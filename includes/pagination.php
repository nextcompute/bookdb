<?php

class Pagination {
    

    public $current_page;
    public $per_page;
    public $total_count;
    
    public function __construct($page=1, $per_page=20, $total_count=0){
  	$this->current_page = (int)$page;
        $this->per_page = (int)$per_page;
        $this->total_count = (int)$total_count;
    }
}
