<pre>

<?php

    require_once 'classes/Morador.class.php';
    require_once 'classes/Assembleia.class.php';
    
    $nomeMorador = $_REQUEST["nome"];
    $loginMorador = $_REQUEST["login"];
    $senhaMorador = $_REQUEST["senha"];
    
    $emailMorador = $_REQUEST["email"];

    $foneMorador = $_REQUEST["fone"];


    $moradorFabiano = new Morador();
    $moradorFabiano->setNomeMorador($nomeMorador);
    $moradorFabiano->setCpf($cpfMorador);
    $moradorFabiano->setEmail($emailMorador);

    var_dump($moradorFabiano);

?>

</pre>