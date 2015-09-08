<?php
    include_once '../includes/functions.php';
    $view_title = 'home';
    if (isset($_GET['view'])){
        $view_title = $_GET['view'];
        if ($view_title == 'home'){
            redirect_to('.');
        }
    } 
?>

<div id = "navigation"> <h2><?php echo format_field_name($view_title); ?></h2>  

    <table>
        <?php 
        $views = ['home', 'entries', 'accounts', 'accounts_balances'];
        for ($i = 0; $i < count($views); $i++){
            echo "<th><a href=\"index.php?view=$views[$i]\">" . format_field_name($views[$i]) . "</a></th>";
        }
        ?>
    </table>
    
</div>

