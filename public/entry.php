<?php
require_once ('../includes/initialize.php');

include('/layouts/header.php');
$page_name = "entry";
require_once('/layouts/navigation.php');

$object_array = Entry::find_all();
$fields = Entry::table_fields();    

for ($i=0; $i<count($object_array); $i++){
    $result_array[] = $object_array[$i]->object_to_assoc($fields);
}

echo display_table($result_array,$fields);
include('/layouts/footer.php');


