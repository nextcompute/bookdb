<?php
require_once ('../includes/initialize.php');

include('/layouts/header.php');
require_once('/layouts/navigation.php');
//$page_tile is from navigation.php
if ($page_title == 'entries') {
    $class_name = 'Entry';
} else if ($page_title == 'accounts_balances'){
    $class_name = 'AccountBalance';
} else if ($page_title == 'accounts'){
    $class_name = 'Account';
}

$object_array = "";
$fields = "";
$result_array = [];
if (isset($class_name)){

    $object_array = $class_name::find_all();
    $fields = $class_name::table_fields();
    for ($i=0; $i<count($object_array); $i++){
        $result_array[] = $object_array[$i]->object_to_assoc($fields);
    }
}

$output = "";
$output .= "<table width  = 50%>";

$output .= table_headings($fields);

$output .= table_rows($result_array,$fields);
$output .= "</table>";
echo $output;

include('/layouts/footer.php');