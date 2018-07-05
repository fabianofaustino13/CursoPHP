<?php
        $tabuada = 0;
        if (!empty($_REQUEST['tabuada'])) {
            $tabuada = $_REQUEST['tabuada'];
        }
        if ($tabuada > 0 && $tabuada < 10) {
            for ($i = 1; $i <= 10; $i++) {
                $resultado = $tabuada * $i;
                echo "$tabuada x $i = $resultado";
                echo "<br>";
            }
        }
        ?>