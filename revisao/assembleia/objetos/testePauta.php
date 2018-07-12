<pre>

<?php

    require_once 'classes/Morador.class.php';
    require_once 'classes/Assembleia.class.php';
    require_once 'classes/Pauta.class.php';
    require_once 'classes/OpcaoPauta.class.php';
    
    $nomePauta = $_REQUEST['nome-pauta'];

    $assembleia = new Assembleia();
    $assembleia->setNomeAssembleia('Testando o nome da assembléia');

    $pauta = new Pauta();
    $pauta->setNomeAssembleia($assembleia);
    $pauta->setNomePauta($nomePauta);
//    $pauta->setDescricaoPauta('Melhorar no consumo');
    
    $opcaoPauta = new OpcaoPauta();
    $opcaoPauta->setOpcao('Sim');
    $pauta->setOpcaoPauta($opcaoPauta);
    
    var_dump($assembleia->getNomeAssembleia());
    var_dump($pauta->getNomePauta());
    var_dump($pauta->getOpcaoPauta());


    $opcaoPauta = new OpcaoPauta();
    $opcaoPauta->setOpcao('Não');
    $pauta->setOpcaoPauta($opcaoPauta);

    var_dump($opcaoPauta);


?>

</pre>