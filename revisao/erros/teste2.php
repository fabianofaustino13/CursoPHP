<?php

    function erroPersonalizado($nivel_erro, $mensagem_erro) {
        echo "<b>Erro:</b> [$nivel_erro] $mensagem_erro<br>";
        echo "Fim do Script";
        die();
    }

    set_error_handler("erroPersonalizado");

    echo($test);
?>