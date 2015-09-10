<?php
require_once ('../includes/initialize.php');

include('/layouts/header.php');
require_once('/layouts/navigation.php');
//$view_tile is from navigation.php
if ($view_title == 'entries') {
    $class_name = 'Entry';
} else if ($view_title == 'accounts_balances'){
    $class_name = 'AccountBalance';
} else if ($view_title == 'accounts'){
    $class_name = 'Account';
}

$object_array = "";
$fields = "";
$result_array = [];
if (isset($class_name)){
    
    // 1. the current page number ($current_page)
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

    // 2. records per page ($per_page)
    $per_page = 10;
    // 3. total record count ($total_count)
    $total_count = $class_name::count_all();
    
    //$object_array = $class_name::find_all();
    $fields = $class_name::table_fields();
    
    $pagination = new Pagination($page, $per_page, $total_count);
    $sql = "SELECT * FROM " . $class_name::table_name();
    $sql .= $class_name::sql_order();
    $sql .= " LIMIT {$per_page} ";
    $sql .= " OFFSET {$pagination->offset()}";
    $object_array = $class_name::find_by_sql($sql);
    
    
    for ($i=0; $i<count($object_array); $i++){
        $result_array[] = $object_array[$i]->object_to_assoc($fields);
    }
}
?>
<div id="pagination" style="clear: both;">
<?php  
if(isset($pagination)){
            if($pagination->total_pages() > 1) {
                    if($pagination->has_previous_page()) { 
            echo "<a href=\"index.php?view=$view_title&page=";
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
                                    echo " <a href=\"index.php?view=$view_title&page={$i}\">{$i}</a> "; 
                            }
                    }
                    if($pagination->has_next_page()) { 
                            echo " <a href=\"index.php?view=$view_title&page=";
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
if ($view_title == "entries"){
    if(isset($_POST['submit']) && $_POST['submit']=='Submit'){
        $entry = new Entry();
        echo "<tr>Sumbitted<tr>";
        $entry->amount = $_POST['amount'];
        $entry->transaction_date = $_POST['transaction_date'];
        $entry->debit_id = $_POST['debit_id'];
        $entry->credit_id = $_POST['credit_id'];
        $entry->description = $_POST['description'];
        $entry->create();
    }
    
?>
<div id="create">
    <form action = "index.php?view=<?php echo htmlentities($view_title); ?>"method="POST">
        <input name="amount" type="number" value=<?php echo 1000*(rand(1,10)); ?>>
        <input name="transaction_date" type="date" value="<?php echo date("Y-m-d", time());?>">
        <input name="debit_id" type="number" value=<?php echo 10*(rand(1,30)); ?>>
        <input name="credit_id" type="number" value=<?php echo 10*(rand(1,30)); ?>>
        <input name="description" type="text">
        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<?php }?>
<?php

$output = "";
$output .= "<table width  = 50%>";

$output .= table_headings($fields);

$output .= table_rows($result_array,$fields);
$output .= "</table>";
echo $output;

include('/layouts/footer.php');