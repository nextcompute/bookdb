<?php ?>
<div id = "navigation"> <h2>Navigation</h2>  

    <table>
        <?php 
        for ($i = 1; $i <= 5; $i++){
            echo "<th><a href=\"index.php?page=$i\">Page $i</a></th>";
        }
        ?>
    </table>
    
</div>

