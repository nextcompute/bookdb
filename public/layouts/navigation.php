<?php
    include_once '../includes/functions.php';
    $page_title = 'home';
    if (isset($_GET['page'])){
        $page_title = $_GET['page'];
        if ($page_title == 'home'){
            redirect_to('.');
        }
    } 
?>

<div id = "navigation"> <h2><?php echo format_field_name($page_title); ?></h2>  

    <table>
        <?php 
        $pages = ['home', 'entries', 'accounts_balances'];
        for ($i = 0; $i < count($pages); $i++){
            echo "<th><a href=\"index.php?page=$pages[$i]\">" . format_field_name($pages[$i]) . "</a></th>";
        }
        ?>
    </table>
    
</div>

