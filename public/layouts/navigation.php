<?php 
    $page_title = 'navigation';
    if (isset($_GET['page'])){
        $page_title = $_GET['page'];
    } 
?>

<div id = "navigation"> <h2><?php echo ucfirst($page_title); ?></h2>  

    <table>
        <?php 
        $pages = ['entries', 'accounts'];
        for ($i = 0; $i < count($pages); $i++){
            echo "<th><a href=\"index.php?page=$pages[$i]\">" . ucfirst($pages[$i]) . "</a></th>";
        }
        ?>
    </table>
    
</div>

