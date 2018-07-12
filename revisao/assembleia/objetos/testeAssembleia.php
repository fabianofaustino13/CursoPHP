<pre>

<?php

    require_once 'classes/Morador.class.php';
    require_once 'classes/Assembleia.class.php';
    
    $nomeAssembleia = $_REQUEST["nome-assembleia"];
    $descricaoAssembleia = $_REQUEST["descricao-assembleia"];
    $dataAssembleia = $_REQUEST["data-assembleia"];


    $assembleia = new Assembleia();
//    $assembleia->setParticipante($nomeMorador);
    $assembleia->setNomeAssembleia($nomeAssembleia);
    $assembleia->setDescricaoAssembleia($descricaoAssembleia);
    $assembleia->setDataAssembleia($dataAssembleia);

    var_dump($assembleia);


?>

</pre>