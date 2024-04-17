<?php 
    if ($totalPage > 0) {
        echo "<div>";
        for ($i = 1; $i <= $totalPage; $i++) {
            if ($i == $page) {
                echo "<strong>$i</strong>";
            } else {
                echo "<a href='?page=$i&perPage=$perPage'>  $i</a>";
            }
        }
        echo "</div>";
    }
?>