<?php
    $tabuada = 0;
    if (!empty($_POST['tabuada'])) {
        $tabuada = $_POST['tabuada'];
    }else if ((!empty($_POST['radio']))) {
        $tabuada = $_POST['radio'];
    }else if ((!empty($_POST['select']))) {
        $tabuada = $_POST['select'];
    }

    if ($tabuada > 0 && $tabuada < 10) {
        for ($i = 1; $i <= 10; $i++) {
            $resultado = $tabuada * $i;
            echo "$tabuada x $i = $resultado";
            echo "<br>";
        }
    }
?>