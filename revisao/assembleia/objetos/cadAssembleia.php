<pre>

<?php
    include_once "conexao.php";
    require_once 'classes/Morador.class.php';
    require_once 'classes/Assembleia.class.php';
    
    $nomeAssembleia = $_REQUEST["nome-assembleia"];
    $dataAssembleia = $_REQUEST["data-assembleia"];
//echo $nomeAssembleia . "<br>";
//echo $dataAssembleia;
    if (!$con) {
        die('Não foi possível conectar ao Banco de Dados');
   }
    $sqlDados = "INSERT INTO tb_assembleias (ass_nome, ass_data) values ('.$nomeAssembleia.', '.$dataAssembleia.')";

    mysqli_query($con, $sqlDados) or die ("Erro"); 
?>

</pre>