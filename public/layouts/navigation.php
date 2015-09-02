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

<div id = "navigation"> <h2><?php echo ucfirst($page_title); ?></h2>  

    <table>
        <?php 
        $pages = ['home', 'entries', 'accounts'];
        for ($i = 0; $i < count($pages); $i++){
            echo "<th><a href=\"index.php?page=" . htmlentities($pages[$i]) . "\">" . ucfirst($pages[$i]) . "</a></th>";
        }
        ?>
    </table>
    
</div>

