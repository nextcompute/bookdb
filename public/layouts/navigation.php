<?php
    include_once (LIB_PATH.DS.'functions.php');
?>

<div id = "navigation"> <h2><?php echo format_field_name($page_name); ?></h2>  
    
    <table>
        <?php 
        //$views = ['home', 'entries', 'accounts', 'accounts_balances'];
        $views = Navigation::find_all();
        foreach ($views as $view) {
            if($location = $view->location){
                $location .= ".php";
            }
            echo "<th><a href=\"./" . htmlentities($location) . "\">" . format_field_name($view->name) . "</a></th>";
        }
        ?>
    </table>
    
</div>

