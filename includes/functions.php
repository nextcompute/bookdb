<?php

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

//return formatted <th> row.
function table_headings($fields){
    $output = "";
    $output .= "<tr>";
    foreach ($fields as $field){
        $output .= "<th>";
        $output .= ucwords(str_replace('_', ' ', $field));
        $output .= "</th>";
    }
    $output .= "</tr>";
    return $output;
}

function table_rows($result_array,$fields){
    $output = "";
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

