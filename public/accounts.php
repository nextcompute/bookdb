<?php
require_once ('../includes/initialize.php');

include('/layouts/header.php');
$page_name = "entry";
// 1. the current page number ($current_page)
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

// 2. records per page ($per_page)
$per_page = 10;
// 3. total record count ($total_count)
$total_count = Account::count_all();

//$object_array = Account::find_all();
$fields = Account::table_fields();

$pagination = new Pagination($page, $per_page, $total_count);
$sql = "SELECT * FROM " . Account::table_name();
$sql .= Account::sql_order();
$sql .= " LIMIT {$per_page} ";
$sql .= " OFFSET {$pagination->offset()}";
$object_array = Account::find_by_sql($sql);

for ($i=0; $i<count($object_array); $i++){
    $result_array[] = $object_array[$i]->object_to_assoc($fields);
}

require_once('/layouts/navigation.php');
?>
<div id="pagination" style="clear: both;">
<?php  
if(isset($pagination)){
    if($pagination->total_pages() > 1) {
        if($pagination->has_previous_page()) { 
            echo "<a href=\"?page=";
            echo $pagination->previous_page();
            echo "\">&laquo; Previous";
            echo "</a> "; 
        } else {
            echo "&laquo; Previous";
        }
        for($i=1; $i <= $pagination->total_pages(); $i++) {
            if($i == $page) {
                echo " <span class=\"selected\">{$i}</span> ";
            } else {
                echo " <a href=\"?page={$i}\">{$i}</a> "; 
            }
        }
        if($pagination->has_next_page()) { 
            echo " <a href=\"?page=";
            echo $pagination->next_page();
            echo "\">Next &raquo;</a> "; 
        } else {
            echo "Next &raquo;</a> "; 
        }
    }
}
?>
</div>
<?php
echo display_table($result_array,$fields);
include('/layouts/footer.php');