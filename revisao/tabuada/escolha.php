<?php
    $tabuada = 0;
    if (!empty($_REQUEST['radio'])) {
        $tabuada = $_REQUEST['radio'];
        switch ($tabuada) {
            case 1:
                header("Location: tabuada_caixasimples.php");
                break;
            case 2:
                header("Location: tabuada_select.php");
                break;
            case 3:
                 header("Location: tabuada_radio.php");
                break;
        }
    }
?>