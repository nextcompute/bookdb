<?php
require_once ('../includes/initialize.php');

include_once('../includes/initialize.php');

include('/layouts/header.php');
require_once('/layouts/navigation.php');
//$page_tile is from navigation.php
if ($page_title == 'entries') {
    $class_name = 'Entry';
} else if ($page_title == 'accounts_balances'){
    $class_name = 'AccountBalance';
}

$object_array = "";
$fields = "";

if (isset($class_name)){

    $object_array = $class_name::find_all();
    $fields = $class_name::table_fields();
}

$output = "";
$output .= "<table width  = 50%>";

$output .= table_headings($fields);
$output .= table_rows($object_array,$fields);

$output .= "</table>";
echo $output;

include('/layouts/footer.php');

