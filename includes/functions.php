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

//Assumes $result_array is with objects
function table_rows($result_array,$fields){
    $output = "";
    if (!(is_array($fields))){ return $output; }
    for ($i=0; $i<count($result_array); $i++){
        $output .= "<tr>";
        foreach ($fields as $field){
            $output .= "<td>";
            $output .= $result_array[$i]->$field;
            $output .= "</td>";
        }
        $output .= "</tr>";
    }
    return $output;
}

