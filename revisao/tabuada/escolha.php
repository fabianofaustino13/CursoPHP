<?php
    $tabuada = 0;
    if (!empty($_POST['radio'])) {
        $escolha = $_POST['radio'];
        switch ($escolha) {
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