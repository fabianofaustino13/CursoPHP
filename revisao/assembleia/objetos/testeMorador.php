<pre>

<?php

    require_once 'classes/Morador.class.php';
    require_once 'classes/Assembleia.class.php';
    
    $nomeMorador = $_REQUEST["nome"];
    $cpfMorador = $_REQUEST["cpf"];
    $emailMorador = $_REQUEST["email"];


    $moradorFabiano = new Morador();
    $moradorFabiano->setNomeMorador($nomeMorador);
    $moradorFabiano->setCpf($cpfMorador);
    $moradorFabiano->setEmail($emailMorador);

    var_dump($moradorFabiano);

?>

</pre>