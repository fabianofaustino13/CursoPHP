<?php

for ($i = 1; $i <= 9; $i++) {
    if ($i % 3 == 1) {
        echo "<div id='test$i' style='width: 800px; height: 200px;'>";
        //echo "<div id='test$i' style='width: 800px;'>";
    }
    
    echo "<div id='$i' style='float: left; width:150px; margin-right: 50px;'>";

    for ($j = 1; $j <= 9; $j++) {
        $r = $i * $j;
        echo "$i x $j = $r";
        echo "<br>";
        
    }
    
    echo "</div>";

    if ($i % 3 == 0) {
        echo "</div>";
    }
}
?>