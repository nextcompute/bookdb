<?php

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

//Return string field name without _ and first letter uppercased.
function format_field_name($str){
    return ucwords(str_replace('_', ' ', $str));
}

//return formatted <th> row.
function table_headings($fields){
    $output = "";
    $output .= "<tr>";
    if (!(is_array($fields))){ return $output; }
    foreach ($fields as $field){
        $output .= "<th>";
        $output .= format_field_name($field);
        $output .= "</th>";
    }
    $output .= "</tr>";
    return $output;
}

//Returns table rows for each $field in $result_array
function table_rows($result_array,$fields){
    global $view_title;
    $output = "";
    if (!(is_array($fields))){ return $output; }
    for ($i=0; $i<count($result_array); $i++){
        $output .= "<tr>";
        $result = $result_array[$i];
        foreach ($fields as $field){
            $output .= "<td>";
            if ($field == 'id'){
                $output .= "<a href=\"?id=$result[$field]\">$result[$field]</a>";
            } else {
                $output .= $result[$field];
            }
            $output .= "</td>";
        }
        $output .= "</tr>";
    }
    return $output;
}

//returns <table> formatted records.
    function display_table($result_array,$fields){
        $output = "";
        $output .= "<table width  = 50%>";
        $output .= table_headings($fields);
        $output .= table_rows($result_array,$fields);
        $output .= "</table>";
        return $output; 
    }

